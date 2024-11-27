<?php
namespace App\Domains\UserDomain\Validators;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserValidator
{
    public static function validateCreate(array $data): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'user_type' => 'required|in:recruiter,candidate',
            'company_id' => 'required_if:user_type,recruiter|exists:companies,id',
        ];

        return self::validate($data, $rules);
    }

    public static function validateUpdate(array $data, int $id): array
    {
        $rules = [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'user_type' => 'sometimes|in:recruiter,candidate',
            'company_id' => 'required_if:user_type,recruiter|exists:companies,id',
        ];

        return self::validate($data, $rules);
    }

    private static function validate(array $data, array $rules): array
    {
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $validator->validated();
    }
}
