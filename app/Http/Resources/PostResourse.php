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
            'id'=>$this->id,
            'title'=>$this->title,
            'job_role'=>$this->job_role,
            'career_level'=>$this->career_level,
            'experience_needed'=>$this->experience_needed,
            'job_type'=>$this->job_type,
            'key_skills'=>$this->key_skills,
            'address'=>$this->address,
            'company_id'=>$this->company_id,
        ];
    }
}
