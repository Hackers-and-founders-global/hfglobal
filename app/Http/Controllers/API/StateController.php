<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\States\StoreStateRequest;
use App\Http\Requests\API\States\UpdateStateRequest;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\JsonResponse;

class StateController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @param  \App\Models\Country  $country
   * @return \Illuminate\Http\Response
   * 
   * @OA\Get(
   *    path="/api/countries/{country}/states",
   *    tags={"states"},
   *    summary="States List",
   *    security={{"sanctum":{}}},
   *    @OA\Parameter(name="country", in="path", description="Country's ID", required=true),
   *    @OA\Response(response=200, description="Show all states"),
   *    @OA\Response(response="default", description="An error has occurred")
   * )
   */
  public function index(Country $country)
  {
    try {
      $states = $country->states;
    } catch (\Throwable $th) {
      return response()->json([
        'data' => [],
        'message' => $th->getMessage()
      ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    return response()->json([
      'data' => $states,
      'message' => 'Succeed'
    ], JsonResponse::HTTP_OK);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\API\States\StoreStateRequest  $request
   * @param  \App\Models\Country  $country
   * @return \Illuminate\Http\Response
   * 
   * @OA\Post(
   *    path="/api/countries/{country}/states",
   *    tags={"states"},
   *    summary="Create State",
   *    security={{"sanctum":{}}},
   *    @OA\Parameter(name="country", in="path", description="Country's ID", required=true),
   *    @OA\Parameter(name="name", in="query", description="State's Name", required=true),
   *    @OA\Parameter(name="fips_code", in="query", description="Fips Code", required=false),
   *    @OA\Parameter(name="iso2", in="query", description="ISO 2", required=false),
   *    @OA\Parameter(name="type", in="query", description="Type", required=false),
   *    @OA\Parameter(name="latitude", in="query", description="Latitude", required=false),
   *    @OA\Parameter(name="longitude", in="query", description="Longitude", required=false),
   *    @OA\Parameter(name="flag", in="query", description="Flag", required=false),
   *    @OA\Parameter(name="wikiDataId", in="query", description="WikiData Id", required=false),
   *    @OA\Response(response=200, description="Country Created")
   * )
   */
  public function store(StoreStateRequest $request, Country $country)
  {
    try {
      $state = $country->states()->create([
        'name' => $request->name,
        'country_code' => $country->iso2,
        'fips_code' => $request->fips_code ?? null,
        'iso2' => $request->iso2 ?? null,
        'type' => $request->type ?? null,
        'latitude' => $request->latitude ?? null,
        'longitude' => $request->longitude ?? null,
        'flag' => $request->flag ?? 1,
        'wikiDataId' => $request->wikiDataId ?? null
      ]);
    } catch (\Throwable $th) {
      return response()->json([
        'data' => [],
        'message'=>$th->getMessage()
      ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    return response()->json([
      'data' => $state,
      'message' => 'Succeed'
    ], JsonResponse::HTTP_OK);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\State  $state
   * @return \Illuminate\Http\Response
   * 
   * @OA\Get(
   *    path="/api/states/{state}",
   *    tags={"states"},
   *    summary="State",
   *    security={{"sanctum":{}}},
   *    @OA\Parameter(name="state", in="path", description="State's ID", required=true),
   *    @OA\Response(response=200, description="Show State"),
   *    @OA\Response(response="default", description="An error has occurred")
   * )
   */
  public function show(State $state)
  {
    return response()->json([
      'data' => $state,
      'message' => 'Succeed'
    ], JsonResponse::HTTP_OK);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\API\States\UpdateStateRequest  $request
   * @param  \App\Models\State  $state
   * @return \Illuminate\Http\Response
   * 
   * @OA\Put(
   *    path="/api/states/{state}",
   *    tags={"states"},
   *    summary="Update State",
   *    security={{"sanctum":{}}},
   *    @OA\Parameter(name="state", in="path", description="State's ID", required=true),
   *    @OA\Parameter(name="name", in="query", description="State's Name", required=true),
   *    @OA\Parameter(name="country_id", in="query", description="Country's ID", required=true),
   *    @OA\Parameter(name="fips_code", in="query", description="Fips Code", required=false),
   *    @OA\Parameter(name="iso2", in="query", description="ISO 2", required=false),
   *    @OA\Parameter(name="type", in="query", description="Type", required=false),
   *    @OA\Parameter(name="latitude", in="query", description="Latitude", required=false),
   *    @OA\Parameter(name="longitude", in="query", description="Longitude", required=false),
   *    @OA\Parameter(name="flag", in="query", description="Flag", required=false),
   *    @OA\Parameter(name="wikiDataId", in="query", description="WikiData Id", required=false),
   *    @OA\Response(response=200, description="State Updated")
   * )
   */
  public function update(UpdateStateRequest $request, State $state)
  {
    try {
      $country = Country::findOrFail($request->country_id);

      $state->update([
        'name' => $request->name,
        'country_id' => $country->id,
        'country_code' => $country->iso2,
        'fips_code' => $request->fips_code ?? null,
        'iso2' => $request->iso2 ?? null,
        'type' => $request->type ?? null,
        'latitude' => $request->latitude ?? null,
        'longitude' => $request->longitude ?? null,
        'flag' => $request->flag ?? 1,
        'wikiDataId' => $request->wikiDataId ?? null
      ]);
    } catch (\Throwable $th) {
      return response()->json([
        'data' => [],
        'message'=>$th->getMessage()
      ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    return response()->json([
      'data' => $state,
      'message' => 'Succeed'
    ], JsonResponse::HTTP_OK);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\State  $state
   * @return \Illuminate\Http\Response
   * 
   * @OA\Delete(
   *    path="/api/states/{state}",
   *    tags={"states"},
   *    summary="Delete State",
   *    security={{"sanctum":{}}},
   *    @OA\Parameter(name="state", in="path", description="State's ID", required=true),
   *    @OA\Response(response=200, description="State Deleted"),
   *    @OA\Response(response="default", description="An error has occurred")
   * )
   */
  public function destroy(State $state)
  {
    try {
      $state->delete();
    } catch (\Throwable $th) {
      return response()->json([
        'data' => [],
        'message'=>$th->getMessage()
      ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    return response()->json([
      'data' => $state,
      'message' => 'Succeed'
    ], JsonResponse::HTTP_OK);
  }
}
