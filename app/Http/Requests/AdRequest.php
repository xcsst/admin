<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdRequest extends FormRequest
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
            'pic' => 'required|image|max:20480',
            'title' => 'nullable|string|max:50',
            'target_url' => 'nullable|active_url',
            'type' => 'required|in:1,2',
            'status' => 'required|in:1,-1',
            'sort' => 'required|int|min:0|max:99',
        ];
    }
}
