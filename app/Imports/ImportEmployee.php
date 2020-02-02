<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;
use App\Imports\ImportSalary;

class ImportEmployee implements WithMultipleSheets
{
    use WithConditionalSheets;

    public function sheets(): array
    {
        return [
            'salary' => new ImportSalary()
        ];
    }

    public function conditionalSheets(): array
    {
        return [
            'salary' => new ImportSalary(),
        ];
    }
}
