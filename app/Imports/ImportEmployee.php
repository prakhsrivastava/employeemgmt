<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;
use App\Imports\ImportSalary;

class ImportEmployee implements WithMultipleSheets
{
    use WithConditionalSheets;

    private ImportSalary $salarySheet;

    public function __construct($month, $year) 
    {
        $this->salarySheet = new ImportSalary($month, $year);
    }

    public function sheets(): array
    {
        return [
            'salary' => $this->salarySheet
        ];
    }

    public function conditionalSheets(): array
    {        
        return [
            'salary' => $this->salarySheet,
        ];
    }

    public function getSalaryRowCount(): int
    {
        return $this->salarySheet->getRowCount();
    }
}
