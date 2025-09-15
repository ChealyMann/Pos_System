<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        return view('category.index');
    }

    public function create()
    {
        return view('category.create');
    }
}
