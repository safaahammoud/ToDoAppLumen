<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

    public function register(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
            'firstName' =>'required',
            'lastName'=>'required',
            'gender'=>'nullable',
            'mobileNumber'=>'nullable',
            'birthday'=>'nullable|date'
        ]);
        $user = new User;
        $user->fill($request->all());
        $user->password=Hash::make($request->password);
        $user->save();
        return response()->json([
            'message'=>'user registered successfullyy'
        ]);
    }
    /**
     * Authenticate user
     *
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->input('email'))->first();

        if(Hash::check($request->input('password'), $user->password)){

            $apikey = base64_encode(Str::random(40));
            User::where('email', $request->input('email'))->update(['api_key' => "$apikey"]);;

            return response()->json(['status' => 'success','api_key' => $apikey]);
        }else{

            return response()->json(['status' => 'fail'],401);
        }
    }
}
