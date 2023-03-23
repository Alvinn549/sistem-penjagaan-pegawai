<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.admin.admin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $validate = $request->validate([
         'nama' => 'required|string',
         'username' => 'required|string|unique:users',
         'password' => 'required|string|min:8',
         'confirm_password' => 'required|same:password',
     ]);

       $admin = User::create([
         'nama' => $request->nama,
         'username' => $request->username,
         'password' => bcrypt($request->password),
         'level' => 'admin',
     ]);

       Alert::toast('<p style="color: white; margin-top: 10px;">'.$admin->nama.' berhasil disimpan</p>','success')
       ->toHtml()
       ->background('#212529')
       ->position($position = 'bottom-right');

       return redirect()->route('admin.index');
   }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $admin)
    {
        return view('dashboard.admin.user-edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $admin)
    {
        $validate = $request->validate([
            'nama' => 'required|string',
            'username' => ['required','string', Rule::unique('users')->ignore($admin->id)],
            'password' => 'required|string',
            'confirm_password' => 'required|same:password',
        ]);

        if($request->password == $admin->password) {
            $admin->update([
                'nama' => $request->nama,
                'username' => $request->username,
            ]);
        } else {
            $admin->update([
                'nama' => $request->nama,
                'username' => $request->username,
                'password' => bcrypt($request->password)
            ]);
        }


        Alert::toast('<p style="color: white; margin-top: 10px;">User '.$admin->username.' berhasil diperbarui</p>','success')
        ->toHtml()
        ->background('#212529')
        ->position($position = 'bottom-right');

        return redirect()->route('admin.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $admin)
    {
        if ($admin->id == auth()->user()->id) {
            Alert::warning('Peringatan','Saat ini anda masih login ! ');
            return redirect()->route('admin.index');
        }

        $admin->delete();

        Alert::toast('<p style="color: white; margin-top: 10px;">'.$admin->nama.' berhasil dihapus</p>','success')
        ->toHtml()
        ->background('#212529')
        ->position($position = 'bottom-right');

        return redirect()->route('admin.index');
    }
}
