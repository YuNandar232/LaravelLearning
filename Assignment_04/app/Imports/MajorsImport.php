<?php

namespace App\Imports;

use App\Models\Major;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;

/**
 * Major Import
 */
class MajorsImport implements ToModel, WithHeadingRow, WithValidation
{
    protected $failures = [];

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Major(
            [
            'name' => $row['name'],
            ]
        );
    }


    /**
     *  Validation
     * @return array
     */
    public function rules(): array
    {
        return [
             '*.name' => 'required|max:255|unique:majors,name',
        ];
    }
}
