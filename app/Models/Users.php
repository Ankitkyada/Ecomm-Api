<?php

namespace App\Models;


use Exception;
use App\Traits\Uuids;
use Illuminate\Support\Carbon;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    use HasFactory;
    use HasApiTokens;
    use Uuids;
    use SoftDeletes;


    protected $table = 'users';
    protected $primarykey = 'id';
    protected $keyType = 'string';
    public $incremeting = false;
    protected $fillable = ['full_name','email', 'password','otp','phone_number', 'is_active','otp_created_at','created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_at', 'deleted_by'];

    public static function registerUser($request)
    {
        try {
      
            $user = new Users;
            $user->full_name = $request->full_name;
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;
            $user->password = bcrypt($request->password);
            $user->created_by = 1;
            $user->updated_by = 1;
            $user->save();


            return $user->id;
        } catch (Exception $e) {
            report($e);
            return false;
        }
    }

    public static function verifyLoginUser($request)
    {
        try {
            $verifyuser = Users::Where('email', $request->email)->first();

            if (!is_null($verifyuser)) {
                if (Hash::check($request->password, $verifyuser->password)) {
                    $accessToken = $verifyuser->createToken('Access Token')->accessToken;
                }
            }
            return [
                'userId' => $verifyuser->id,
                'uname' =>$verifyuser->full_name,
                'email'=>$verifyuser->email,
                'phone_number'=>$verifyuser->phone_number,
                'accessToken' => $accessToken,
            ];
        } catch (Exception $e) {
            report($e);
            return false;
        }
    }
    public static function forgotPassword($request)
    {
        try {
            $verifyuser = Users::Where('email', $request->email)->first();
 
            if (!is_null($verifyuser)) {
                $securitycode = rand(100000, 999999);
                $verifyuser->otp = $securitycode;
                $verifyuser->otp_created_at=Carbon::now()->addSeconds(3000);
                $verifyuser->save();
            }
            return true;
        } catch (Exception $e) {
            report($e);
            return false;
        }
    }

    public static function verifyOtp($request)
    {
        try {
            $current_time = Carbon::now()->format('Y-m-d H:i:s');
            $verify_otp = Users::where('email', $request->email)->where('otp_created_at', '>', $current_time)->first();
            if ($verify_otp) {
                $allow_user=Users::select('id')->where('email', $request->email)->orwhere('otp', $request->otp)->first();
                if ($allow_user) {
                    $allow_user->otp = null;
                    $allow_user->save();
                }
            }else{
                return false;
            }
            return $allow_user->id;
        } catch (Exception $e) {
            report($e);
            return false;
        }
    }

    public static function createNewPassword($request, $id = null)
    {
        try {
            $newpassword = Users::find($id);
            if (Hash::check($request->password, $newpassword->password)) {
                return false;
            }
        
            $newpassword->password = bcrypt($request->password);
            $newpassword->save();
            return true;
        } catch (Exception $e) {
            report($e);
            return false;
        }
    }

    public static function profileDetails($id)
    {
        try {
            $detail = Users::select('full_name','email','phone_number')->where('id', $id)->get();
            return $detail;
        } catch (Exception $e) {
            report($e);
            return false;
        }
    }

    public static function updateProfile($request,$id=null)
    {
        try {
            $profile = Users::find($id);
            $profile->full_name = $request->full_name;
            $profile->phone_number = $request->phone_number;
            $profile->created_by = Auth::user()->id;
            $profile->updated_by = Auth::user()->id;
            $profile->save();

            return [
                'id' => $profile->id,
                'full_name' => $profile->full_name,
                'create_username' => $profile->create_username, 
                'phone_number'=>$profile->phone_number
            ];
        } catch (Exception $e) {
            report($e);
            return false;
        }
    }
}