<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Cities\StoreCityRequest;
use App\Http\Requests\API\Cities\UpdateCityRequest;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\JsonResponse;

class CityController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @param  \App\Models\Country  $country
   * @return \Illuminate\Http\Response
   * 
   * @OA\Get(
   *    path="/api/countries/{country}/cities",
   *    tags={"cities"},
   *    summary="Cities List",
   *    security={{"sanctum":{}}},
   *    @OA\Parameter(name="country", in="path", description="Country's ID", required=true),
   *    @OA\Response(response=200, description="Show all cities"),
   *    @OA\Response(response="default", description="An error has occurred")
   * )
   */
  public function index(Country $country)
  {
    try {
      $cities = $country->cities;
    } catch (\Throwable $th) {
      return response()->json([
        'data' => [],
        'message' => $th->getMessage()
      ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    return response()->json([
      'data' => $cities,
      'message' => 'Succeed'
    ], JsonResponse::HTTP_OK);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\API\Cities\StoreCityRequest  $request
   * @param  \App\Models\Country  $country
   * @return \Illuminate\Http\Response
   * 
   * @OA\Post(
   *    path="/api/countries/{country}/cities",
   *    tags={"cities"},
   *    summary="Create City",
   *    security={{"sanctum":{}}},
   *    @OA\Parameter(name="country", in="path", description="Country's ID", required=true),
   *    @OA\Parameter(name="name", in="query", description="City's Name", required=true),
   *    @OA\Parameter(name="state_id", in="query", description="State's ID", required=true),
   *    @OA\Parameter(name="latitude", in="query", description="Latitude", required=false),
   *    @OA\Parameter(name="longitude", in="query", description="Longitude", required=false),
   *    @OA\Parameter(name="flag", in="query", description="Flag", required=false),
   *    @OA\Parameter(name="wikiDataId", in="query", description="WikiData Id", required=false),
   *    @OA\Response(response=200, description="Country Created")
   * )
   */
  public function store(StoreCityRequest $request, Country $country)
  {
    try {
      $state = State::findOrFail($request->state_id);

      $city = $country->cities()->create([
        'name' => $request->name,
        'state_id' => $state->id,
        'state_code' => $state->iso2,
        'country_code' => $country->iso2,
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
      'data' => $city,
      'message' => 'Succeed'
    ], JsonResponse::HTTP_OK);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\City  $city
   * @return \Illuminate\Http\Response
   * 
   * @OA\Get(
   *    path="/api/cities/{city}",
   *    tags={"cities"},
   *    summary="City",
   *    security={{"sanctum":{}}},
   *    @OA\Parameter(name="city", in="path", description="City's ID", required=true),
   *    @OA\Response(response=200, description="Show City"),
   *    @OA\Response(response="default", description="An error has occurred")
   * )
   */
  public function show(City $city)
  {
    return response()->json([
      'data' => $city,
      'message' => 'Succeed'
    ], JsonResponse::HTTP_OK);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\API\Cities\UpdateCityRequest  $request
   * @param  \App\Models\City  $city
   * @return \Illuminate\Http\Response
   * 
   * @OA\Put(
   *    path="/api/cities/{city}",
   *    tags={"cities"},
   *    summary="Update City",
   *    security={{"sanctum":{}}},
   *    @OA\Parameter(name="city", in="path", description="City's ID", required=true),
   *    @OA\Parameter(name="name", in="query", description="City's Name", required=true),
   *    @OA\Parameter(name="state_id", in="query", description="State's ID", required=true),
   *    @OA\Parameter(name="country_id", in="query", description="Country's ID", required=true),
   *    @OA\Parameter(name="latitude", in="query", description="Latitude", required=false),
   *    @OA\Parameter(name="longitude", in="query", description="Longitude", required=false),
   *    @OA\Parameter(name="flag", in="query", description="Flag", required=false),
   *    @OA\Parameter(name="wikiDataId", in="query", description="WikiData Id", required=false),
   *    @OA\Response(response=200, description="City Updated")
   * )
   */
  public function update(UpdateCityRequest $request, City $city)
  {
    try {
      $state = Country::findOrFail($request->state_id);
      $country = Country::findOrFail($request->country_id);

      $city->update([
        'name' => $request->name,
        'state_id' => $state->id,
        'state_code' => $state->iso2,
        'country_id' => $country->id,
        'country_code' => $country->iso2,
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
      'data' => $city,
      'message' => 'Succeed'
    ], JsonResponse::HTTP_OK);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\City  $city
   * @return \Illuminate\Http\Response
   * 
   * @OA\Delete(
   *    path="/api/cities/{city}",
   *    tags={"cities"},
   *    summary="Delete City",
   *    security={{"sanctum":{}}},
   *    @OA\Parameter(name="city", in="path", description="City's ID", required=true),
   *    @OA\Response(response=200, description="City Deleted"),
   *    @OA\Response(response="default", description="An error has occurred")
   * )
   */
  public function destroy(City $city)
  {
    try {
      $city->delete();
    } catch (\Throwable $th) {
      return response()->json([
        'data' => [],
        'message'=>$th->getMessage()
      ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    return response()->json([
      'data' => $city,
      'message' => 'Succeed'
    ], JsonResponse::HTTP_OK);
  }
}
