<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;
use App\Imports\ImportSalary;

class ImportEmployee implements WithMultipleSheets
{
    use WithConditionalSheets;

    private $salarySheet;

    public function sheets(): array
    {
        $this->salarySheet = new ImportSalary();
        return [
            'salary' => $this->salarySheet
        ];
    }

    public function conditionalSheets(): array
    {
        $this->salarySheet = new ImportSalary();
        return [
            'salary' => $this->salarySheet,
        ];
    }

    public function getSalaryRowCount(): int
    {
        return $this->salarySheet->getRowCount();
    }
}
