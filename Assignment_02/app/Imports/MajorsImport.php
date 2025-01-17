<?php

namespace App\Imports;

use App\Models\Major;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Illuminate\Support\Collection;

/**
 * MajorImport
 */
class MajorsImport implements ToModel,  WithHeadingRow , WithValidation
{
    protected $failures = [];

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Major([
            'name' => $row['name'],
        ]);
    }


    /**
     * Write code on Method
     *
     * @return response()
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255|unique:majors,name',

             // Above is alias for as it always validates in batches
             '*.name' => 'required|max:255|unique:majors,name',
        ];
    }
}
