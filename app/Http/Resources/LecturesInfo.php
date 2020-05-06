<?php

namespace App\Http\Resources;

use App\Http\Resources\LectureFiles;
use Illuminate\Http\Resources\Json\JsonResource;

class LecturesInfo extends JsonResource
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
            'lecture_quiz_id' => $this->lecture_quiz_id,
            'title' => $this->title,
            'description' => $this->description,
            'contenttext' => $this->contenttext,
            'media_type' => $this->media_type,
            'files' => LectureFiles::collection($this->course_files)
        ];
    }
}
