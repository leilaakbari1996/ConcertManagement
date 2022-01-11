<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function store(LoginRequest $request){
        /**
         * @var User $user
         */
        $user = User::query()->where('email',$request->get('email'))->first();
        if(!Hash::check($request->get('password'),$user->password)){
           return response()->json([
               'data' => [
                   'msg' => 'warrning password'
               ]
           ])->setStatusCode(401);
        }
        $user->tokens()->delete();
        $permissions = $user -> role -> permissions()->pluck('title')->toArray();

        return response()->json([
            'data' => [
                'token' => $user->createToken('access_tokens',
                       $permissions
                )->plainTextToken
            ]
        ]);
    }
    public function destroy(Request $request){
         /**
         * @var User $user
         */
        $user = $request->user();
        $user->tokens()->delete();
        return response()->json([
            'data' => [
                'msg' => 'you are logged out.'
            ]
        ])->setStatusCode('200');
    }
}
