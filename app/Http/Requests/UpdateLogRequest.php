<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLogRequest extends FormRequest
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
            'log_date' => ['required', 'date'],
            'package_id' => ['required', 'integer', 'exists:packages,id'],
            'to_package_id' => ['required', 'integer', 'exists:packages,id'],
            'total_unit' => ['required', 'integer'],
        ];
    }
}
