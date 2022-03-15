<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function index()
    {
        $forms = Form::where('status', 1)->orderBy('title', 'asc')->get();
        return view('front.list_forms', compact('forms'));
    }
    public function view_form($slug)
    {
        $form  = Form::where('slug', $slug)->firstOrFail();
        return view('front.view_form', compact('form'));
    }
}
