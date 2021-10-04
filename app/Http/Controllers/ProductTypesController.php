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
                'label' => $type->label,
                'parent' => $type->product_type_id ? ProductType::find($type->product_type_id)->label : null,
            ]),
      ]);
    }

  public function create(): Response
  {
    return Inertia::render('ProductTypes/Create', [
      'types' => ProductType::orderByCode()->get()->map(fn ($type) => [
        'id' => $type->id,
        'label' => $type->label,
      ]),
    ]);
  }

  public function store(): RedirectResponse
  {
    ProductType::create(
      Request::validate([
        'label' => ['required', 'max:30'],
        'product_type_id' => ['nullable'],
      ])
    );

    return Redirect::route('product-types')->with('success', 'Type de produit créé.');
  }

  public function edit(ProductType $productType): Response
  {
    return Inertia::render('ProductTypes/Edit', [
      'type' => [
        'id' => $productType->id,
        'label' => $productType->label,
        'parent' => $productType->product_type_id ? ProductType::find($productType->product_type_id) : null,
      ],
      'types' => ProductType::all(),
    ]);
  }

  public function update(ProductType $productType): RedirectResponse
  {
    $productType->update(
      Request::validate([
        'label' => ['required', 'max:50'],
        'product_type_id' => ['exists:product_types,id'],
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
