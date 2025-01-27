<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\Major;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

/**
 * StudentsImport
 */
class StudentsImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * Student Model
     * @param array $row
     * @return Student
     */
    public function model(array $row): Student
    {
        $major = Major::where('name', $row['major'])->first();

        return new Student(
            [
            'name'     => $row['student'],
            'major_id' => $major->id,
            'phone'    => $row['phone'],
            'email'    => $row['email'],
            'address'  => $row['address'],
            ]
        );
    }

    /**
     * Validation
     *
     * @return array
     */
    public function rules(): array
    {
        return [
             '*.student' => 'required|string|max:255',
             '*.major' => 'required|string|max:255|exists:majors,name',
             '*.phone' => 'numeric',
             '*.email' => 'email|max:100',
        ];
    }
}