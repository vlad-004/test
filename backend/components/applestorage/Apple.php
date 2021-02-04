<?php

use backend\models\AppleStorage;

/**
 *
 */
class Apple
{

    public $color;

    public function __construct($color = '')
    {
        if (empty($color)) {
            $color = $this->getRandomColor();
        }
        $this->color = $color;
    }

    /**
     * @return string
     */
    private function getRandomColor(): string
    {
        $appleColors = AppleStorage::$appleColors;
        return $appleColors[array_rand($appleColors)];
    }

    public function FallToGround() {

    }

    public function Eat($capacity) {

    }
}
