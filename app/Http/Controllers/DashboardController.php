<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductType;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard/Index', [
            'product_type_count' => $this->productTypeCount(),
            'product_type_trashed_count' => $this->productTypeTrashedCount(),
            'product_count' => $this->productCount(),
            'product_trashed_count' => $this->productTrashedCount(),
        ]);
    }

    private function productTypeCount()
    {
        return ProductType::all()->count();
    }

    private function productTypeTrashedCount()
    {
        return ProductType::onlyTrashed()->count();
    }

    private function productCount()
    {
        return Product::all()->count();
    }

    private function productTrashedCount()
    {
        return Product::onlyTrashed()->count();
    }
}
