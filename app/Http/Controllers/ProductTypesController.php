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
      return Inertia::render('ProductTypes\Index', [
        'filters' => Request::all('search', 'trashed'),
        'productTypes' => ProductType::paginate(10)
          ->withQueryString()
          ->through(fn ($service) => [
            'id' => $service->id,
            'code' => $service->code,
            'description' => $service->description
          ]),
      ]);
    }
}
