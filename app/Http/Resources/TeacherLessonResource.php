<?php

namespace App\Http\Resources;

use App\Mappers\UserTypeMapper;
use App\Models\School;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherLessonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name',
            'unit',
            'students' => UserResource::collection($this->students)
        ];
    }
}
