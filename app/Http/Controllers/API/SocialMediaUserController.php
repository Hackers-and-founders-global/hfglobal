<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\SocialMediaUser\StoreSocialMediaUserRequest;
use App\Http\Requests\API\SocialMediaUser\UpdateSocialMediaUserRequest;
use App\Models\SocialMediaUser;
use App\Models\SocialMedia;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class SocialMediaUserController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   * 
   * @OA\Get(
   *    path="/api/users/{user}/social_medias",
   *    tags={"social_media_user"},
   *    summary="User's Social Media List",
   *    security={{"sanctum":{}}},
   *    @OA\Parameter(name="user", in="path", description="User's ID", required=true),
   *    @OA\Response(response=200, description="Show all user's social media"),
   *    @OA\Response(response="default", description="An error has occurred")
   * )
   */
  public function index(User $user)
  {
    try {
			$social_medias = $user->social_medias;
		} catch (\Throwable $th) {
			return response()->json([
				'data' => [],
				'message' => $th->getMessage()
			], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
		}

		return response()->json([
			'data' => $social_medias,
			'message' => 'Succeed'
		], JsonResponse::HTTP_OK);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\API\SocialMediaUser\StoreSocialMediaUserRequest  $request
	 * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   * 
   * @OA\Post(
   *    path="/api/users/{user}/social_medias",
   *    tags={"social_media_user"},
   *    summary="Create User's Social Media",
   *    security={{"sanctum":{}}},
   *    @OA\Parameter(name="user", in="path", description="User's ID", required=true),
   *    @OA\Parameter(name="social_media", in="query", description="Social Media's ID", required=true),
   *    @OA\Parameter(name="url", in="query", description="Social Media's URL", required=true),
   *    @OA\Response(response=200, description="User's Social Media Created")
   * )
   */
  public function store(StoreSocialMediaUserRequest $request, User $user)
  {
    try {
      $user->social_medias()->attach($request->social_media, ['url' => $request->url]);
    } catch (\Throwable $th) {
      return response()->json([
        'data' => [],
        'message'=>$th->getMessage()
      ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    return response()->json([
      'data' => User::with('social_medias')->find($user->id),
      'message' => 'Succeed'
    ], JsonResponse::HTTP_OK);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\SocialMediaUser  $social_media
   * @return \Illuminate\Http\Response
   * 
   * @OA\Get(
   *    path="/api/social_medias/{social_media}",
   *    tags={"social_media_user"},
   *    summary="User's Social Media",
   *    security={{"sanctum":{}}},
   *    @OA\Parameter(name="social_media", in="path", description="SocialMedia-User ID", required=true),
   *    @OA\Response(response=200, description="Show User's Social Media"),
   *    @OA\Response(response="default", description="An error has occurred")
   * )
   */
  public function show(SocialMediaUser $social_media)
  {
    return response()->json([
      'data' => $social_media,
      'message' => 'Succeed'
    ], JsonResponse::HTTP_OK);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\API\SocialMediaUser\UpdateSocialMediaUserRequest  $request
   * @param  \App\Models\SocialMediaUser  $social_media
   * @return \Illuminate\Http\Response
   * 
   * @OA\Put(
   *    path="/api/social_medias/{social_media}",
   *    tags={"social_media_user"},
   *    summary="Update User's Social Media",
   *    security={{"sanctum":{}}},
   *    @OA\Parameter(name="social_media", in="path", description="SocialMedia-User ID", required=true),
   *    @OA\Parameter(name="url", in="query", description="Social Media's URL", required=true),
   *    @OA\Response(response=200, description="User's Social Media Updated")
   * )
   */
  public function update(UpdateSocialMediaUserRequest $request, SocialMediaUser $social_media)
  {
    try {
      $social_media->update([
        'url' => $request->url
      ]);
    } catch (\Throwable $th) {
      return response()->json([
        'data' => [],
        'message'=>$th->getMessage()
      ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    return response()->json([
      'data' => $social_media,
      'message' => 'Succeed'
    ], JsonResponse::HTTP_OK);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\SocialMediaUser  $social_media
   * @return \Illuminate\Http\Response
   * 
   * @OA\Delete(
   *    path="/api/social_medias/{social_media}",
   *    tags={"social_media_user"},
   *    summary="Delete User's Social Media",
   *    security={{"sanctum":{}}},
   *    @OA\Parameter(name="social_media", in="path", description="SocialMedia-User ID", required=true),
   *    @OA\Response(response=200, description="User's Social Media Deleted"),
   *    @OA\Response(response="default", description="An error has occurred")
   * )
   */
  public function destroy(SocialMediaUser $social_media)
  {
    try {
      $social_media->delete();
    } catch (\Throwable $th) {
      return response()->json([
        'data' => [],
        'message'=>$th->getMessage()
      ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    return response()->json([
      'data' => $social_media,
      'message' => 'Succeed'
    ], JsonResponse::HTTP_OK);
  }
}
