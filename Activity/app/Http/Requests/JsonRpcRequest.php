<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class JsonRpcRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'jsonrpc' => [
                'required',
                Rule::in(['2.0']),
            ],
            'id' => [
                'required',
                'string',
            ],
            'method' => [
                'required',
                'string',
            ],
            'params' => [
                'present',
                'array',
            ],
            'params.url' => [
                Rule::requiredIf(function () {
                    return $this->input('method') === 'storeActivity';
                }),
                'url',
            ],
        ];
    }

    public function dataId(): string
    {
        return $this->input('id');
    }

    public function dataMethod(): string
    {
        return $this->input('method');
    }

    public function dataParams(): array
    {
        return $this->input('params');
    }
}
