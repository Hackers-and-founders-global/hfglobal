<?php

namespace App\Http\Requests\API\Countries;

use Illuminate\Foundation\Http\FormRequest;

class StoreCountryRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, mixed>
   */
  public function rules()
  {
    return [
      'name' => 'required|string',
      'iso3' => 'nullable|string|max:3',
      'numeric_code' => 'nullable|string|max:3',
      'iso2' => 'nullable|string|max:2',
      'phonecode' => 'nullable|string',
      'capital' => 'nullable|string',
      'currency' => 'nullable|string',
      'currency_name' => 'nullable|string',
      'currency_symbol' => 'nullable|string',
      'tld' => 'nullable|string',
      'native' => 'nullable|string',
      'region' => 'nullable|string',
      'subregion' => 'nullable|string',
      'timezones' => 'required|string',
      'translations' => 'required|string',
      'latitude' => 'nullable|numeric',
      'longitude' => 'nullable|numeric',
      'emoji' => 'nullable|string',
      'emojiU' => 'nullable|string',
      'flag' => 'nullable|integer',
      'wikiDataId' => 'nullable|string'
    ];
  }
}
