<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseInfo extends Model
{
    /**
     * @var string
     */
    protected $table = 'courseinfo';
    /**
     * @var array
     */
    protected $fillable = ['course_id', 'title', 'code', 'unit'];
}
