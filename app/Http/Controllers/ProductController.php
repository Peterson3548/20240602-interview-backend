<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = Product::query()->with('brand');

        if ($request->has('name')) {
            $query->where('name', $request->input('name'));
        }

        if ($request->has('brand_id')) {
            $query->where('brand_id', $request->input('brand_id'));
        }

        if ($request->has('min_official_price')) {
            $query->where('official_price', '>=', $request->input('min_official_price'));
        }

        if ($request->has('max_official_price')) {
            $query->where('official_price', '<=', $request->input('max_official_price'));
        }

        if ($request->has('min_actual_price')) {
            $query->where('actual_price', '>=', $request->input('min_actual_price'));
        }

        if ($request->has('max_actual_price')) {
            $query->where('actual_price', '<=', $request->input('max_actual_price'));
        }

        $pagination = $query->paginate($request->input('per_page'));

        return ProductResource::collection($pagination);
    }
}
