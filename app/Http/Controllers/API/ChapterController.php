<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Chapters\StoreChapterRequest;
use App\Http\Requests\API\Chapters\UpdateChapterRequest;
use App\Models\Chapter;
use Illuminate\Http\JsonResponse;

class ChapterController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   * 
   * @OA\Get(
   *    path="/api/chapters",
   *    tags={"chapters"},
   *    summary="Chapters List",
   *    security={{"sanctum":{}}},
   *    @OA\Response(response=200, description="Show all chapters"),
   *    @OA\Response(response="default", description="An error has occurred")
   * )
   */
  public function index()
  {
    try {
      $chapters = Chapter::all();
    } catch (\Throwable $th) {
      return response()->json([
        'data' => [],
        'message' => $th->getMessage()
      ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    return response()->json([
      'data' => $chapters,
      'message' => 'Succeed'
    ], JsonResponse::HTTP_OK);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\API\Chapters\StoreChapterRequest  $request
   * @return \Illuminate\Http\Response
   * 
   * @OA\Post(
   *    path="/api/chapters",
   *    tags={"chapters"},
   *    summary="Create Chapter",
   *    security={{"sanctum":{}}},
   *    @OA\Parameter(name="country", in="query", description="Country's ID", required=true),
   *    @OA\Parameter(name="city", in="query", description="City's ID", required=true),
   *    @OA\Parameter(name="leader", in="query", description="LEader's ID", required=true),
   *    @OA\Parameter(name="year", in="query", description="Foundation's Year", required=true),
   *    @OA\Parameter(name="website", in="query", description="Website", required=false),
   *    @OA\Response(response=200, description="Chapter Created")
   * )
   */
  public function store(StoreChapterRequest $request)
  {
    try {
      $chapter = Chapter::create([
        'country_id' => $request->country,
        'city_id' => $request->city,
        'leader_id' => $request->leader,
        'year' => $request->year,
        'website' => $request->website ?? null
      ]);
    } catch (\Throwable $th) {
      return response()->json([
        'data' => [],
        'message'=>$th->getMessage()
      ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    return response()->json([
      'data' => $chapter,
      'message' => 'Succeed'
    ], JsonResponse::HTTP_OK);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Chapter  $chapter
   * @return \Illuminate\Http\Response
   * 
   * @OA\Get(
   *    path="/api/chapters/{chapter}",
   *    tags={"chapters"},
   *    summary="Chapter",
   *    security={{"sanctum":{}}},
   *    @OA\Parameter(name="chapter", in="path", description="Chapter's ID", required=true),
   *    @OA\Response(response=200, description="Show Chapter"),
   *    @OA\Response(response="default", description="An error has occurred")
   * )
   */
  public function show(Chapter $chapter)
  {
    return response()->json([
      'data' => $chapter,
      'message' => 'Succeed'
    ], JsonResponse::HTTP_OK);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\API\Chapters\UpdateChapterRequest  $request
   * @param  \App\Models\Chapter  $chapter
   * @return \Illuminate\Http\Response
   * 
   * @OA\Put(
   *    path="/api/chapters/{chapter}",
   *    tags={"chapters"},
   *    summary="Update Chapter",
   *    security={{"sanctum":{}}},
   *    @OA\Parameter(name="chapter", in="path", description="Chapter's ID", required=true),
   *    @OA\Parameter(name="country", in="query", description="Country's ID", required=true),
   *    @OA\Parameter(name="city", in="query", description="City's ID", required=true),
   *    @OA\Parameter(name="leader", in="query", description="LEader's ID", required=true),
   *    @OA\Parameter(name="year", in="query", description="Foundation's Year", required=true),
   *    @OA\Parameter(name="website", in="query", description="Website", required=false),
   *    @OA\Response(response=200, description="Chapter Updated")
   * )
   */
  public function update(UpdateChapterRequest $request, Chapter $chapter)
  {
    try {
      $chapter->update([
        'country_id' => $request->country,
        'city_id' => $request->city,
        'leader_id' => $request->leader,
        'year' => $request->year,
        'website' => $request->website ?? null
      ]);
    } catch (\Throwable $th) {
      return response()->json([
        'data' => [],
        'message'=>$th->getMessage()
      ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    return response()->json([
      'data' => $chapter,
      'message' => 'Succeed'
    ], JsonResponse::HTTP_OK);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Chapter  $chapter
   * @return \Illuminate\Http\Response
   * 
   * @OA\Delete(
   *    path="/api/chapters/{chapter}",
   *    tags={"chapters"},
   *    summary="Delete Chapter",
   *    security={{"sanctum":{}}},
   *    @OA\Parameter(name="chapter", in="path", description="Chapter's ID", required=true),
   *    @OA\Response(response=200, description="Chapter Deleted"),
   *    @OA\Response(response="default", description="An error has occurred")
   * )
   */
  public function destroy(Chapter $chapter)
  {
    try {
      $chapter->delete();
    } catch (\Throwable $th) {
      return response()->json([
        'data' => [],
        'message'=>$th->getMessage()
      ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    return response()->json([
      'data' => $chapter,
      'message' => 'Succeed'
    ], JsonResponse::HTTP_OK);
  }
}
