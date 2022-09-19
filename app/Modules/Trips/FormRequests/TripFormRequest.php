<?php

namespace App\Modules\Trips\FormRequests;

use Illuminate\Foundation\Http\FormRequest;

class TripFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'date' => 'required|date', // ISO 8601 string
            'car_id' => 'required|integer',
            'miles' => 'required|numeric'
        ];
    }
}
