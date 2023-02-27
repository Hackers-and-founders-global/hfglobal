<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Users\RegisterUserRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
 * @OA\Server(url="https://hfglobal.hf.cx/", description="Test Server")
 * @OA\Server(url="http://hfglobal.local:8080/", description="Local Server")
 * 
 * @OA\SecurityScheme(
 *    securityScheme="sanctum",
 *    in="header",
 *    name="Authorization",
 *    type="http",
 *    scheme="bearer"
 * )
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
   *    @OA\Parameter(name="firstname", in="query", description="User's First name", required=true),
   *    @OA\Parameter(name="lastname", in="query", description="User's Last name", required=true),
   *    @OA\Parameter(name="email", in="query", description="User's Email", required=true),
   *    @OA\Parameter(name="password", in="query", description="User's Password", required=true),
   *    @OA\Parameter(name="gender", in="query", description="User's Gender", required=false),
   *    @OA\Parameter(name="birthdate", in="query", description="User's Birthdate", required=false),
   *    @OA\Parameter(name="phone", in="query", description="User's Phone", required=false),
   *    @OA\Parameter(name="website", in="query", description="User's Website", required=false),
   *    @OA\Parameter(name="occupation", in="query", description="User's Occupation", required=true),
   *    @OA\Response(response=200, description="Register User")
   * )
   */
  public function register(RegisterUserRequest $request)
  {
    $birthdate = null;
    if (isset($request->birthdate)) {
      $birthdate = Carbon::createFromFormat('Y-m-d', $request->birthdate);
    }

    try {
      $user = User::create([
        'firstname' => $request->firstname,
        'lastname' => $request->lastname,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'gender' => $request->gender ?? 'O',
        'birthdate' => $birthdate,
        'phone' => $request->phone ?? null,
        'website' => $request->website ?? null,
        'occupation_id' => $request->occupation
      ]);
    } catch (\Throwable $th) {
      return response()->json([
        'data' => [],
        'message'=>$th->getMessage()
      ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    event(new Registered($user));

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
      'data' => $user,
      'message' => 'Succeed',
      'access_token' => $token,
      'token_type' => 'Bearer'
    ], JsonResponse::HTTP_OK);
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
    if (!Auth::attempt($request->only('email', 'password'))) {
      return response()->json(['message' => 'Unauthorized'], 401);
    }

    $user = User::where('email', $request['email'])->firstOrFail();

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
      'message' => 'Hi '.$user->name.', welcome to H/F Platform',
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
   *    security={{"sanctum":{}}},
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
