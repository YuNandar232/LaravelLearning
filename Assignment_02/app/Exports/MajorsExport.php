<?php

namespace App\Exports;

use App\Models\Major;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
/**
 * MajorsExport
 */
class MajorsExport implements FromCollection , WithHeadings, WithMapping
{
      /**
       * @return \Illuminate\Support\Collection
       */
    public function collection()
    {
        return Major::select('name')->get();
    }

    /**
     * Map the data to the columns in the Excel file.
     *
     * @param  mixed $major
     * @return array
     */
    public function map($major): array
    {
        return [
            $major->name, // The major name
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
            'Name', // The major name column
        ];
    }
}
