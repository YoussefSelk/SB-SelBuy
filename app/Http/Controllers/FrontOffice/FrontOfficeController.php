<?php

namespace App\Http\Controllers\FrontOffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontOfficeController extends Controller
{
    public function index()
    {
        return view('index');
    }
}
