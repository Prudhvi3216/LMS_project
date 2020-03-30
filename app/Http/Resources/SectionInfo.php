<?php

namespace App\Http\Resources;
use App\Http\Resources\LecturesInfo;

use Illuminate\Http\Resources\Json\JsonResource;

class SectionInfo extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'lectures' => LecturesInfo::collection($this->curriculum_lectures),
        ];
    }
}
