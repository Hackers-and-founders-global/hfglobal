<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Occupation;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\API\Occupations\StoreOccupationRequest;
use App\Http\Requests\API\Occupations\UpdateOccupationRequest;

class OccupationController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   * 
   * @OA\Get(
   *    path="/api/occupations",
   *    tags={"occupations"},
   *    summary="Occupations List",
   *    security={{"sanctum":{}}},
   *    @OA\Response(response=200, description="Show all occupations"),
   *    @OA\Response(response="default", description="An error has occurred")
   * )
   */
  public function index()
  {
    try {
      $occupations = Occupation::all();
    } catch (\Throwable $th) {
      return response()->json([
        'data' => [],
        'message' => $th->getMessage()
      ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    return response()->json([
      'data' => $occupations,
      'message' => 'Succeed'
    ], JsonResponse::HTTP_OK);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\API\Occupations\StoreOccupationRequest  $request
   * @return \Illuminate\Http\Response
   * 
   * @OA\Post(
   *    path="/api/occupations",
   *    tags={"occupations"},
   *    summary="Create Occupation",
   *    @OA\Parameter(name="name", in="query", description="Occupation's Name", required=true),
   *    @OA\Response(response=200, description="Occupation Created")
   * )
   */
  public function store(StoreOccupationRequest $request)
  {
    try {
      $occupation = Occupation::create([
        'name' => $request->name
      ]);
    } catch (\Throwable $th) {
      return response()->json([
        'data' => [],
        'message'=>$th->getMessage()
      ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    return response()->json([
      'data' => $occupation,
      'message' => 'Succeed'
    ], JsonResponse::HTTP_OK);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Occupation  $occupation
   * @return \Illuminate\Http\Response
   * 
   * @OA\Get(
   *    path="/api/occupations/{occupation}",
   *    tags={"occupations"},
   *    summary="Occupation",
   *    @OA\Parameter(name="occupation", in="path", description="Occupation's ID", required=true),
   *    @OA\Response(response=200, description="Show Occupation"),
   *    @OA\Response(response="default", description="An error has occurred")
   * )
   */
  public function show(Occupation $occupation)
  {
    return response()->json([
      'data' => $occupation,
      'message' => 'Succeed'
    ], JsonResponse::HTTP_OK);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\API\Occupations\UpdateOccupationRequest  $request
   * @param  \App\Models\Occupation  $occupation
   * @return \Illuminate\Http\Response
   * 
   * @OA\Put(
   *    path="/api/occupations/{occupation}",
   *    tags={"occupations"},
   *    summary="Update Occupation",
   *    @OA\Parameter(name="name", in="path", description="Occupation's Name", required=true),
   *    @OA\Response(response=200, description="Occupation Updated")
   * )
   */
  public function update(UpdateOccupationRequest $request, Occupation $occupation)
  {
    try {
      $occupation->update([
        'name' => $request->name
      ]);
    } catch (\Throwable $th) {
      return response()->json([
        'data' => [],
        'message'=>$th->getMessage()
      ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    return response()->json([
      'data' => $occupation,
      'message' => 'Succeed'
    ], JsonResponse::HTTP_OK);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Occupation  $occupation
   * @return \Illuminate\Http\Response
   * 
   * @OA\Delete(
   *    path="/api/occupations/{occupation}",
   *    tags={"occupations"},
   *    summary="Delete Occupation",
   *    @OA\Parameter(name="occupation", in="path", description="Occupation's ID", required=true),
   *    @OA\Response(response=200, description="Occupation Deleted"),
   *    @OA\Response(response="default", description="An error has occurred")
   * )
   */
  public function destroy(Occupation $occupation)
  {
    try {
      $occupation->delete();
    } catch (\Throwable $th) {
      return response()->json([
        'data' => [],
        'message'=>$th->getMessage()
      ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    return response()->json([
      'data' => $occupation,
      'message' => 'Succeed'
    ], JsonResponse::HTTP_OK);
  }
}
