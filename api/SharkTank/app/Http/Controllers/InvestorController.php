<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class InvestorController extends Controller
{
    public function index(){
        return view('admin.investor.index');
    }
}
