<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HelpRequest extends FormRequest
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
            'question' => 'required|string|max:255',
            'answer' => 'required|string|max:255',
            'status' => 'required|in:-1,1',
            'sort' => 'required|int|min:0|max:99',
        ];
    }
}
