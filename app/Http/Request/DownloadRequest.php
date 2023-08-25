<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class DownloadRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'inn' => 'required|string|max:30',
            'kpp' => 'required|string|max:30',
            'shopper' => 'required|array',
            'shopper.fio' => 'required|string|max:255',
            'shopper.inn' => 'required|string|max:30',
            'products' => 'required|array',
            'products.*.name' => 'required|string|max:255',
            'products.*.quantity' => 'required|integer',
            'products.*.price' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Наименование поставщика обязательно для ввода',
            'name.max' => 'Наименование поставщика макс длина 255 символов',
            'inn.required' => 'ИНН поставщика обязательно для ввода',
            'inn.max' => 'ИНН поставщика макс длина 30 символов',
            'inn.integer' => 'ИНН поставщика только цифры',
            'kpp.required' => 'КПП поставщика обязательно для ввода',
            'kpp.max' => 'КПП поставщика макс длина 30 символов',
            'kpp.integer' => 'КПП поставщика только цифры',
            'shopper.required' => 'Покупатель не передан',
            'shopper.name.required' => 'ФИО покупателя обязательно',
            'shopper.name.max' => 'ФИО покупателя макс символов 255',
            'shopper.inn.required' => 'ИНН покупателя обязательно для ввода',
            'shopper.inn.max' => 'ИНН покупателя макс длина 30 символов',
            'shopper.inn.integer' => 'ИНН покупателя макс длина 30 символов',
            'products.required' => 'Товары не переданы',
            'products.*.name.required' => 'Наименование товара обязательно для ввода',
            'products.*.name.max' => 'Наименование товара макс длина 255 символов',
            'products.*.quantity.required' => 'Количество товара обязательно для ввода',
            'products.*.quantity.integer' => 'Количество товара только цифры',
            'products.*.price.required' => 'Цена обязательна для ввода'
        ];
    }
}
