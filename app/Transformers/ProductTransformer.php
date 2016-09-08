<?php
/**
 * Created by PhpStorm.
 * User: josh
 * Date: 9/8/16
 * Time: 3:52 PM
 */

namespace App\Transformers;


class ProductTransformer extends Transformer
{


    public function transform($product)
    {
        return [
            'title' => $product['name'],
            'description' => $product['description'],
            'price' => (int) $product['price']
        ];
    }
}