<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Users\RegisterUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * @OA\Info(
 *    title="H/F Platform API",
 *    version="1.0.0",
 *    description="H/F Platform API",
 *    @OA\Contact(name="Dayan Betancourt", email="dayan@hf.cx"),
 *    @OA\License(name="MIT license", url="https://opensource.org/licenses/MIT")
 * )
 * 
 * @OA\Server(url="https://hfglobal.hfmaracay.com/")
 */
class AuthController extends Controller
{
  /**
   * Store a new user
   *
   * @param  \App\Http\Requests\API\Users\RegisterUserRequest  $request
   * @return \Illuminate\Http\Response
   * 
   * @OA\Post(
   *    path="/api/register",
   *    tags={"auth"},
   *    summary="Register User",
   *    @OA\Parameter(name="name", in="query", description="User's Name", required=true),
   *    @OA\Parameter(name="email", in="query", description="User's Email", required=true),
   *    @OA\Parameter(name="password", in="query", description="User's Password", required=true),
   *    @OA\Response(response=200, description="Register User")
   * )
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
   * 
   * @OA\Post(
   *    path="/api/login",
   *    tags={"auth"},
   *    summary="Login User",
   *    @OA\Parameter(name="email", in="query", description="User's Email", required=true),
   *    @OA\Parameter(name="password", in="query", description="User's Password", required=true),
   *    @OA\Response(response=200, description="Login User")
   * )
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
   * 
   * @OA\Post(
   *    path="/api/logout",
   *    tags={"auth"},
   *    summary="Logout User",
   *    @OA\Response(response=200, description="Logout User")
   * )
   */
  public function logout()
  {
    auth()->user()->tokens()->delete();

    return response()->json([
      'message' => 'You have successfully logged out and the token was successfully deleted'
    ]);
  }
}
