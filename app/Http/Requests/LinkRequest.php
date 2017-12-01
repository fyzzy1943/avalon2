<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class LinkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:191',
	        'link' => 'required|max:191',
        ];
    }

	/**
	 * Get custom messages for validator errors.
	 *
	 * @return array
	 */
    public function messages() {
    	return [
    		'name.required' => '名字没有',
		    'link.required' => '链接没有',
	    ];
    }
}
