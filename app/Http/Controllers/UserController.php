<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $usuarios = User::orderBy('id', 'desc')->get();
        return view('usuarios.index', compact('usuarios'));
    }

}
