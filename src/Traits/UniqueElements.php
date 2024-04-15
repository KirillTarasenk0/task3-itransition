<?php

namespace Itransition\Traits;

trait UniqueElements
{
    public function areAllElementsUnique(array $array): bool
    {
        $uniqueArray = array_unique($array);
        return count($uniqueArray) === count($array);
    }
}