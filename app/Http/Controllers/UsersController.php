<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Users;


/**
 * In this controller, I created an authenticate model which checks whether the user is valid.
 * If the user is valid, it returns an API key.
 * If not, it returns a fail error with the response code 401.
*/

class UsersController extends Controller
{
    public function __construct()
    {
        //  $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = Users::where('email', $request->input('email'))->first();

        if(Hash::check($request->input('password'), $user->password)){

            $apikey = base64_encode(str_random(40));
            Users::where('email', $request->input('email'))->update(['api_key' => "$apikey"]);;

            return response()->json(['status' => 'success','api_key' => $apikey]);
        }else{

            return response()->json(['status' => 'fail'],401);
        }
    }
}
