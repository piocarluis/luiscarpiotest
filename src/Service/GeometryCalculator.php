<?php

namespace App\Service;

use PhpParser\Node\Scalar\DNumber;

class GeometryCalculator
{
    public function getSumSurface($object1, $object2): float
    {
        return $object1->getSurface() + $object2->getSurface();
    }


    public function getSumCircumference($object1, $object2): float
    {
        return $object1->getCircumference() + $object2->getCircumference();
    }
}