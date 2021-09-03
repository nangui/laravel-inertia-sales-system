<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProductTypesController extends Controller
{
    public function index(): Response
    {
      return Inertia::render('ProductTypes/Index', [
        'filters' => Request::all('search', 'trashed'),
        'types' => ProductType::orderByCode()
            ->filter(Request::only('search', 'trashed'))
            ->paginate(8)
            ->withQueryString()
            ->through(fn ($type) => [
                'id' => $type->id,
                'code' => $type->code,
                'description' => $type->description
            ]),
      ]);
    }

  public function create(): Response
  {
    return Inertia::render('ProductTypes/Create');
  }

  public function store(): RedirectResponse
  {
    ProductType::create(
      Request::validate([
        'code' => ['required', 'max:30'],
        'description' => ['required', 'max:50'],
      ])
    );

    return Redirect::route('product-types')->with('success', 'Type de produit créé.');
  }

  public function edit(ProductType $productType): Response
  {
    return Inertia::render('ProductTypes/Edit', [
      'type' => [
        'id' => $productType->id,
        'code' => $productType->code,
        'description' => $productType->description,
      ],
    ]);
  }

  public function update(ProductType $productType): RedirectResponse
  {
    $productType->update(
      Request::validate([
        'code' => ['required', 'max:50'],
        'description' => ['required', 'max:50'],
      ])
    );

    return Redirect::back()->with('success', 'Type de produit mis à jour.');
  }

  public function destroy(ProductType $productType): RedirectResponse
  {
    $productType->delete();

    return Redirect::route('product-types')->with('success', 'Type de produit archivé.');
  }

  public function restore(ProductType $productType): RedirectResponse
  {
    $productType->restore();

    return Redirect::back()->with('success', 'Type de produit restoré.');
  }
}
