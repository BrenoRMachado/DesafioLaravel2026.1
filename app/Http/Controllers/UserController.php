<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('is_admin', false)->paginate(10);
        return view('users', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'birthdate' => 'required|date',
            'cpf' => 'required|string|unique:users,cpf',
            'saldo' => 'required|numeric|min:0',
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'birthdate' => $data['birthdate'],
            'cpf' => $data['cpf'],
            'saldo' => $data['saldo'],
            'is_admin' => false,
        ]);

        return redirect()->route('users')->with('success', 'Usuário criado com sucesso!');
    }
}
