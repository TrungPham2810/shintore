<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryAddRequest extends FormRequest
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
            'category_name' => 'bail|required|max:255',
            'url_key' => 'bail|required|unique:categories,url_key|max:255',
        ];
    }

    public function messages()
    {
        return [
            'category_name.required'  => 'Tên thể loại không được để trống',
            'url_key.required'  => 'Url key không được để trống',
            'url_key.unique'  => 'Url key đã tồn tại',
        ];
    }
}
