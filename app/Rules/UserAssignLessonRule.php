<?php

namespace App\Rules;

use App\Mappers\UserTypeMapper;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class UserAssignLessonRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $user = User::find($value);

        return $user && in_array($user->type, [UserTypeMapper::TEACHER, UserTypeMapper::STUDENT]);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Only teachers and students can assign to lessons.';
    }
}
