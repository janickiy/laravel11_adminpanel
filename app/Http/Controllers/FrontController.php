<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use Illuminate\Contracts\View\View;

class FrontController extends Controller
{
    public function index(): View
    {
        $catalogs = Catalog::query()
            ->orderBy('name')
            ->get();

        return view('front.index', compact('catalogs'));
    }
}
