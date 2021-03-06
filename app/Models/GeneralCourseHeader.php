<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralCourseHeader extends Model
{
    protected $table = "general_course_headers";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        "title",
        "description",
        "image",
        "created_at",
        "updated_at"
    ];

    public function generalCourses()
    {
        return $this->hasMany("App\\Models\\GeneralCourse")
            ->orderBy("id");
    }
}
