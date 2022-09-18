<?php

namespace App\Modules\Cars\FormRequests;

use Illuminate\Foundation\Http\FormRequest;

class CarFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'year' => 'required|integer',
            'make' => 'required|string',
            'model' => 'required|string'
        ];
    }
}
