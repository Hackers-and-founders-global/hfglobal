<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Users\RegisterUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
  /**
   * Store a new user
   *
   * @param  \App\Http\Requests\API\Users\RegisterUserRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function register(RegisterUserRequest $request)
  {
    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password)
    ]);

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
      'data' => $user,
      'access_token' => $token,
      'token_type' => 'Bearer'
    ]);
  }

  /**
   * Login user
   * 
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function login(Request $request)
  {
    if (!Auth::attempt($request->only('email', 'password')))
    {
      return response()->json(['message' => 'Unauthorized'], 401);
    }

    $user = User::where('email', $request['email'])->firstOrFail();

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
      'message' => 'Hi '.$user->name.', welcome to home',
      'access_token' => $token,
      'token_type' => 'Bearer'
    ]);
  }

  /**
   * Logout user
   * 
   * @return \Illuminate\Http\Response
   */
  public function logout()
  {
    auth()->user()->tokens()->delete();

    return response()->json([
      'message' => 'You have successfully logged out and the token was successfully deleted'
    ]);
  }
}
