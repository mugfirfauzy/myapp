<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:15|unique:products',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'category_id' => 'required',
            'image' => 'image|mimes:png,jpg,jpeg,webp'
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'name.unique' => 'The product name must unique.',
            'name.min' => 'The product name must > 15 char.',
            'price.required' => 'The price field is required.',
            'price.integer' => 'The price must be number(without "[./,]").',
            'stock.required' => 'The stock field is required.',
            'stock.integer' => 'The stock must be number(without "[./,]").',
            'category_id.required' => 'The name field is required.',
            'image.image' => 'The image field must have type [jpg/jpeg/png/webp].',
            'image.mimes' => 'The image field must have type [jpg/jpeg/png/webp].',
            // 'image.required' => 'The image field is required.',
            // 'name.string' => 'The name field must be a string.',
            // 'name.max' => 'The name field must not exceed 255 characters.',
            // 'email.required' => 'The email field is required.',
            // 'email.email' => 'Please enter a valid email address.',
            // 'email.unique' => 'The email address is already in use.',
            // 'password.required' => 'The password field is required.',
            // 'password.string' => 'The password field must be a string.',
            // 'password.min' => 'The password must be at least 8 characters long.',
            // 'password.confirmed' => 'The password confirmation does not match.',
        ];
    }


}
