<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProductsController extends Controller
{
    public function index()
    {
      if (ProductType::all()->count() === 0) {
        return Redirect::back()->with('error', 'Vous devez ajouter un au moins un type avant.');
      }

      return Inertia::render('Products/Index', [
        'filters' => Request::all('search', 'trashed'),
        'products' => Product::orderBy('label')
          ->with('productType')
          ->orderBy('name')
          ->orderBy('unit_price')
          ->filter(Request::only('search', 'trashed'))
          ->paginate(8)
          ->withQueryString()
          ->through(fn ($product) => [
            'id' => $product->id,
            'label' => $product->label,
            'name' => $product->name,
            'unit_price' => $product->unit_price,
            'deleted_at' => $product->deleted_at,
            'product_type_id' => $product->type ? $product->type->only('code') : null
          ]),
      ]);
    }

    public function create(): Response
    {
      return Inertia::render('Products/Create', [
        'types' => ProductType::orderBy('label')
          ->get()
          ->map
          ->only('id', 'label'),
      ]);
    }

    public function store(): RedirectResponse
    {
      Product::create(
        Request::validate([
          'label' => ['required', 'max:30'],
          'name' => ['unique:products,name', 'max:100'],
          'product_type_id' => ['required', 'exists:product_types,id'],
          'unit_price' => ['numeric', 'min:100'],
          'description' => ['required'],
          'user_id' => ['required', 'exists:users,id'],
        ])
      );

      return Redirect::route('products')->with('success', 'Produit créé.');
    }

    public function edit(Product $product): Response
    {
      return Inertia::render('Products/Edit', [
        'product' => [
          'id' => $product->id,
          'label' => $product->label,
          'product_type_id' => $product->product_type_id,
          'name' => $product->name,
          'unit_price' => $product->unit_price,
          'description' => $product->description,
          'user_id' => $product->user_id,
          'deleted_at' => $product->deleted_at,
        ],
        'types' => ProductType::orderByCode()
          ->get()
          ->map
          ->only('id', 'label'),
      ]);
    }

    public function update(Product $product): RedirectResponse
    {
      Request::validate([
        'label' => ['required', 'max:30'],
        'name' => ['required', 'max:100'],
        'product_type_id' => ['required', 'exists:product_types,id'],
        'unit_price' => ['numeric', 'min:100'],
        'description' => ['required'],
        'user_id' => ['required', 'exists:users,id'],
      ]);

      $product->update([
        'label' => Request::get('label'),
        'name' => Request::get('name'),
        'product_type_id' => Request::get('product_type_id'),
        'unit_price' => Request::get('unit_price'),
        'description' => Request::get('description'),
        'user_id' => Request::get('user_id'),
      ]);

      return Redirect::back()->with('success', 'Produit mis à jour.');
    }

    public function destroy(Product $product): RedirectResponse
    {
      $product->delete();

      return Redirect::route('products')->with('success', 'Le produit a bient été archivé.');
    }

    public function restore(Product $product): RedirectResponse
    {
      $product->restore();

      return Redirect::back()->with('success', 'Le produit a bien été restauré.');
    }
}
