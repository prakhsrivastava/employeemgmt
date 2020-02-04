<?php

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeesTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $emp = Employee::create([
            'employee_name' => 'Prince',
            'pay_band_level' => '78787 - 95665 /19',
            'emp_status' => 'retired',
            'status' => '1'
        ]);

        $emp->data()->create([
            'year' => '2019',
            'month' => '12',
            'dob' => '1985-12-23',
            'date_of_apptt' => '1998-12-23',
            'date_of_incr' => '1998-12-23',
            'pay' => '1221',
            'grade_pay' => '332',
            'da_17' => '123444',
            'ha' => '121',
            'hra' => '32321',
            'cca' => '423121',
            'total_salary' => '22222',
            'basic_da' => '44223',
            'it' => '33232',
            'nps' => '3331',
            'co_operative_loan' => '21212',
            'lic' => '33232',
            'gr_ins' => '32332',
            'total_dedu' => '86645',
            'total_payment' => '877676',
            'nps_govt_share' => '67673',
        ]);
    }
}
