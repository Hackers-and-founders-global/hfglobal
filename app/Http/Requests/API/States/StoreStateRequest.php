<?php

namespace App\Http\Requests\API\States;

use Illuminate\Foundation\Http\FormRequest;

class StoreStateRequest extends FormRequest
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
      'fips_code' => 'nullable|string',
      'iso2' => 'nullable|string|max:2',
      'type' => 'nullable|string',
      'latitude' => 'nullable|numeric',
      'longitude' => 'nullable|numeric',
      'flag' => 'nullable|integer',
      'wikiDataId' => 'nullable|string'
    ];
  }
}
