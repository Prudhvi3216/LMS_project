<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LectureFiles extends JsonResource
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
            'id' => $this->id,
            'file_name' => $this->file_name,
            'file_title' => $this->file_title,
            'file_type' => $this->file_type,
            'file_extension' => $this->file_extension,
            'file_size' => $this->file_size,
            'duration' => $this->duration,
            'file_tag' => $this->file_tag,
            'processed' => $this->processed
        ];
    }
}
