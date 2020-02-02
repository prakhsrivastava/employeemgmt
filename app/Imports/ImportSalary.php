<?php

namespace App\Imports;

use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;

class ImportSalary implements ToModel, 
    WithHeadingRow, 
    WithCalculatedFormulas,
    SkipsOnFailure,
    WithValidation,
    SkipsOnError,
    ToCollection
{
    use SkipsFailures;
    use SkipsErrors;
    use Importable;

    private $rows = 0;

    /**
     * @param array $row
     *
     * @return Employee|null
     */
    public function model(array $row)
    {
        $row = collect($row)->only([
            'teacheremployees_name_designation',
            'dob',
            'date_of_apptt',
            'date_of_incr',
            'pay_band_level',
            'pay',
            'grade_pay',
            'total',
            'da_17',
            'ha',
            'hra',
            'cca',
            'total_salary',
            'basic_da',
            'it',
            'nps',
            'co_operative_loan',
            'lic',
            'gr_ins',
            'total_dedu',
            'total_payment',
            'nps_govt_share',
        ])->toArray();
        $row['employee_name'] = $row['teacheremployees_name_designation'];
        unset($row['teacheremployees_name_designation']);
        
        ++$this->rows;
        return new Employee($row);
    }

    public function rules(): array
    {
        return [
            'sr_no' => 'required|integer',
            'teacheremployees_name_designation' => 'required|unique:employees,employee_name|max:255',
        ];
    }

    public function collection(Collection $rows)
    {
        return $rows;
    }

    public function getRowCount(): int
    {
        return $this->rows;
    }
}
