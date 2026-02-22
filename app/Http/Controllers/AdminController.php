<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::where('is_admin', true)->paginate(10);
        return view('admin', compact('users'));
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
            'is_admin' => true,
        ]);

        return redirect()->route('admins')->with('success', 'Administrador criado com sucesso!');
    }

    public function update(Request $request, User $admin) 
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $admin->id,
            'password' => 'nullable|string|min:8',
            'birthdate' => 'required|date',
            'cpf' => 'required|string|unique:users,cpf,' . $admin->id,
            'saldo' => 'required|numeric|min:0',
        ]);

        $admin->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => isset($data['password']) ? Hash::make($data['password']) : $admin->password,
            'birthdate' => $data['birthdate'],
            'cpf' => $data['cpf'],
            'saldo' => $data['saldo'],
        ]);

        return redirect()->route('admins')->with('success', 'Administrador atualizado com sucesso!');
    }

    public function destroy(User $admin)
    {
        $admin->delete();
        return redirect()->route('admins')->with('success', 'Administrador deletado com sucesso!');
    }
}
