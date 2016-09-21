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

    /** @test */
    public function it_fetches_a_single_product()
    {
        $this->makeProduct();

        $product = $this->getJson('api/v1/products/1')->data;

        $this->assertResponseOk();
        $this->assertObjectHasAttributes($product, 'title', 'description', 'price');

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

    private function assertObjectHasAttributes()
    {
        $args = func_get_args();
        $object = array_shift($args);

        foreach($args as $attribute)
        {
            $this->assertObjectHasAttribute($attribute, $object);
        }
    }

}