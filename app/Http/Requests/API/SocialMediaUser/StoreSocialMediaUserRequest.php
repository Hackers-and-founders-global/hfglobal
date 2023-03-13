<?php

namespace App\Http\Requests\API\SocialMediaUser;

use Illuminate\Foundation\Http\FormRequest;

class StoreSocialMediaUserRequest extends FormRequest
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
      'social_media' => 'required|exists:social_media,id',
      'url' => 'required|url'
    ];
  }
}
