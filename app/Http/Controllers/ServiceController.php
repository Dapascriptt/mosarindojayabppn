<?php

namespace App\Http\Controllers;

use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('details')->orderBy('created_at')->get();

        return view('pages.services.index', compact('services'));
    }

    public function show(string $service)
    {
        $serviceItem = Service::where('slug', $service)->with('details')->firstOrFail();

        return view('pages.services.show', [
            'service' => $serviceItem,
        ]);
    }
}
