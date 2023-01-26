<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\SocialMedia\StoreSocialMediaRequest;
use App\Http\Requests\API\SocialMedia\UpdateSocialMediaRequest;
use App\Models\SocialMedia;
use Illuminate\Http\JsonResponse;

class SocialMediaController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   * 
   * @OA\Get(
   *    path="/api/social_media",
   *    tags={"social media"},
   *    summary="Social Media List",
   *    security={{"sanctum":{}}},
   *    @OA\Response(response=200, description="Show all social media"),
   *    @OA\Response(response="default", description="An error has occurred")
   * )
   */
  public function index()
  {
    try {
      $social_media = SocialMedia::all();
    } catch (\Throwable $th) {
      return response()->json([
        'data' => [],
        'message' => $th->getMessage()
      ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    return response()->json([
      'data' => $social_media,
      'message' => 'Succeed'
    ], JsonResponse::HTTP_OK);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\API\SocialMedia\StoreSocialMediaRequest  $request
   * @return \Illuminate\Http\Response
   * 
   * @OA\Post(
   *    path="/api/social_media",
   *    tags={"social media"},
   *    summary="Create Social Media",
   *    security={{"sanctum":{}}},
   *    @OA\Parameter(name="name", in="query", description="Social Media's Name", required=true),
   *    @OA\Response(response=200, description="Social Media Created")
   * )
   */
  public function store(StoreSocialMediaRequest $request)
  {
    try {
      $social_media = SocialMedia::create([
        'name' => $request->name
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
   * Display the specified resource.
   *
   * @param  \App\Models\SocialMedia  $socialMedia
   * @return \Illuminate\Http\Response
   * 
   * @OA\Get(
   *    path="/api/social_media/{socialMedia}",
   *    tags={"social media"},
   *    summary="Social Media",
   *    security={{"sanctum":{}}},
   *    @OA\Parameter(name="socialMedia", in="path", description="Social Media's ID", required=true),
   *    @OA\Response(response=200, description="Show Social Media"),
   *    @OA\Response(response="default", description="An error has occurred")
   * )
   */
  public function show(SocialMedia $socialMedia)
  {
    return response()->json([
      'data' => $socialMedia,
      'message' => 'Succeed'
    ], JsonResponse::HTTP_OK);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\API\SocialMedia\UpdateSocialMediaRequest  $request
   * @param  \App\Models\SocialMedia  $socialMedia
   * @return \Illuminate\Http\Response
   * 
   * @OA\Put(
   *    path="/api/social_media/{socialMedia}",
   *    tags={"social media"},
   *    summary="Update Social Media",
   *    security={{"sanctum":{}}},
   *    @OA\Parameter(name="socialMedia", in="path", description="Social Media's ID", required=true),
   *    @OA\Parameter(name="name", in="query", description="Social Media's Name", required=true),
   *    @OA\Response(response=200, description="Social Media Updated")
   * )
   */
  public function update(UpdateSocialMediaRequest $request, SocialMedia $socialMedia)
  {
    try {
      $socialMedia->update([
        'name' => $request->name
      ]);
    } catch (\Throwable $th) {
      return response()->json([
        'data' => [],
        'message'=>$th->getMessage()
      ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    return response()->json([
      'data' => $socialMedia,
      'message' => 'Succeed'
    ], JsonResponse::HTTP_OK);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\SocialMedia  $socialMedia
   * @return \Illuminate\Http\Response
   * 
   * @OA\Delete(
   *    path="/api/social_media/{socialMedia}",
   *    tags={"social media"},
   *    summary="Delete Social Media",
   *    security={{"sanctum":{}}},
   *    @OA\Parameter(name="socialMedia", in="path", description="Social Media's ID", required=true),
   *    @OA\Response(response=200, description="Social Media Deleted"),
   *    @OA\Response(response="default", description="An error has occurred")
   * )
   */
  public function destroy(SocialMedia $socialMedia)
  {
    try {
      $socialMedia->delete();
    } catch (\Throwable $th) {
      return response()->json([
        'data' => [],
        'message'=>$th->getMessage()
      ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    return response()->json([
      'data' => $socialMedia,
      'message' => 'Succeed'
    ], JsonResponse::HTTP_OK);
  }
}
