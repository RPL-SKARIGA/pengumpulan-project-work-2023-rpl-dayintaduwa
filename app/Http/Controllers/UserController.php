<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')
        ->select('users.id', 'users.username', 'users.name', 'users.address', 'users.phone', 'users.status', 'users.role_id', 'roles.name as role_name')
        ->join('roles', 'roles.id', 'users.role_id')
        ->where('users.id', '!=', auth()->user()->id)->get();

        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        return view('user.create', compact('roles'));
    }

    /**
     * Handle account registration request
     * 
     * @param UserRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {

        if($request->validated()) {
            $imageName = null;
            if($request->photo) {
                $imageName = time().'.'.$request->photo->extension();  
                $request->photo->move(public_path('images'), $imageName);
            }

            User::create([
                'username' => $request->username,
                'password' => $request->password,
                'name' => $request->name,
                'photo' => $imageName,
                'address' => $request->address,
                'phone' => $request->phone,
                'status' => $request->status,
                'role_id' => $request->role_id,
            ]);
            return redirect()->route('user.index')->with('success','User has been created successfully.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = DB::table('users')
        ->select('users.id', 'users.username', 'users.name', 'users.photo', 'users.address', 'users.phone' , 'users.status' , 'users.role_id', 'roles.name AS role' )
        ->join('roles', 'roles.id', 'users.role_id')
        ->where(['users.id' => $id])
        ->get();

        return view('user.detail', ['user' => $user[0]]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('user.update', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);

        if($request->validated()) {
            $imageName = null;
    
            if($request->photo) {
                $imageName = time().'.'.$request->photo->extension();  
                $request->photo->move(public_path('images'), $imageName);
            }

            if($request->password) {
                $user->update([
                    'username' => $request->username,
                    'password' => $request->password,
                    'name' => $request->name,
                    'photo' => $imageName,
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'status' => $request->status,
                    'role_id' => $request->role_id,
                ]);
            } else {
                $user->update([
                    'username' => $request->username,
                    'name' => $request->name,
                    'photo' => $imageName,
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'status' => $request->status,
                    'role_id' => $request->role_id,
                ]);
            }
            return redirect()->route('user.index')->with('success','User has been updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->delete()) {
            return redirect()->route('user.index')->with('success', 'Deleted!');
        }

        return redirect()->route('user.index')->with('error', 'Sorry, unable to delete this!');
    }
}
