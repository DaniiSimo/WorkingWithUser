<?php

namespace App\Http\Requests\User;

use App\DTO\UpdateUserDTO;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->wantsJson() || $this->ajax();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'username' => ['nullable','string', 'max:255', 'unique:users,username'],
            'name' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function dto(): UpdateUserDTO {
        return UpdateUserDTO::fromArray(
            data: array_merge($this->safe()->only(['username', 'name']), ['user' => Auth::user()])
        );
    }

    public function failedValidation(Validator $validator):void
    {
        $payload = [
            'description' => 'Ошибка валидации',
            'errors'      => $validator->errors(),
        ];

        throw new HttpResponseException(response: response()->json(data: $payload, status: 422));
    }
}
