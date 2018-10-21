<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
//use Illuminate\Contracts\Hashing;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Dirape\Token\Token;
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
                'name' => 'required|string|max:20',
                'email' => 'unique:users|required|string|email|max:100',
                'password' => 'required|string|min:6|max:16',
            ]

        );

        if ($validator->fails()) {
            $error_message = $validator->errors()->first();
            return response(['results' => 'false', 'response' => $error_message]);
        }

        User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'api_token' => (new Token())->unique('users', 'api_token', 32),
            ]
        );
        $user = User::get(['api_token','email'])->where('email', '=', $request->email)->first();

        return response(['result' => 'true', 'response' => $user]);
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
