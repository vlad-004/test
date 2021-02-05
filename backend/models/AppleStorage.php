<?php

namespace backend\models;

use Yii;
use yii\web\BadRequestHttpException;

/**
 * This is the model class for table "apple_storage".
 *
 * @property int $id
 * @property int|null $state
 * @property string|null $color
 * @property float|null $capacity
 * @property string|null $created_at
 * @property string|null $fell_at
 */
class AppleStorage extends \yii\db\ActiveRecord
{
    public const STATE_ON_BRANCH = 1;
    public const STATE_FELL = 2;
    public const STATE_ROTTEN = 3;

    public static $appleColors = [
        'red',
        'green',
        'brown',
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apple_storage';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['state'], 'integer'],
            [['capacity'], 'number'],
            [['created_at', 'fell_at'], 'safe'],
            [['color'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'state' => 'Состояние',
            'color' => 'Цвет',
            'capacity' => 'Ёмкость(размер)',
            'created_at' => 'Дата появления',
            'fell_at' => 'Дата падения',
        ];
    }

    /**
     * @return string
     */
    public function getStateName(): string
    {
        switch ($this->state) {
            case self::STATE_FELL:
                return 'Упало';
            case self::STATE_ROTTEN:
                return 'Испорчено';
            case self::STATE_ON_BRANCH:
            default:
                return 'На ветке';
        }
    }

    /**
     * Change state for apple, After that apple can spoiled after 5 hours, and can to eating
     */
    public function fallToGround()
    {
        if ($this->state === AppleStorage::STATE_FELL) {
            throw new BadRequestHttpException('Яблоко невозможно сорвать с дерева повторно');
        }
        $this->state = AppleStorage::STATE_FELL;
        $this->fell_at = date('Y-m-d, H:i:s', time());
        $this->save();
    }

    /**
     * Find apples with STATE_FELL when 5 hours have passed since the fall d change his state to STATE_ROTTEN
     */
    public static function changeToRotten(): bool
    {
        $fallenApples = AppleStorage::find()
            ->where(['state' => AppleStorage::STATE_FELL])
            ->all();
        if ($fallenApples) {
            $fallenApplesIds = [];
            foreach ($fallenApples as $apple) {
                /** @var AppleStorage $apple */
                $dateWhenAppleRotten = strtotime($apple->fell_at . ' +5 hours');
                if ($dateWhenAppleRotten <= strtotime('now')) {
                    $fallenApplesIds[] = $apple->id;
                }
            }
            if ($fallenApplesIds) {
                AppleStorage::updateAll(
                    ['state' => AppleStorage::STATE_ROTTEN],
                    ['in', 'id', $fallenApplesIds]
                );
                return true;
            }
        }
        return false;
    }

    /**
     * Checking - if apple was fallen at ground then we can sub. capacity
     * @param $capacity
     */
    public function eat($capacity)
    {


    }
}
