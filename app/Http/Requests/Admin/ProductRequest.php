<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'product_name' => 'bail|required|max:255',
            'category_id' => 'required',
            'price' => 'required',
            'qty' => 'required',
            'sku' => 'bail|required|unique:products,sku|max:225',
            'url_key' => 'bail|required|unique:products,url_key,'.$this->id.'|max:225',
        ];
    }

    public function messages()
    {
        return [
            'product_name.required'  => 'Tên sản phẩm không được để trống.',
            'url_key.required'  => 'Url key không được để trống.',
            'sku.required'  => 'Sku không được để trống.',
            'sku.unique'  => 'Sku đã tồn tại.',
            'category_id.required'  => 'Vui lòng chọn loại sản phẩm.',
            'price.required'  => 'Giá sản phẩm không đc để trống.',
            'qty.required'  => 'Số lượng sản phẩm không đc để trống.',
            'url_key.unique'  => 'Url key đã tồn tại.',
        ];
    }
}
