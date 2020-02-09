<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';

    protected $guarded = ['id'];

    protected $fillable = [
        'employee_name',
        'pay_band_level',
        'emp_status',
        'status'
    ];
    
    // Relationship methodes
    public function data()
    {
        return $this->hasMany(\App\Models\EmployeeData::class, 'employee_id');
    }
}
