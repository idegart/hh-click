<?php

namespace App\Http\Requests\Activity;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => [
                'required',
                'string',
            ],
            'params' => [
                'required',
                'array',
            ],
            'params.url' => [
                'required',
                'url',
            ],
        ];
    }

    public function dataId(): string
    {
        return $this->input('id');
    }

    public function dataUrl(): string
    {
        return $this->input('params.url');
    }
}
