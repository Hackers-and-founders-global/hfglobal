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
