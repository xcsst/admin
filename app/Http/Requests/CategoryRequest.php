<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'pid' => 'required|int|min:0',
            'name' => 'required|string|max:20',
            'icon' => 'nullable|image|max:20480',
            'status' => 'required|in:1,-1',
            'sort' => 'required|int|min:0|max:99',
        ];
    }
}
