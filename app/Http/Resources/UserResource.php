<?php

namespace App\Http\Resources;

use App\Mappers\UserTypeMapper;
use App\Models\School;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        switch ($this->type) {
            case UserTypeMapper::SUPER_ADMIN:
                return [
                    'name' => $this->name,
                    'email' => $this->email,
                    'type' => $this->type,
                    'schools' => SchoolResource::collection(School::all()),
                    'lessons' => new LessonResource($this->lessons),
                ];
            case UserTypeMapper::MANAGER:
                return [
                    'name' => $this->name,
                    'email' => $this->email,
                    'type' => $this->type,
                    'school' => new SchoolResource($this->school),
                    'lessons' => new LessonResource($this->lessons),
                ];
            case UserTypeMapper::TEACHER:
                return [
                    'name' => $this->name,
                    'email' => $this->email,
                    'type' => $this->type,
                    'school' => new SchoolResource($this->school),
                    'lessons' => new TeacherLessonResource($this->lessons),
                ];
            case UserTypeMapper::STUDENT:
                return [
                    'name' => $this->name,
                    'email' => $this->email,
                ];
            default:
                return [];
        }
    }
}
