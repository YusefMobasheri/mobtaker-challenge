<?php

namespace App\Http\Requests;

use App\Rules\UserAssignLessonRule;
use Illuminate\Foundation\Http\FormRequest;

class UserAssignLessonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => ['required', 'integer', 'exists:users,id', new UserAssignLessonRule()],
            'lesson_id' => ['required', 'integer', 'exists:lessons,id'],
        ];
    }
}
