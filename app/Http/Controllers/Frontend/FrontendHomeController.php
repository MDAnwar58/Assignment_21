<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendHomeController extends Controller
{
    function index()
    {
        return view('pages.frontend.home.index');
    }
}
