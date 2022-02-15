<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AllForm;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $forms = AllForm::orderBy('id', 'desc')->paginate(10);
        return view('welcome', compact('forms'));
    }
}
