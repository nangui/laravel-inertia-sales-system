<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class SalesController extends Controller
{
    public function index()
    {
        if (Product::all()->count() === 0) {
            return Redirect::back()->with('error', 'Vous devez ajouter un au moins un produit avant.');
        }

        $sales = Sale::orderBy('created_at', 'desc')
            ->with('user')
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->filter(Request::only('search', 'trashed'))
            ->paginate(8)
            ->withQueryString()
            ->through(fn ($sale) => [
                'id' => $sale->id,
                'amount' => $sale->amount,
                'date' => $sale->date,
                'type' => $sale->type,
                'user' => [
                    'first_name' => $sale->user->first_name,
                    'last_name' => $sale->user->last_name,
                ],
            ]);
        return Inertia::render('Sales/Index', [
            'filters' => Request::all('search', 'trashed'),
            'sales' => $sales,
        ]);
    }

    public function create()
    {
        return Inertia::render('Sales/Create');
    }

    public function store(Request $request)
    {
        
    }

    public function edit(Sale $sale)
    {}

    public function update(Request $request, Sale $sales)
    {}

    public function destroy(Sale $sale)
    {}
}
