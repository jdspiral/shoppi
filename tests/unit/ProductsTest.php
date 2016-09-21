<?php

use App\Product;

class ProductsTest extends ApiTester {

    /** @test */
    public function it_fetches_products()
    {
        $this->times(5)->makeProduct();

        $this->getJson('api/v1/products');

        $this->assertResponseOK();
    }

    private function makeProduct($productFields = [])
    {
        $product = array_merge([
           'name' => $this->fake->word,
            'description' =>$this->fake->sentence,
            'price' => $this->fake->randomDigit,
        ], $productFields);

        while($this->times--) Product::create($product);
    }

}