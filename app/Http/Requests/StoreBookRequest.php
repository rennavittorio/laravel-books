<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
            'isbn_code' => 'required|string',
            'title' => 'required|string|min:3|max:100',
            'main_author' => 'required|string|min:3|max:100',
            'pages' => 'nullable|numeric',
            'isAvailable' => 'boolean',
            'copies' => 'required|numeric',
            'genre_id' => 'exists:genres,id'
        ];
    }
}
