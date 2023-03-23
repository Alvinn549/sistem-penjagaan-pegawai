<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class SettingsController extends Controller 
{
    public function index()
    { 
        $user = User::findOrFail(auth()->user()->id);

        return view('dashboard.admin.settings', compact('user'));
    }

    public function updateUserLogin(Request $request, User $user)
    {
        $validate = $request->validate([
            'nama' => 'required|string',
            'username' => ['required','string', Rule::unique('users')->ignore($user->id)],
            'password' => 'required|string',
            'confirm_password' => 'required|same:password',
        ]);

        if($request->password == $user->password) {
            $user->update([
                'nama' => $request->nama,
                'username' => $request->username,
            ]);
        }
        else {
            $user->update([
                'nama' => $request->nama,
                'username' => $request->username,
                'password' => bcrypt($request->password)
            ]);
        }


        Alert::toast('<p style="color: white; margin-top: 10px;">User '.$user->username.' berhasil diperbarui</p>','success')
        ->toHtml()
        ->background('#212529')
        ->position($position = 'bottom-right');

        return redirect()->route('settings.index');
    }
}
