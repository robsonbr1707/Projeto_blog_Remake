<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(6);
            return Inertia::render('Admin/Users/Index', compact('users'));
    }

    public function create()
    {
        return Inertia::render('Admin/Users/Create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        Validator::make($data, [
            'name' => ['required', 'min:2'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required']
        ])->validate();
   
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']) 
        ]);
        
            return Redirect::route('users.index')->with('success', 'Usuario Criado com Sucesso!!');
    }
  
    public function edit(User $user)
    {
        return Inertia::render('Admin/Users/Edit', [
            'user' => $user
        ]);
    }
    
    public function update($id, Request $request)
    {
        $data = $request->all();
        Validator::make($data, [
            'name' => ['required', 'min:2'],
            'email' => ['required', 'email', 'unique:users,email,'.$id],
        ])->validate();
    
        User::findOrFail($id)->update($data);
            return Redirect::route('users.index')->with('message', 'Usuario Atualizado!');
    }
    
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
            return Redirect::route('users.index')->with('success', 'Usuario Excluido!');
    }
}
