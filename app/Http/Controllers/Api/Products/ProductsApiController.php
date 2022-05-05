<?php

namespace App\Http\Controllers\Api\Products;

use App\Actions\Products\StoreOrUpdateProductAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FormProductRequest;
use App\Http\Resources\Api\ProductsResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductsApiController extends Controller
{

    public function index(): AnonymousResourceCollection
    {
        return ProductsResource::collection(Product::paginate());
    }

    public function store(FormProductRequest $request, StoreOrUpdateProductAction $action): JsonResponse
    {
        $product = Product::storeOrUpdateProduct($request, $action);

        return ProductsResource::make($product)->response()->setStatusCode(201);
    }

    public function show(Product $product): ProductsResource
    {
        return ProductsResource::make($product);
    }

    public function update(FormProductRequest $request, Product $product, StoreOrUpdateProductAction $action): ProductsResource
    {
        $product = Product::storeOrUpdateProduct($request, $action, $product);

        return ProductsResource::make($product);
    }

    public function destroy(Product $product): JsonResponse
    {
        $product->delete();
        return response()->json(['status' => '201', 'message' => 'se ha eliminado correctamente el show que has elegido']);
    }

}
