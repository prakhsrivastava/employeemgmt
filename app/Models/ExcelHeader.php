<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExcelHeader extends Model
{
    protected $table = 'excel_headers'; 

    protected $fillable = [
        'header',
        'show_order',
    ];
}
