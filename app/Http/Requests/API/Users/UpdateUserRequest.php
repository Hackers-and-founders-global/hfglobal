<?php

namespace App\Http\Requests\API\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
      'firstname' => 'required|string|max:255',
      'lastname' => 'required|string|max:255',
      'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->route('user'))],
      'password' => 'required|string|min:8',
      'gender' => 'nullable|in:M,F,O',
      'birthdate' => 'nullable|date',
      'phone' => 'nullable|string',
      'website' => 'nullable|string',
      'occupation_id' => 'required|exists:occupations,id'
    ];
  }
}
