<?php

namespace App;

use App\CourseInfo;
use Illuminate\Database\Eloquent\Model;

class CourseRegistered extends Model
{
    /**
     * @var string
     */
    protected $table = 'course_registered';
    /**
     * @var array
     */
    protected $fillable = ['student_id', 'course_id', 'level', 'semester'];

    public function hasCourse()
    {
        return $this->belongsTo(CourseInfo::class, 'course_id', 'id');
    }

    public function loadCourse($student_id = null, $semester = null, $level = null)
    {
        if ($student_id != null && $semester != null && $level != null) {
            return $this->where('student_id', $student_id)->where('level', $level)
                ->where('semester', $semester)->with('hasCourse');
        }
        return $this->whereNotNull('student_id')->with('hasCourse');
    }
}
