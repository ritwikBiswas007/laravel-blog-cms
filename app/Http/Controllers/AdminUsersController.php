<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserEditRequest;
use Spatie\Permission\Models\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::paginate(10);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $roles = Role::pluck('name', 'name')->all();

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $input = null;


        if ($request->cover == null) {
            $input = $request->except('cover');
            $input['password'] = Hash::make($request->password);
        } else {
            $input = $request->all();
            $input['password'] = Hash::make($request->password);
        }

        $user = User::create($input);
        $user->assignRole($input['role_id']);
        session()->flash('updated_user', 'The User Has Been Created Successfully');
        return redirect('/user');
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
    public function edit($id)
    {

        $roles = Role::all();
        $user = User::findorFail($id);

        return view('admin.users.edit', compact('roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {

        $user = User::findOrFail($id);

        $input = null;

        if ($request->password == null) {
            $input = $request->except('password');
        } else {
            $input = $request->all();
        }

        $user->update($input);
        $user->syncRoles($input['role_id']);
        session()->flash('updated_user', 'The User Has Been Updated Successfully');
        return redirect('/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->cover != "/images/defaultAvatar.png") {


            unlink(public_path() . $user->cover);
        }

        $user->removeRole($user->roles->first());

        $user->delete();

        session()->flash('deleted_user', 'The user has been deleted successfully');

        return redirect('/user');
    }
}
