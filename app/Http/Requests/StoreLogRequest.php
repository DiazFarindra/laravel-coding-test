<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'log_date' => ['required', 'date', 'date_format:Y-m-d H:i:s'],
            'package_id' => ['required', 'integer', 'exists:packages,id'],
            'to_package_id' => ['required', 'integer', 'exists:packages,id'],
            'from_pond' => ['string', 'exists:ponds,id'],
            'to_pond' => ['string', 'exists:ponds,id'],
            'total_unit' => ['required', 'integer'],
        ];
    }
}
