<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Puser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{
   /* public function login(Request $request){
        $request->validate([
            'e_mail'=> 'required|string',
            'password'=> 'required|string'
        ]);
        $credentials = request(['e_mail','password']);
        if(!Auth::attempt($credentials)){
            return response()-> json([
                'message' => 'Invalid Email Password'
            ],401);
        }

        $Pusers = $request->Puser();
        $token= $Pusers-> createToken('Access Token');
        $Pusers->access_token = $token->accessToken;

        return response()-> json([
            "Puser"=>$Pusers
        ],200);*/
    public function login(Request $request)
    {

        try {
            $rules = [
                "e_mail" => "required",
                "password" => "required"

            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            //login

            $credentials = $request->only(['email', 'password']);

            $token = Auth::guard('puser-api')->attempt($credentials);  //generate token

            if (!$token)
                return $this->returnError('E001', 'بيانات الدخول غير صحيحة');

            $pusers = Auth::guard('puser-api')->Puser();
            $pusers ->api_token = $token;
            //return token
            return $this->returnData('puser', $pusers);  //return json response

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }





///Registeration
    public function signup (Request $request){

       // $request->validate([
            $Validator = Validator::make($request->all(),[
             'name' => 'required | max :190 |string |Alpha',
            'e_mail' => 'required | string | email| max: 190 |unique:Pusers',
            'password' => 'required | max :19 | string|min:6 |confirmed',
            'phone' => 'max:11 |min:11']);
        if ($Validator->fails()) {
            return $Validator->errors();
        }
        $Pusers = new Puser(
            [
                'name' => $request->name,
                'e_mail' => $request->e_mail,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'photo' => $request->photo,
                'password' => Hash::make($request->password),
                'age' => $request->age,
                'api_token' => Str::random(60),
            ]
        );

        //$Pusers->save();
        return $Pusers;
       // return response()->json([
         //   "message" => "User Register successfully"
        //],201);
    }


    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            "message"=>"user logout successfully"
        ],200);
    }


   // public function index(Request $request){

  //      return response()->json([
  //          "Pusers" => $request->Puser()
  //      ], 200);
    //}



}
