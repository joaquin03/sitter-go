<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateBabysitterRequest extends Request
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
			'name' => 'required|min:3',
			'email' => 'required|email',
			'country' => 'required|min:3',
			'city' => 'required|min:3',
			'neighborhood' => 'required|min:3',
			'phone' => 'required',
			'birthday' => 'required|date',
        ];
    }
}
