<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Summary of MajorRequest
 */
class MajorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Major Validation Rules
     *
     * @return array{name: string}
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255|unique:majors,name',
        ];
    }
}
