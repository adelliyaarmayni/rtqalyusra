<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function register(Request $request)
    {
        
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function login()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function logout($id)
    {
        //
    }
}
