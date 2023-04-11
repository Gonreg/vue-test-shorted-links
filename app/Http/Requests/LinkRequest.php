<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class LinkRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'link' => ['required', 'unique:links']
        ];
    }

    public function messages(): array
    {
        return [
            'link.required' => 'A link is required!',
            'link.unique' => 'This link already contain!'
        ];
    }
}
