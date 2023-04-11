<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class LinkRequest extends FormRequest
{
    public function rules()
    {
        return [
            'link' => ['required']
        ];
    }

    public function messages(): array
    {
        return [
            'link.required' => 'A link is required!'
        ];
    }
}
