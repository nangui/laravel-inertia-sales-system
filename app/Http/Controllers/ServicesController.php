<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Inertia\Response;

class ServicesController extends Controller
{
    public function index(): Response
    {
      return Inertia::render('Services/Index', [
        'filters' => Request::all('search', 'trashed'),
        'services' => Service::orderByCode()
          ->filter(Request::only('search', 'trashed'))
          ->paginate(10)
          ->withQueryString()
          ->through(fn ($service) => [
               'id' => $service->id,
               'code' => $service->code,
               'description' => $service->description
           ]),
      ]);
    }

  public function create(): Response
  {
    return Inertia::render('Services/Create');
  }

  public function store(): RedirectResponse
  {
    Service::create(
      Request::validate([
        'code' => ['required', 'max:10'],
        'description' => ['required', 'max:50'],
      ])
    );

    return Redirect::route('services')->with('success', 'Service créé.');
  }

  public function edit(Service $service): Response
  {
    return Inertia::render('Services/Edit', [
      'service' => [
        'id' => $service->id,
        'code' => $service->code,
        'description' => $service->description,
      ],
    ]);
  }

  public function update(Service $service): RedirectResponse
  {
    $service->update(
      Request::validate([
        'code' => ['required', 'max:50'],
        'description' => ['required', 'max:50'],
      ])
    );

    return Redirect::back()->with('success', 'Service mis à jour.');
  }

  public function destroy(Service $service): RedirectResponse
  {
    $service->delete();

    return Redirect::route('services')->with('success', 'Service archivé.');
  }

  public function restore(Service $service): RedirectResponse
  {
    $service->restore();

    return Redirect::back()->with('success', 'Service restoré.');
  }
}
