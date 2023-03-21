<?php

namespace App\Http\Requests\API\Chapters;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChapterRequest extends FormRequest
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
      'country' => 'required|integer|exists:countries,id',
      'city' => 'required|integer|exists:cities,id',
      'leader' => 'required|integer|exists:users,id',
      'year' => 'required|integer',
      'website' => 'nullable|url',
    ];
  }
}
