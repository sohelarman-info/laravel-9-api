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

    // Post API for single user add
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

    // Post API for multiple user add
    public function AddMultipleUser(Request $request){
        if($request->ismethod('post')){
            $data = $request->all();
            // return $data;

            $rules = [
                'users.*.name'      => 'required',
                'users.*.email'     => 'required|email|unique:users',
                'users.*.password'  => 'required',
            ];

            $customMessage = [
                'users.*.name.required' => 'Name is required',
                'users.*.email.required' => 'Email is required',
                'users.*.email.email' => 'Email must be valid',
                'users.*.email.unique' => 'Email already exist',
                'users.*.password.required' => 'Password is required',
            ];

            $validator = Validator::make($data, $rules, $customMessage);
            if($validator->fails()){
                return response()->json($validator->errors(), 422);
            }

            foreach($data['users'] as $addUser){
                $user = new User();
                $user->name = $addUser['name'];
                $user->email = $addUser['email'];
                $user->password = bcrypt($addUser['password']);
                $user->save();
                $message = 'User added successfully done!';
            }

            return response()->json(['message'=>$message],201);

        }
    }

        // Put API for update user details
        public function updateUserDetails(Request $request, $id){
            if($request->ismethod('put')){
                $data = $request->all();
                // return $data;

                $rules = [
                    'name'      => 'required',
                    'password'  => 'required',
                ];

                $customMessage = [
                    'name.required' => 'Name is required',
                    'password.required' => 'Password is required',
                ];

                $validator = Validator::make($data, $rules, $customMessage);
                if($validator->fails()){
                    return response()->json($validator->errors(), 422);
                }

                $user = User::findOrFail($id);
                $user->name = $data['name'];
                $user->password = bcrypt($data['password']);
                $user->save();
                $message = 'User update successfully done!';
                return response()->json(['message'=>$message],202);

            }
        }


}
