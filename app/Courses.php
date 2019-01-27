<?php

namespace App;

use App\CourseInfo;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    /**
     * @var string
     */
    protected $table = 'courses';
    /**
     * @var array
     */
    protected $fillable = ['level', 'semester'];

    /**
     * @return mixed
     */
    public function hasCourseInfo()
    {
        return $this->belongsTo(CourseInfo::class, 'id', 'course_id');
    }

    /**
     * @param $request
     * @return mixed
     */
    public function loadCourse($request = null)
    {
        $query = null;
        if ($request == null) {
            $query = $this->whereNotNull('level');
        } else {
            $query = $this->where('level', $request->level)->where('semester', $request->semester);
        }
        $query->with('hasCourseInfo');
        return $query;
    }
}
