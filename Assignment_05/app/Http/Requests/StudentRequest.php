<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Summary of StudentRequest
 */
class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Summary of student
     *
     * @return mixed
     */
    public function student(): mixed
    {
        return $this->input('student');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array{email: string, major_id: string, name: string, phone: string}
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'major_id' => 'required|exists:majors,id',
            'phone' => 'required|max:15',
            'email' => 'required|email|max:100',
            'address' => 'required|max:255',
        ];
    }
}
