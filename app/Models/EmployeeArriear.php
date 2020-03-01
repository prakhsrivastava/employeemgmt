<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeArriear extends Model
{
    protected $table = 'employee_arriears';
    protected $guarded = ['id'];

    protected $fillable = [
        'da',
        'da_it',
        'other',
        'bonus',
        'pay',
        'session_start',
        'session_end',
        'employee_id',
    ];
    
    // Relationship methodes
    public function data()
    {
        return $this->hasOne(\App\Models\Employee::class, 'employee_id');
    }
}
