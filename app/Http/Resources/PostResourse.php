<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title'=>$this->title,
            'job_role'=>$this->job_role,
            'career_level'=>$this->career_level,
            'experience_needed'=>$this->experience_needed,
            'job_title'=>$this->job_title,
            'keywords'=>$this->keywords,
            'name'=>$this->name,
            'address'=>$this->address,
            'company_id'=>$this->company_id,
        ];
    }
}
