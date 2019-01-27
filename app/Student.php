<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /**
     * @var string
     */
    protected $table = 'students';
    /**
     * @var array
     */
    protected $fillable = [
        'name', 'phone',
        'email', 'address',
        'state', 'lga',
        'matric_no', 'password',
        'date_of_birth', 'department', 'photo',
    ];
}
