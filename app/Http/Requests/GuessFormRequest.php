<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuessFormRequest extends FormRequest
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
            'letter' => 'required|string|size:1'
        ];
    }

	/**
	 * Custom messages for validation rules of the request.
	 *
	 * @return array
	 */
	public function messages()
	{
		return [
			'letter.size' => 'Sorry, only one letter at a time please.'
		];
	}
}
