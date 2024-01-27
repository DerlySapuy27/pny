<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SedeController extends Controller
{
    public function index(){
        return view('sede.index');
        }
}
