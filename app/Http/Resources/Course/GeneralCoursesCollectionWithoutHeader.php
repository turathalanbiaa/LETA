<?php

namespace App\Http\Resources\Course;

use App\Http\Resources\Lecturer\SimpleLecturer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GeneralCoursesCollectionWithoutHeader extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id"                => $this->id,
            "name"              => $this->name,
            "description"       => $this->description,
            "image"             => $this->image,
            "lecturer"          => new SimpleLecturer($this->lecturer),
            "no.of_enrollments" => $this->enrollments->count(),
            "rating"            => round($this->reviews->avg("rate"), 2) ?? 0,
            "no.of_lessons"     => $this->lessons->count()
        ];
    }
}
