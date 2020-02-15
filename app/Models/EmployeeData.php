<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeData extends Model
{
    protected $table = 'employee_data'; 

    protected $fillable = [
        'year',
        'month',
        'data'
    ];

    protected $casts = [
        'year' =>  'integer',
        'month' =>  'integer',
        'data' => 'array'
    ];


    // Relationship methodes
    public function employee()
    {
        return $this->belongsTo(\App\Models\Employee::class, 'employee_id');
    }
}
