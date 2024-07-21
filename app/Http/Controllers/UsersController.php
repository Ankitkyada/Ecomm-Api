<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
   
    public function registerUser(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                // 'full_name' => 'required',
                // 'email' => 'required|email|unique:users,email',
                // 'password' => 'required|confirmed|string|min:8|max:16|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-])/',
                // 'phone_number' => 'required|numeric|unique:users,phone_number',
            ]);

            // if ($validator->fails()) {
            //     return commonResponse(422, false, $validator->errors());
            // }

            $userdetailes = Users::registerUser($request);
            if ($userdetailes !== false) {
                return commonResponse(200, true, 'Successfully !', $userdetailes, 0);
            } else {
                return commonResponse(404, false, 'something went wrong!');
            }
        } catch (Exception $e) {
            report($e);
            return commonResponse($e->getCode(), false, $e->getMessage());
        }
    }

    public function verifyLoginUser(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users,email',
                'password' =>'required|string|min:8|max:16|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-])/'
            ]);

            if ($validator->fails()) {
                return commonResponse(422, false, $validator->errors(),[],0);
            }

            $verifyuser = Users::verifyLoginUser($request);
            if ($verifyuser !== false) {
                return commonResponse(200, true, 'Successfully ! verify login user!', $verifyuser, 0);
            } else {
                return commonResponse(422, false, 'Your Email or Password is Invalid.Try Again!',[],0);
            }
        } catch (Exception $e) {
            report($e);
            return commonResponse($e->getCode(), false, $e->getMessage());
        }
    }

    public function forgotPassword(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
            'email' => 'required|exists:users,email',
            ],[
                'email.exists' => 'Email not found.',
        ]);

        if ($validator->fails()) {
            return commonResponse(422, false, $validator->errors());
        }
        
            $verifyuser = Users::forgotPassword($request);
            if ($verifyuser !== false) {
                return commonResponse(200, true, 'Successfully Send Mail!',[], 0);
            } else {
                return commonResponse(404, false, 'something went wrong!');
            }
        } catch (Exception $e) {
            report($e);
            return commonResponse($e->getCode(), false, $e->getMessage());
        }
    }

    public function verifyOtp(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users,email',
                'otp' => 'required|digits:6|exists:users,otp'
            ]);

            if ($validator->fails()) {
                return commonResponse(422, false, $validator->errors());
            }
            $userotp = Users::verifyOtp($request);
            if ($userotp !== false) {
                return commonResponse(200, true, 'Successfully ! verify your otp', $userotp, 0);
            } else {
                return commonResponse(422, false, 'Otp is Invalid or Expired',[],0);
            }
        } catch (Exception $e) {
            report($e);
            return commonResponse($e->getCode(), false, $e->getMessage());
        }
    }
    public function createNewPassword(Request $request,$id=null)
    {
        try {
            $validator = Validator::make($request->all(), [
                'password' => 'required|confirmed|string|min:8|max:16|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-])/'],
                [
                    'password.confirmed' => 'Password confirmation does not match.',
                    'password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, one digit, and one special character (#?!@$%^&*-).',
                ]);
                
            if ($validator->fails()) {
                return commonResponse(422, false, $validator->errors());
            }

            $newpassword = Users::createNewPassword($request,$id);
            if ($newpassword !== false) {
                return commonResponse(200, true, 'Successfully created a new password!',[], 0);
            } else {
                return commonResponse(422, false, 'Your new password is the same as your old password. Please choose a different password.',[],0);
            }
        } catch (Exception $e) {
            report($e);
            return commonResponse($e->getCode(), false, $e->getMessage());
        }
    }
    public function profileDetails($id)
    {
        try {
            $data = Users::profileDetails($id);
            if ($data) {
                return commonResponse(200, true, 'Success!', $data, 1);
            } else {
                return commonResponse(404, false, 'Something went wrong!');
            }
        } catch (Exception $e) {
            report($e);
            return commonResponse($e->getCode(), false, $e->getMessage());
        }
    } public function updateProfile(Request $request,$id=null)
    {
        try {
            $validator = Validator::make($request->all(), [
                'full_name' => 'required',
                'create_username' => 'required',
                'phone_number' => 'required',
            ]);

            if ($validator->fails()) {
                return commonResponse(422, false, $validator->errors());
            }

            $updateProfile = Users::updateProfile($request,$id);
            if ($updateProfile) {
                return commonResponse(200, true, 'Successfully Updated Profile!', $updateProfile, 0);
            } else {
                return commonResponse(404, false, 'something went wrong!');
            }
        } catch (Exception $e) {
            report($e);
            return commonResponse($e->getCode(), false, $e->getMessage());
        }
    }
}