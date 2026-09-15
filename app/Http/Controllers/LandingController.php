<?php

namespace App\Http\Controllers;

use App\Models\Package;

class LandingController extends Controller
{
    public function index()
    {
        $packages = Package::orderBy('discount_percentage')->get();
        return view('landing.index', compact('packages'));
    }
}