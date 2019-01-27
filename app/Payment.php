<?php

namespace App;

use App\Student;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /**
     * @var string
     */
    protected $table = 'payment';
    /**
     * @var array
     */
    protected $fillable = ['student_id', 'amount', 'ref'];

    public function hasStudent()
    {
        return $this->belongsTo(Student::class, 'student_id', 'email');
    }

    public function loadPayment()
    {
        $payment = $this->whereNotNull('student_id')->with('hasStudent');
        return $payment;
    }
}
