<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $this->validate($request,[
            'email'=>'required|email|max:50',
            'password'=>'required'
        ]);

        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            $token = auth()->user()->createToken("{$request->email}-token");
            return response()->json(['firstname'=>auth()->user()->first_name,'last_name'=>auth()->user()->last_name,'email'=>auth()->user()->email,'token'=>$token->plainTextToken, 'userType'=>auth()->user()->user_type,'id'=>auth()->user()->id]);
        }else{
            return response()->json(['error'=>'Invalid email or password'],400);
        }
    }
}
