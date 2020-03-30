<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\SectionInfo;

class CourseInfo extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'course_title' => $this->course_title,
            'keywords' => $this->keywords,
            'duration' => $this->duration,
            'price' => $this->price,
            'strike_out_price' => $this->strike_out_price,
            'overview' => $this->overview,
            'instructor' => $this->instructor->last_name,
            'category' => $this->category->name,
            'sections' => SectionInfo::collection($this->sections),
        ];
    }
}
