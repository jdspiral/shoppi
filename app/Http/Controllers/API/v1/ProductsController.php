<?php
/**
 * Created by PhpStorm.
 * User: josh
 * Date: 9/2/16
 * Time: 6:05 PM
 */

namespace App\Http\Controllers\API\v1;
use App\Transformers\ProductsTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Product;
use App\Http\Controllers\Controller;

/**
 * Class ProductsController
 * @package App\Http\Controllers
 */
class ProductsController extends Controller
{
    /**
     * @var App\Transformers\ProductTransformer
     */
    protected $productTransformer;

    function __construct(ProductsTransformer $productTransformer)
    {
        $this->productTransformer = $productTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return Response::json([
            'data' => $this->productTransformer->transformCollection($products->toArray())
        ], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        return Response::json([
            'data' => $product->toArray()
        ], 201);


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
            return Response::json([
                'error' => [
                    'message' => 'Product does not exist',
                    'code' => 'add error code here - josh'
                ]
            ], 404);
        }

        return Response::json([
            'data' => $this->productTransformer->transform($product->toArray())
        ], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
