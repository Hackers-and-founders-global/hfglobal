<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Countries\StoreCountryRequest;
use App\Http\Requests\API\Countries\UpdateCountryRequest;
use App\Models\Country;
use Illuminate\Http\JsonResponse;

class CountryController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   * 
   * @OA\Get(
   *    path="/api/countries",
   *    tags={"countries"},
   *    summary="Countries List",
   *    security={{"sanctum":{}}},
   *    @OA\Response(response=200, description="Show all countries"),
   *    @OA\Response(response="default", description="An error has occurred")
   * )
   */
  public function index()
  {
    try {
      $countries = Country::all();
    } catch (\Throwable $th) {
      return response()->json([
        'data' => [],
        'message' => $th->getMessage()
      ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    return response()->json([
      'data' => $countries,
      'message' => 'Succeed'
    ], JsonResponse::HTTP_OK);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\API\Countries\StoreCountryRequest  $request
   * @return \Illuminate\Http\Response
   * 
   * @OA\Post(
   *    path="/api/countries",
   *    tags={"countries"},
   *    summary="Create Country",
   *    security={{"sanctum":{}}},
   *    @OA\Parameter(name="name", in="query", description="Country's Name", required=true),
   *    @OA\Parameter(name="iso3", in="query", description="ISO 3", required=false),
   *    @OA\Parameter(name="numeric_code", in="query", description="Numeric Code", required=false),
   *    @OA\Parameter(name="iso2", in="query", description="ISO 2", required=false),
   *    @OA\Parameter(name="phonecode", in="query", description="Phone Code", required=false),
   *    @OA\Parameter(name="capital", in="query", description="Capital", required=false),
   *    @OA\Parameter(name="currency", in="query", description="Currency", required=false),
   *    @OA\Parameter(name="currency_name", in="query", description="Currency Name", required=false),
   *    @OA\Parameter(name="currency_symbol", in="query", description="Currency Symbol", required=false),
   *    @OA\Parameter(name="tld", in="query", description="TLD", required=false),
   *    @OA\Parameter(name="native", in="query", description="Native", required=false),
   *    @OA\Parameter(name="region", in="query", description="Region", required=false),
   *    @OA\Parameter(name="subregion", in="query", description="Subregion", required=false),
   *    @OA\Parameter(name="timezones", in="query", description="Timezones", required=true),
   *    @OA\Parameter(name="translations", in="query", description="Translations", required=true),
   *    @OA\Parameter(name="latitude", in="query", description="Latitude", required=false),
   *    @OA\Parameter(name="longitude", in="query", description="Longitude", required=false),
   *    @OA\Parameter(name="emoji", in="query", description="Emoji", required=false),
   *    @OA\Parameter(name="emojiU", in="query", description="Emoji U", required=false),
   *    @OA\Parameter(name="flag", in="query", description="Flag", required=false),
   *    @OA\Parameter(name="wikiDataId", in="query", description="WikiData Id", required=false),
   *    @OA\Response(response=200, description="Country Created")
   * )
   */
  public function store(StoreCountryRequest $request)
  {
    try {
      $country = Country::create([
        'name' => $request->name,
        'iso3' => $request->iso3 ?? null,
        'numeric_code' => $request->numeric_code ?? null,
        'iso2' => $request->iso2 ?? null,
        'phonecode' => $request->phonecode ?? null,
        'capital' => $request->capital ?? null,
        'currency' => $request->currency ?? null,
        'currency_name' => $request->currency_name ?? null,
        'currency_symbol' => $request->currency_symbol ?? null,
        'tld' => $request->tld ?? null,
        'native' => $request->native ?? null,
        'region' => $request->region ?? null,
        'subregion' => $request->subregion ?? null,
        'timezones' => $request->timezones,
        'translations' => $request->translations,
        'latitude' => $request->latitude ?? null,
        'longitude' => $request->longitude ?? null,
        'emoji' => $request->emoji ?? null,
        'emojiU' => $request->emojiU ?? null,
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
      'data' => $country,
      'message' => 'Succeed'
    ], JsonResponse::HTTP_OK);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Country  $country
   * @return \Illuminate\Http\Response
   * 
   * @OA\Get(
   *    path="/api/countries/{country}",
   *    tags={"countries"},
   *    summary="Country",
   *    security={{"sanctum":{}}},
   *    @OA\Parameter(name="country", in="path", description="Country's ID", required=true),
   *    @OA\Response(response=200, description="Show Country"),
   *    @OA\Response(response="default", description="An error has occurred")
   * )
   */
  public function show(Country $country)
  {
    return response()->json([
      'data' => $country,
      'message' => 'Succeed'
    ], JsonResponse::HTTP_OK);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\API\Countries\UpdateCountryRequest  $request
   * @param  \App\Models\Country  $country
   * @return \Illuminate\Http\Response
   * 
   * @OA\Put(
   *    path="/api/countries/{country}",
   *    tags={"countries"},
   *    summary="Update Country",
   *    security={{"sanctum":{}}},
   *    @OA\Parameter(name="country", in="path", description="Country's ID", required=true),
   *    @OA\Parameter(name="name", in="query", description="Country's Name", required=true),
   *    @OA\Parameter(name="iso3", in="query", description="ISO 3", required=false),
   *    @OA\Parameter(name="numeric_code", in="query", description="Numeric Code", required=false),
   *    @OA\Parameter(name="iso2", in="query", description="ISO 2", required=false),
   *    @OA\Parameter(name="phonecode", in="query", description="Phone Code", required=false),
   *    @OA\Parameter(name="capital", in="query", description="Capital", required=false),
   *    @OA\Parameter(name="currency", in="query", description="Currency", required=false),
   *    @OA\Parameter(name="currency_name", in="query", description="Currency Name", required=false),
   *    @OA\Parameter(name="currency_symbol", in="query", description="Currency Symbol", required=false),
   *    @OA\Parameter(name="tld", in="query", description="TLD", required=false),
   *    @OA\Parameter(name="native", in="query", description="Native", required=false),
   *    @OA\Parameter(name="region", in="query", description="Region", required=false),
   *    @OA\Parameter(name="subregion", in="query", description="Subregion", required=false),
   *    @OA\Parameter(name="timezones", in="query", description="Timezones", required=true),
   *    @OA\Parameter(name="translations", in="query", description="Translations", required=true),
   *    @OA\Parameter(name="latitude", in="query", description="Latitude", required=false),
   *    @OA\Parameter(name="longitude", in="query", description="Longitude", required=false),
   *    @OA\Parameter(name="emoji", in="query", description="Emoji", required=false),
   *    @OA\Parameter(name="emojiU", in="query", description="Emoji U", required=false),
   *    @OA\Parameter(name="flag", in="query", description="Flag", required=false),
   *    @OA\Parameter(name="wikiDataId", in="query", description="WikiData Id", required=false),
   *    @OA\Response(response=200, description="Country Updated")
   * )
   */
  public function update(UpdateCountryRequest $request, Country $country)
  {
    try {
      $country->update([
        'name' => $request->name,
        'iso3' => $request->iso3 ?? null,
        'numeric_code' => $request->numeric_code ?? null,
        'iso2' => $request->iso2 ?? null,
        'phonecode' => $request->phonecode ?? null,
        'capital' => $request->capital ?? null,
        'currency' => $request->currency ?? null,
        'currency_name' => $request->currency_name ?? null,
        'currency_symbol' => $request->currency_symbol ?? null,
        'tld' => $request->tld ?? null,
        'native' => $request->native ?? null,
        'region' => $request->region ?? null,
        'subregion' => $request->subregion ?? null,
        'timezones' => $request->timezones,
        'translations' => $request->translations,
        'latitude' => $request->latitude ?? null,
        'longitude' => $request->longitude ?? null,
        'emoji' => $request->emoji ?? null,
        'emojiU' => $request->emojiU ?? null,
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
      'data' => $country,
      'message' => 'Succeed'
    ], JsonResponse::HTTP_OK);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Country  $country
   * @return \Illuminate\Http\Response
   * 
   * @OA\Delete(
   *    path="/api/countries/{country}",
   *    tags={"countries"},
   *    summary="Delete Country",
   *    security={{"sanctum":{}}},
   *    @OA\Parameter(name="country", in="path", description="Country's ID", required=true),
   *    @OA\Response(response=200, description="Country Deleted"),
   *    @OA\Response(response="default", description="An error has occurred")
   * )
   */
  public function destroy(Country $country)
  {
    try {
      $country->delete();
    } catch (\Throwable $th) {
      return response()->json([
        'data' => [],
        'message'=>$th->getMessage()
      ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    return response()->json([
      'data' => $country,
      'message' => 'Succeed'
    ], JsonResponse::HTTP_OK);
  }
}
