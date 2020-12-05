<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProfileUpdateCustomRequest extends FormRequest
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
   * @return array
   */
  public function rules()
  {
    if ($this->password==NULL) {
      return [
        'photo' => 'nullable|file|mimetypes:image/*',
        'dni' => 'required|string|min:5|max:11',
        'name' => 'required|string|min:2|max:191',
        'lastname' => 'required|string|min:2|max:191',
        'phone' => 'required|string|min:5|max:15',
        'celular' => 'required|string|min:5|max:15',
        'locality_id' => 'required',
        'address' => 'required|string|min:2|max:191',
        'postal' => 'required|string|min:2|max:8',
        'birthday' => 'required|date'
      ];
    } else {
      return [
        'photo' => 'nullable|file|mimetypes:image/*',
        'dni' => 'required|string|min:5|max:11',
        'name' => 'required|string|min:2|max:191',
        'lastname' => 'required|string|min:2|max:191',
        'phone' => 'required|string|min:5|max:15',
        'phone' => 'required|string|min:5|max:15',
        'celular' => 'required|string|min:5|max:15',
        'locality_id' => 'required',
        'address' => 'required|string|min:2|max:191',
        'postal' => 'required|string|min:2|max:8',
        'birthday' => 'required|date',
        'password' => 'required|string|min:8|confirmed'
      ];
    }
  }
}
