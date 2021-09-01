<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class ServicesController extends Controller
{
    public function index()
    {
      return Inertia::render('Services/Index', [
        'filters' => Request::all('search', 'trashed'),
        'services' => Service::paginate(10)
            ->withQueryString()
           ->through(fn ($service) => [
               'id' => $service->id,
               'code' => $service->code,
               'description' => $service->description
           ]),
      ]);
    }

  public function create()
  {
    return Inertia::render('Services/Create');
  }

  public function store()
  {
    Service::create(
      Request::validate([
        'code' => ['required', 'max:10'],
        'description' => ['required', 'max:50'],
      ])
    );

    return Redirect::route('services')->with('success', 'Service créé.');
  }

  public function edit(Service $service)
  {
    return Inertia::render('Services/Edit', [
      'service' => [
        'id' => $service->id,
        'code' => $service->code,
        'description' => $service->description,
      ],
    ]);
  }

  public function update(Service $service)
  {
    $service->update(
      Request::validate([
        'code' => ['required', 'max:50'],
        'description' => ['required', 'max:50'],
      ])
    );

    return Redirect::back()->with('success', 'Service mis à jour.');
  }

  public function destroy(Service $service)
  {
    $service->delete();

    return Redirect::route('services')->with('success', 'Service archivé.');
  }

  public function restore(Service $service)
  {
    $service->restore();

    return Redirect::back()->with('success', 'Service restoré.');
  }
}
