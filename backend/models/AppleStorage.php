<?php

namespace backend\models;

use Yii;

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
    public $capacity = 1;

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
     *After that apple can spoiled after 5 hours, and can to eating
     */
    public function FallToGround() {

    }

    /**
     * Checking - if apple was fallen at ground then we can sub. capacity
     * @param $capacity
     */
    public function Eat($capacity) {


    }
}
