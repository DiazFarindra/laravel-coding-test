<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePackageRequest extends FormRequest
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
            'pond_id' => [Rule::when($this->package, 'sometimes'), 'required', 'integer', 'exists:ponds,id'],
            'package_code' => [Rule::when($this->package, 'sometimes'), 'required', 'string', 'max:255', 'unique:packages'],
            'total_unit' => [Rule::when($this->package, 'sometimes'), 'required', 'integer'],
        ];
    }
}
