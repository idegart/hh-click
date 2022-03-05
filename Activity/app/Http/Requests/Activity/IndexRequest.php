<?php

namespace App\Http\Requests\Activity;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
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
            'params.page' => [
                'required',
                'integer',
                'min:1',
            ],
        ];
    }

    public function dataId(): string
    {
        return $this->input('id');
    }

    public function dataPage(): string
    {
        return $this->input('params.page');
    }
}
