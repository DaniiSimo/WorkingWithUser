<?php

namespace App\Http\Requests\User;

use App\DTO\CreateUserDTO;
use App\Http\Resources\ErrorResource;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreRequest extends FormRequest
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
            'email' => ['required','email', 'max:255', 'unique:users,email'],
            'username' => ['required','string', 'max:255', 'unique:users,username'],
            'name' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function dto(): CreateUserDTO {
        return CreateUserDTO::fromArray(
            data: $this->safe()->only(['username', 'name', 'email']),
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
