<?php

namespace App\Http\Controllers;
use App\Appointment;
use App\Like;
use App\Pcomment;
use App\Models\phone;
use App\Puser;
use App\Schedule;


use App\Models\Ppost;
use App\Shelter;
use App\Vet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Session;
use Illuminate\Support\Facades\Password;


class puserController extends Controller
{
    public function show()
    {
        $Pusers = Puser::all();
        return response()->json($Pusers);
    }

    public function register(Request $request)
    {
        $file_extension=$request->photo->getClientOriginalExtension();
        $file_name=time().'.'.$file_extension;
        $path='image/user';
        $request->photo->move($path,$file_name);

        $Validator = Validator::make($request->all(), [
            'name' => 'required | max :190 |string |Alpha',
            'e_mail' => 'required | max: 190 |unique:Pusers',
            'password' => 'required | max :19 | string|min:6',
            'phone' => 'max:11 |min:11']);
        if ($Validator->fails()) {
            return $Validator->errors();
        } else {

            $Pusers = Puser::create(
                [
                    'name' => $request->name,
                    'e_mail' => $request->e_mail,
                    'phone' => $request->phone,
                    'gender' => $request->gender,
                    'photo' => $file_name,
                    'password' => $request->password,
                    'age' => $request->age,
                    // 'api_token' => Str::random(60),
                ]
            );

            return $Pusers;
        }
    }

    public function delete($id)
    {
        $Pusers = Puser::where('id', $id);
        $Pusers->delete();
        return 'done';
        //  return redirect()->back();
    }


    /* public function login(Request $request)
     {
         request()->validate([
             'e_mail' => 'required',
             'password' => 'required',
         ]);
         $credentials = $request->only('e_mail', 'password');
         if (Auth::attempt($credentials)) {
             return $credentials;
         }
         return "no";

     }*/

    /*if(auth() -> attempt([
       $Pusers =new Puser(),
      $Pusers->e_mail =$request->input('e_mail'),
      // 'e_mail'=>$request ->input('e_mail'),
      $Pusers->password =$request->input('password')
       //'password '=>$request ->input('password')
   ])){
       //$Pusers=auth()->Puser;
       $Pusers->api_token=Str::random(60);
     //  $Pusers->save();
       return $Pusers;
       {
   return 'no';
       }}}}*/
    public function addpost(Request $request)
    {
        $user = Puser::where('id', '=', $request->user_id)->get();
        if ($user->count() != 0) {
            $Ppost = new Ppost();
            $Ppost->post = $request->input('post');
            //$Ppost->user_email=$user->e_mail;
            // $Ppost->user_email=$user->e_mail;
            $user->posts()->attach($request->input('user_email'));
            return $Ppost;
            //return DB::Puser('e_mail')->get();

        } else {
            return 0;
        }

    }


    public function searchpost(Request $request)
    {
        $data = $request->input('post');
        $Validator = Validator::make($request->all(), [
            'post' => 'required | min:3']);
        if ($Validator->fails()) {
            return $Validator->errors();
        } else {
            $Ppost = Ppost::where('post', 'like', "%{$data}%")->get();

            return response()->json($Ppost);
        }
    }

    public function insertpost(Request $request)
    {
        $data = $request->input('id');

        $user = Puser::find($data);

        $post = new Ppost();
        $post->post = $request->input('post');;

        $user = $user->posts()->save($post);
        return ('3aaaaaaash');
    }

    public function signin(Request $request)
    {
        $request->validate([
            'e_mail' => 'required|string',
            'password' => 'required|string'
        ]);
        $credentials = request(['e_mail', 'password']);
//        if (!Auth::attempt($credentials)) {
//            return response()->json([
//                'message' => 'Invalid Email Password'
//            ], 401);
//        }

        $Pusers = $request->Puser();
        $token = $Pusers->createToken('api_token');
        $Pusers->api_token = $token->api_token;

        return response()->json([
            "Puser" => $Pusers
        ], 200);
    }


