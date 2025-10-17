<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
    public function rules()
    {
        return [
            //
            'title' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable',

        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute: Khong duoc phep de trong',
            'image' => ':attribute: Hinh anh upload phai la hinh anh',
            'mines' => ':attribute:Hinh anh up load len phai dinh dang: jpeg,png, jpg, jpg, gif',

        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
}
