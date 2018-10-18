<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\user;

class UsersController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        $validator = Validator::make(

            $request->all(),

            [
                'name' => 'required|max:20',
                'email' => 'unique:users|required|email|max:100',
                'password' => 'required|max:16'
            ]

//            [
//                'required' => 'The :attribute field is required.'
//            ]
        );

        if ($validator->fails()) {
            $error_message = $validator->errors()->first();
            return response(['results' => 'false', 'error' => $error_message]);
        }

        User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->passoword),
            ]
        );

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
