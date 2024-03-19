<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LabelController extends Controller
{
    public function index(){

        $labels = Label::where('status','=');
        return view('admin.label.index');
    }
}
