<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request) {
        $creds = $this->basicAuthCreds($request);
        if (Auth::once($creds)) {
            return response()->json(['data'=>Auth::user()->createToken('access')]);
        }
        return response()->json(['code'=> 401, 'message'=>'Your email and password do not match a user.'], 401);
    }

    private function basicAuthCreds(Request $request) {
        $credArr = explode( ':', base64_decode( explode( " ", $request->header('Authorization') )[1] ) );
        $creds = [
            'email' => $credArr[0],
            'password' => $credArr[1],
        ];
        return $creds;
    }
}
