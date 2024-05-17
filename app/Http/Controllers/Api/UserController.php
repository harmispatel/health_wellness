<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
    public function register(Request $request){
        try {
           $input = $request->except('password');

           $userEmail = User::where('email',$request->email)->first();

         
           if(isset($request->name) && !empty($request->name) && isset($request->email) && !empty($request->email) && isset($request->password) && !empty($request->password)){
                if($userEmail){
                    return $this->sendResponse(null,'Email already exists!',false);
                }else{
                    $input['password'] = Hash::make($request->password);
                    $input['role_id'] = 3;
        
                    $regsitrData = User::create($input);
                       
                    return $this->sendResponse($regsitrData,'Data Registered successfully',true);
                }
            
           }else{
            return $this->sendResponse(null,'All fields are required',false);
           }


        } catch (\Throwable $th) {
           
            return $this->sendResponse(null,'Something Went wrong',false);
        }
    }
    public function login(Request $request){
          try {
            $email = $request->email;
            $password = $request->password;

            $userData = User::where('email',$email)->first();

            if(!$userData){
                return $this->sendResponse(null, 'Invalid Email and Password!!', false);
            }

            if(Hash::check($password, $userData->password)){
                 if($userData->status == 1){
                    $token = $userData->createToken('token')->plainTextToken;
                   
                    $userData->token = $token;
                    return $this->sendResponse($userData,'User login SuccessFully!',true);
                 }else{
                    return $this->sendResponse(null,'User Not Activated!',false);
                 }    
            }else{
                return $this->sendResponse(null,'Invalid Email and Password!!',false);
            }
          } catch (\Throwable $th) {
            return $this->sendResponse(null,'Internal server error',false);
          }
    }

    public function getUsers(){

        try {
            $users = User::get();
            $userData = $users->map(function ($user){
                    return $this->userData($user);
            });

            return $this->sendResponse($userData,"User Data Received Successfully",true);
        } catch (\Throwable $th) {
            return $this->sendResponse(null,"something Went Wrong",false);
        }
    }

    public function userData($userData){

       $data['id'] = $userData->id;
       $data['name'] = $userData->name;
       $data['email'] = $userData->email;
       $data['gender'] = $userData->gender;
       $data['role_id'] = $userData->role_id;
       $data['status'] = $userData->status;
       $data['image'] = asset('public/images/uploads/user_images/' .$userData->image);
       $data['remember_token'] = $userData->remember_token;

       return $data;

    }

    public function getAdvertisementPicture(){
        try {
           $advertisement = Setting::first();

           $picture = isset($advertisement->advertise_image) ? asset('public/images/uploads/advertise_image/' . $advertisement->advertise_image) : asset('public/images/uploads/user_images/no-image.png');

           return $this->sendResponse($picture,'Advertisement retrived successfully1',true);
        } catch (\Throwable $th) {
            return $this->sendResponse(null,'Something Went wrong',false);
        }
    }
}