    /*
        public function login(Request $request)
        {
            {
                $request->validate([
                    'e_mail' => 'required|string',
                    'password' => 'required|string'
                ]);
                $credentials = request(['e_mail', 'password']);
                try {
                    if (!JWTAuth::attempt($credentials))
                        $response['status'] = 0;
                    $response['code'] = 401;
                    $response['data'] = null;
                    $response['message'] = 'Email or password is incorrect';

                }catch (JWTException $e){
            $response['data'] = null;
            $response['code'] = 500;
            $response['message'] = 'couldnt create token';
            }
            $Pusers= auth('puser_api')->Puser();
            $data['token']=auth()->claims([
                'user_id'=>$Pusers->id,
                'e_mail'=>$Pusers->e_mail])->attempt($credentials);
            $response['data']=$data;
            $response['status']=1;
            $response['code']=200;
            $response['message']='login successfully';
            return $response->json($response);


            }
            {
    */

    public function login(REQUEST $request)
    {
        $request->validate([
            'e_mail' => 'required|string',
            'password' => 'required|'
        ]);

        $Pusers = Puser::where('e_mail', '=', $request->e_mail)
            ->where('password', '=', $request->password)
            ->get();

        if ($Pusers->count() != 0) {
            Session::put('login', 'login');
            return $Pusers;
        } else {
            return 0;
        }

    }

    public function allposts()
    {
        $posts = Ppost::all();
        return response()->json($posts);
    }


    public function verify(Request $request)
    {
        $Pusers = Puser::where('e_mail', $request->e_mail)->get();
        if ($Pusers->count() != 0) {
            return 1;
        } else {
            return 0;
        }

    }

    public function updatepassword($e_mail, Request $request)
    {
        $Pusers = Puser::find($e_mail);
        $Pusers->password = $request->input('New_password');
        $Validator = Validator::make($request->all(), [
            'password' => 'required | max :19 | string|min:6']);
        if ($Validator->fails()) {
            return $Validator->errors();
        } else {
            //$Pusers->password = $request->input('New_password');
            //  Hash::make($request->password);

            $Pusers->update();


        }
    }

    public function update($id, Request $request)
    {
        $Pusers = Puser::find($id);
        $Validator = Validator::make($request->all(), [
            'new_password' => 'required | max :19 | string|min:6']);
        if ($Validator->fails()) {
            return $Validator->errors();
        } else {

            $Pusers->password = $request->input('new_password');
            $Pusers->update();
            return response()->json('Done');
        }
    }


    public function insertcomment(Request $request)
    {
        $data = $request->input('user_id');
        $var = $request->input('post_id');
        $user = Puser::find($data);
        $post = Ppost::find($var);

        $comment = new Pcomment();
        $comment->comment = $request->input('comment');
        $post = $post->comment()->save($comment);

        $user = $user->posts()->save($comment);
        return ('3aaaaaaash');
    }

    public function makeappointment(Request $request)
    {
        $data = $request->input('user_id');
        $var = $request->input('shedule_id');
        $user = Puser::find($data);
        $phone = Puser::select('phone')->where('id','=',$data)->get();
        $shedule = Schedule::find($var);

        $foo = (string)$phone;
        $appointment= new Appointment();
        $appointment->mobile =$foo;
        //$appointment->save();
        $shedule = $shedule->appointment()->save($appointment);
        $user = $user->appointment()->save($appointment);
        return ('good');
    }
    public function allshelters()
    {
        $shelter=Shelter::all();
        return ($shelter);
    }
    public function addlike(Request $request)
    {
        $data = $request->input('user_id');
        $var = $request->input('post_id');
        $user = Puser::find($data);
        $post = Ppost::find($var);

        $like = new Like();
        $post = $post->likes()->save($like);

        $user = $user->likes()->save($like);
        return ('3aaaaaaash');

    }
    public function postlikes(Request $request) //return the users that like the post
    {
        $data = $request->input('post_id');
        $Like= Like::where('post_id','=',$data)->get();
       return $Like;

    }

}


