<?php

namespace backend\models;

use yii\base\Model;

/*
 * Validation form model, for Modal window with input capacity which user try to eat
 * */
class EatAppleForm extends Model
{
    public const CAPACITY = 'capacity';
    public $capacity;

    public function rules()
    {
        return [
            [['capacity'], 'required'],
            [['capacity'], 'integer'],
            ['capacity', 'compare', 'compareValue' => 1, 'operator' => '>=', 'type' => 'number'],
            ['capacity', 'compare', 'compareValue' => 100, 'operator' => '<=', 'type' => 'number'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'capacity' => 'объем яблока',
        ];
    }
}
