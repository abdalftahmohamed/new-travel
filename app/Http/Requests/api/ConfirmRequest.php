<?php

namespace App\Http\Requests\api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rules\Password as RulesPassword;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ConfirmRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'password' => ['required', 'confirmed', RulesPassword::defaults()],
        ];
    }
    protected function failedValidation(Validator $validator)
    {

        $response = new JsonResponse([
            'status'=>false,
            'message'=>[
                'en' => 'Validation Error',
                'ar' => 'خطأ في التحقق',
            ],
            'errors' => $validator->messages()->all(),
        ], 422);

        throw new ValidationException($validator,$response);
    }
}
