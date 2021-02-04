<?php

namespace backend\components\applestorage;

use backend\models\AppleStorage;

/**
 *  TODO: maybe move it to Model ?
 */
class Apple
{

    public $color;
    public $capacity = 1;

    public function __construct($color = '')
    {
//        TODO: possibly unnecessary conditions due to defects in the technical specification
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
}
