<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ImportEmployee implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'salary' => new ImportSalary()
        ];
    }
}
