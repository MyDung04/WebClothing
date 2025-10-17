<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            //
            'name' => 'required',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'nullable',
            'phone' => 'nullable',
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
}
