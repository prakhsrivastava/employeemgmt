<?php

namespace App\Imports;

use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Validator;

class ImportSalary implements ToCollection, 
    WithHeadingRow, 
    WithCalculatedFormulas,
    SkipsOnFailure,
    WithValidation,
    SkipsOnError
{
    use SkipsFailures;
    use SkipsErrors;
    use Importable;

    private $rows = 0;
    private $month = 0;
    private $year = 0;


    public function __construct($month, $year) 
    {
        $this->month = $month;
        $this->year = $year;
    }
    
    /**
     * @param array $row
     *
     * @return Employee|null
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $row = collect($row);
            $validator = Validator::make($row->all(), [
                'sr_no' => 'required|integer',
                'teacheremployees_name_designation' => 'required|unique:employees,employee_name|max:255',
            ]);
            
            if ($validator->fails()) {
                continue;
            }

            $employee = $row->only([
                'teacheremployees_name_designation',
                'pay_band_level'            
            ])->toArray();
            $employee['employee_name'] = $row['teacheremployees_name_designation'];
            unset($employee['teacheremployees_name_designation']);
            $emp_data = $row->only([
                'dob',
                'date_of_apptt',
                'date_of_incr',
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
            $emp_data['month'] = $this->month;
            $emp_data['year'] = $this->year;
            
            if (!empty($employee['employee_name'])) {
                ++$this->rows;
                $emp = Employee::create($employee);
                $emp->data()->create($emp_data);
            }
        }    

        return $rows;  
    }

    public function rules(): array
    {
        return [
            'sr_no' => 'required|integer',
            'teacheremployees_name_designation' => 'required|unique:employees,employee_name|max:255',
        ];
    }

    public function getRowCount(): int
    {
        return $this->rows;
    }
}
