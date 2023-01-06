<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Validator;




class UserApiController extends Controller
{
    // Get API Controller
    public function ShowUser($id=null){
        if($id == ""){
            $users = User::get();
            return response()->json(['users'=>$users],200);
        }else{
            $users = User::find($id);
            return response()->json(['users'=>$users],200);
        }
    }

    // Post API Controller
    public function AddUser(Request $request){
        if($request->ismethod('post')){
            $data = $request->all();
            // return $data;

            $rules = [
                'name'      => 'required',
                'email'     => 'required|email|unique:users',
                'password'  => 'required',
            ];

            $customMessage = [
                'name.required' => 'Name is required',
                'email.required' => 'Email is required',
                'email.email' => 'Email must be valid',
                'email.unique' => 'Email already exist',
                'password.required' => 'Password is required',
            ];

            $validator = Validator::make($data, $rules, $customMessage);
            if($validator->fails()){
                return response()->json($validator->errors(), 422);
            }

            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->save();
            $message = 'User added successfully done!';
            return response()->json(['message'=>$message],201);

        }
    }
}
