<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMediaAssetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Authorization is handled by admin middleware, so we can return true here.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', Rule::in(['image', 'video'])],
            'file' => ['required', 'file'],
        ];

        if ($this->input('type') === 'image') {
            $rules['file'] = array_merge($rules['file'], ['mimes:jpeg,png,jpg,gif,svg', 'max:10240']);
        } elseif ($this->input('type') === 'video') {
            $rules['file'] = array_merge($rules['file'], ['mimes:mp4,webm', 'max:51200']);
        }

        return $rules;
    }
}
