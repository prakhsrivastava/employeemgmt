<?php

namespace App\Imports;

use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;

class ImportSalary implements ToModel, 
    WithHeadingRow, 
    WithCalculatedFormulas,
    SkipsOnFailure,
    WithValidation
{
    use SkipsFailures;

    /**
     * @param array $row
     *
     * @return Employee|null
     */
    public function model(array $row)
    {
        return new Employee([
            'employee_name' => $row['teacheremployees_name_designation'],
            'dob' => $row['dob'],
            'date_of_apptt' => $row['date_of_apptt'],
            'date_of_incr' => $row['date_of_incr'],
            'pay_band_level' => $row['pay_band_level'],
            'pay' => $row['pay'],
            'grade_pay' => $row['grade_pay'],
            'total' => $row['total'],
            'da_17' => $row['da_17'],
            'ha' => $row['ha'],
            'hra' => $row['hra'],
            'cca' => $row['cca'],
            'total_salary' => $row['total_salary'],
            'basic_da' => $row['basic_da'],
            'it' => $row['it'],
            'nps' => $row['nps'],
            'co_operative_loan' => $row['co_operative_loan'],
            'lic' => $row['lic'],
            'gr_ins' => $row['gr_ins'],
            'total_dedu' => $row['total_dedu'],
            'total_payment' => $row['total_payment'],
            'nps_govt_share' => $row['nps_govt_share'],
        ]);
    }

    public function rules(): array
    {
        return [
            's_no' => Rule::in(['required']),
            'teacheremployees_name_designation' => Rule::in(['required|unique:employees.employee_name|max:255']),
        ];
    }
}
