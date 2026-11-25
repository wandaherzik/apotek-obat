<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = User::latest()->get();

        return view(
            'layouts.user.index',
            compact('user')
        );
    }

    public function store(Request $request)
    {
        $request->validate([

            'nama' => 'required|max:100',

            'username' => 'required|unique:users,username',

            'password' => 'required|confirmed|min:6',

            'role' => 'required',

            'status' => 'required'

        ]);

        User::create([

            'nama' => $request->nama,

            'username' => $request->username,

            'password' => Hash::make($request->password),

            'role' => $request->role,

            'status' => $request->status

        ]);

        return back()->with(
            'success',
            'User berhasil ditambahkan.'
        );
    }

public function update(Request $request,$id)
{
    $request->validate([

        'nama'=>'required',

        'username'=>'required|unique:users,username,'.$id.',id_user',

        'role'=>'required',

        'status'=>'required'

    ]);

    $user = User::findOrFail($id);

    $user->nama = $request->nama;

    $user->username = $request->username;

    $user->role = $request->role;

    $user->status = $request->status;

    if($request->password){

        $user->password = bcrypt($request->password);

    }

    $user->save();

    return back()->with(
        'success',
        'User berhasil diperbarui.'
    );
}

public function destroy($id)
{
    $user = User::findOrFail($id);

    if($user->id_user == auth()->id()){

        return back()->with(
            'error',
            'Anda tidak dapat menghapus akun yang sedang digunakan.'
        );

    }

    $user->delete();

    return back()->with(
        'success',
        'User berhasil dihapus.'
    );
}
}