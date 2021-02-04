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
            'state' => 'state',
            'color' => 'Color',
            'capacity' => 'Capacity',
            'created_at' => 'Created At',
            'fell_at' => 'Fell At',
        ];
    }
}
