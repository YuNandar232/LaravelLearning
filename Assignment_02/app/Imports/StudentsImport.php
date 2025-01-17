<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\Major;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Row;
use Illuminate\Support\Facades\Log;

/**
 * StudentsImport
 */
class StudentsImport implements ToModel , WithHeadingRow , WithValidation
{
    /**
     * Student Model
     *
     * @param array $row
     * @return void
     */
    public function model(array $row)
    {
        $major = Major::where('name', $row['major'])->first();
        return new Student([
            'name'     => $row['student'],
            'major_id' => $major->id, 
            'phone'    => $row['phone'],
            'email'    => $row['email'],
            'address'  => $row['address'],
         ]);
    }

    /**
     * Validation
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'student' => 'required|string|max:255',

             // Above is alias for as it always validates in batches
             '*.student' => 'required|string|max:255',
             
             'major' => 'required|string|max:255|exists:majors,name',
                 
              // Above is alias for as it always validates in batches
             '*.major' => 'required|string|max:255|exists:majors,name',

             'phone' => 'numeric',

             // Above is alias for as it always validates in batches
             '*.phone' => 'numeric',

             'email' => 'email|max:100',

             // Above is alias for as it always validates in batches
             '*.email' => 'email|max:100',
        ];
    }
}