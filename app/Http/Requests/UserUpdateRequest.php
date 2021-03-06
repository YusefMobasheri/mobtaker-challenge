<?php

namespace App\Http\Requests;

use App\Mappers\UserTypeMapper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
            'name' => 'sometimes|required|string',
            'email' => 'sometimes|required|email',
            'school_id' => 'sometimes|required|integer|exists:schools,id',
            'type' => ['sometimes', 'required', 'string', Rule::in([UserTypeMapper::MANAGER, UserTypeMapper::TEACHER, UserTypeMapper::STUDENT])]
        ];
    }
}
