<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'titre',
        'type',
        'file_path',
        'file_type',
        'file_size',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
