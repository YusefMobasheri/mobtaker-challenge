<?php

namespace App\Http\Requests;

use App\Mappers\UserTypeMapper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserCreateRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:6',
            'school_id' => 'required|integer|exists:schools,id',
            'type' => ['required', 'string', Rule::in([UserTypeMapper::MANAGER, UserTypeMapper::TEACHER, UserTypeMapper::STUDENT])]
        ];
    }
}
