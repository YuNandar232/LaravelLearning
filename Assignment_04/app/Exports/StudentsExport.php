<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

/**
 * Students Export
 */
class StudentsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Student::with('major')->get();
    }
    
    /**
     * Map the data to the columns in the Excel file.
     *
     * @param  mixed $major
     * @return array
     */
    public function map($student): array
    {
        return [
            $student->name,             // Student's Name
            $student->major ? $student->major->name : 'N/A', 
            $student->phone,            // Student's Phone
            $student->email,            // Student's Email
            $student->address,          // Student's Address
        ];
    }

    /**
     * Add headers to the exported Excel file.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Student', // Column Header for Student's Name
            'Major',    // Column Header for Major's Name
            'Phone',         // Column Header for Phone
            'Email',         // Column Header for Email
            'Address',       // Column Header for Address
        ];
    }
}

