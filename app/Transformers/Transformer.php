<?php

namespace App\Transformers;
/**
 * Created by PhpStorm.
 * User: josh
 * Date: 9/8/16
 * Time: 3:48 PM
 */
abstract class Transformer
{
    /**
     * Transform a collection of items
     *
     * @param $items
     * @return array
     */
    public function transformCollection(array $items)
    {
        return array_map([$this, 'transform'], $items);
    }

    public abstract function transform($item);
}