<?php
/**
 * Created by PhpStorm.
 * User: josh
 * Date: 9/2/16
 * Time: 6:05 PM
 */

namespace App\Http\Controllers\API\v1;
use App\Transformers\ProductTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Product;
use App\Http\Controllers\API\ApiController;

/**
 * Class ProductsController
 * @package App\Http\Controllers
 */
class ProductsController extends ApiController
{
    /**
     * @var \App\Transformers\ProductTransformer
     */
    protected $productTransformer;

    function __construct(ProductTransformer $productTransformer)
    {
        $this->productTransformer = $productTransformer;

        //$this->beforeFilter('auth.basic', ['on' => 'post']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return $this->respond([
            'data' => $this->productTransformer->transformCollection($products->all())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->name && !$request->price) {
            return $this->setStatusCode(422)
                ->respondWithError('Paramenter failed validation for a product.');
        }
        Product::create($request->all());

        return $this->respondCreated('Product successfully created.');


    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return $this->respondNotFound('Product does not exist');
        }

        return $this->respond([
            'data' => $this->productTransformer->transform($product->toArray())
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
