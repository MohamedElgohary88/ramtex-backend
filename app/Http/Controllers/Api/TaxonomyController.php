<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Http\Resources\CategoryResource;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class TaxonomyController extends Controller
{
    public function categories(): JsonResponse
    {
        $categories = Category::query()
            ->where('is_active', true)
            ->withCount('products')
            ->orderBy('name')
            ->get(['id', 'name', 'slug', 'image_path']);

        return response()->json([
            'data' => CategoryResource::collection($categories),
        ]);
    }

    public function brands(): JsonResponse
    {
        $brands = Brand::query()
            ->where('is_active', true)
            ->withCount('products')
            ->orderBy('name')
            ->get(['id', 'name', 'slug', 'image']);

        return response()->json([
            'data' => BrandResource::collection($brands),
        ]);
    }
}
