<?php

namespace App\Exports;

use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportEmployee implements FromCollection
{
    public function collection()
    {
        return Employee::all();
    }
}
