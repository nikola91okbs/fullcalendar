<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
    	return view('welcome');
    }

    public function register()
    {
    	return view('auth.register');
    }

    public function login()
    {
    	return view('auth.login');
    }
}
