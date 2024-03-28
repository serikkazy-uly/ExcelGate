<?php

namespace App\Http\Controllers\User;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index(): View
    {
        return view('home');
    }
}
