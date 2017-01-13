<?php

namespace Pulpomatic\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoutesQuantityRequest extends FormRequest
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
    return [
      'quantity'  => 'required|min:1|max:100|numeric'
    ];
  }
}
