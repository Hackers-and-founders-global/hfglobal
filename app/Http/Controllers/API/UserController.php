<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Users\RegisterUserRequest;
use App\Http\Requests\API\Users\UpdateUserRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   * 
   * @OA\Get(
   *    path="/api/users",
   *    tags={"users"},
   *    summary="Users List",
   *    security={{"sanctum":{}}},
   *    @OA\Response(response=200, description="Show all users"),
   *    @OA\Response(response="default", description="An error has occurred")
   * )
   */
  public function index()
  {
    try {
      $users = User::all();
    } catch (\Throwable $th) {
      return response()->json([
        'data' => [],
        'message' => $th->getMessage()
      ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    return response()->json([
      'data' => $users,
      'message' => 'Succeed'
    ], JsonResponse::HTTP_OK);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\API\Users\RegisterUserRequest  $request
   * @return \Illuminate\Http\Response
   * 
   * @OA\Post(
   *    path="/api/users",
   *    tags={"users"},
   *    summary="Create User",
   *    security={{"sanctum":{}}},
   *    @OA\Parameter(name="firstname", in="query", description="User's First name", required=true),
   *    @OA\Parameter(name="lastname", in="query", description="User's Last name", required=true),
   *    @OA\Parameter(name="email", in="query", description="User's Email", required=true),
   *    @OA\Parameter(name="password", in="query", description="User's Password", required=true),
   *    @OA\Parameter(name="gender", in="query", description="User's Gender", required=false),
   *    @OA\Parameter(name="birthdate", in="query", description="User's Birthdate", required=false),
   *    @OA\Parameter(name="phone", in="query", description="User's Phone", required=false),
   *    @OA\Parameter(name="website", in="query", description="User's Website", required=false),
   *    @OA\Parameter(name="occupation", in="query", description="User's Occupation", required=true),
   *    @OA\Response(response=200, description="User Created")
   * )
   */
  public function store(RegisterUserRequest $request)
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

    return response()->json([
      'data' => $user,
      'message' => 'Succeed'
    ], JsonResponse::HTTP_OK);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   * 
   * @OA\Get(
   *    path="/api/users/{user}",
   *    tags={"users"},
   *    summary="User",
   *    security={{"sanctum":{}}},
   *    @OA\Parameter(name="user", in="path", description="User's ID", required=true),
   *    @OA\Response(response=200, description="Show User"),
   *    @OA\Response(response="default", description="An error has occurred")
   * )
   */
  public function show(User $user)
  {
    return response()->json([
      'data' => $user,
      'message' => 'Succeed'
    ], JsonResponse::HTTP_OK);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\API\Users\UpdateUserRequest  $request
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   * 
   * @OA\Put(
   *    path="/api/users/{user}",
   *    tags={"users"},
   *    summary="Update User",
   *    security={{"sanctum":{}}},
   *    @OA\Parameter(name="user", in="path", description="User's ID", required=true),
   *    @OA\Parameter(name="firstname", in="query", description="User's First name", required=true),
   *    @OA\Parameter(name="lastname", in="query", description="User's Last name", required=true),
   *    @OA\Parameter(name="email", in="query", description="User's Email", required=true),
   *    @OA\Parameter(name="gender", in="query", description="User's Gender", required=false),
   *    @OA\Parameter(name="birthdate", in="query", description="User's Birthdate", required=false),
   *    @OA\Parameter(name="phone", in="query", description="User's Phone", required=false),
   *    @OA\Parameter(name="website", in="query", description="User's Website", required=false),
   *    @OA\Parameter(name="occupation", in="query", description="User's Occupation", required=true),
   *    @OA\Response(response=200, description="User Updated")
   * )
   */
  public function update(UpdateUserRequest $request, User $user)
  {
    $birthdate = null;
    if (isset($request->birthdate)) {
      $birthdate = Carbon::createFromFormat('Y-m-d', $request->birthdate);
    }
    
    try {
      $user->update([
        'firstname' => $request->firstname,
        'lastname' => $request->lastname,
        'email' => $request->email,
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

    return response()->json([
      'data' => $user,
      'message' => 'Succeed'
    ], JsonResponse::HTTP_OK);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   * 
   * @OA\Delete(
   *    path="/api/users/{user}",
   *    tags={"users"},
   *    summary="Delete User",
   *    security={{"sanctum":{}}},
   *    @OA\Parameter(name="user", in="path", description="User's ID", required=true),
   *    @OA\Response(response=200, description="User Deleted"),
   *    @OA\Response(response="default", description="An error has occurred")
   * )
   */
  public function destroy(User $user)
  {
    try {
      $user->delete();
    } catch (\Throwable $th) {
      return response()->json([
        'data' => [],
        'message'=>$th->getMessage()
      ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    return response()->json([
      'data' => $user,
      'message' => 'Succeed'
    ], JsonResponse::HTTP_OK);
  }
}
