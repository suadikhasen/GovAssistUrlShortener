<?php

namespace App\Http\Requests;

use App\Services\UrlService;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

/**
 * Custom Form Request for handling URL shortener requests.
 * This class validates incoming requests for creating short URLs.
 * It is used for both API and web routes.
 */
class ShortenUrlRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
//        If the request is from api authentication is not required
        if (request()->is('api/shorten_url')){
            return  true;
        }
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'destination' => ['required','url']
        ];
    }

    /**
     * @param $key
     * @param $default
     * @return array|string[]
     */
    public function validated($key = null, $default = null): array
    {
       return array_merge(parent::validated(),[
           'slug' => UrlService::generateUniqueSlug()
       ]);
    }

    /**
     * @param Validator $validator
     * @return void
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator): void
    {
        if (request()->is('api/shorten_url')){
            throw new HttpResponseException(response()->json($validator->errors(),Response::HTTP_UNPROCESSABLE_ENTITY));
        }
        parent::failedValidation($validator);
    }



}
