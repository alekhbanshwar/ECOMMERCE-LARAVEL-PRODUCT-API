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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if (request()->isMethod('store')) {
            return [
                'name.required' => 'Name is required!',
                'image.required' => "required|mimes:jpeg,jpg,png",
            ];
        } else {
            return [
                'name.required' => 'Name is required!',
                'description.required' => 'Descritpion is required!'
            ];
        }
    }
}
