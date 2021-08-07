<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'email' => 'bail|required|unique:users,email,'.$this->id.'|max:255',
            'password' => 'required',
            'name' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required'  => 'Vui lòng nhập email.',
            'password.required'  => 'Vui lòng nhập password.',
            'name.required'  => 'Vui lòng nhập tên người dùng.',
            'email.unique'  => 'Email đã tồn tại.',
        ];
    }
}
