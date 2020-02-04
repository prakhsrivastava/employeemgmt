<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeData extends Model
{
    protected $table = 'employee_data'; 

    protected $fillables = [
        'year',
        'month',
        'dob',
        'date_of_apptt',
        'date_of_incr',
        'pay',
        'grade_pay',
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
        'nps_govt_share'
    ];


    // Relationship methodes
    public function employee()
    {
        return $this->belongsTo(\App\Models\Employee::class, 'employee_id');
    }
}
