<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request
     */
    public function authorize()
    {
        return true; // غير هذا إلى false إذا كنت تريد التحقق من الصلاحيات
    }

    /**
     * Get the validation rules that apply to the request
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'category' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }

    /**
     * Custom validation error messages
     */
    public function messages()
    {
        return [
            'name.required' => 'Product name is required',
            'category.required' => 'Please select a category',
            'category.exists' => 'Selected category does not exist',
            'price.required' => 'Price is required',
            'price.numeric' => 'Price must be a number',
            'price.min' => 'Price must be at least 0',
            'quantity.required' => 'Quantity is required',
            'quantity.integer' => 'Quantity must be an integer',
            'quantity.min' => 'Quantity must be at least 1',
            'description.max' => 'Description cannot exceed 1000 characters',
            'image.image' => 'File must be an image',
            'image.mimes' => 'Allowed image formats: jpeg, png, jpg, gif',
            'image.max' => 'Image size cannot exceed 2MB'
        ];
    }
}
