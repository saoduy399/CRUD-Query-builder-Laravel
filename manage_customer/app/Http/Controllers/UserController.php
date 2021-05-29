<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = DB::table("manage_customer")->get()->reverse();
        return view("user.list", compact("users"));
    }

    public function showCreateUserForm()
    {
        return view("user.create");
    }

    public function createUser(Request $request)
    {
        $users = [
            [
                'name' => $request->name,
                'dob' => $request->dob,
                'email' => $request->email,
            ]
        ];
        DB::table("manage_customer")->insert($users);
        return redirect()->route("user.index");
    }

    public function deleteUser($id)
    {
//      DB::table("manage_customer")->where('id', $id)->delete();
        DB::table("manage_customer")->delete($id);
        return redirect()->route("user.index");
    }

    public function showFormUpdate($id)
    {
        $user = DB::table("manage_customer")->where('id', '=', $id)->get();
        return view("user.update", compact("user"));
    }

    public function update(Request $request)
    {
        DB::table("manage_customer")->where('id', $request->id)->update([
            'name' => $request->name,
            'dob' => $request->dob,
            'email' => $request->email,
        ]);
        return redirect()->route("user.index");
    }


}
