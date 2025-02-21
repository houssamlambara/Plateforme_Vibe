<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $listuser = User::all();
        return view('dashboard', compact('listuser'));
    }
}