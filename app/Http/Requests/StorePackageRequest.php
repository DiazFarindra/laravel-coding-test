<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePackageRequest extends FormRequest
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
            'pond_id' => ['required', 'integer', 'exists:ponds,id'],
            'package_code' => ['required', 'string', 'max:255', 'unique:packages'],
            'total_unit' => ['required', 'integer'],
        ];
    }
}
