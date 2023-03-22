<?php

namespace App\Http\Requests\Dashboard\Service;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Service;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\Rule;

class UpdateServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title'           =>  ['required', 'string', 'max:255'],
            'description'     =>  ['nullable', 'string', 'max:5000'],
            'delivery_time'   =>  ['required', 'integer', 'max:100'],
            'revision_limit'   =>  ['required', 'integer', 'max:100'],
            'price'           =>  ['required', 'string'],
            'note'            =>  ['nullable', 'string', 'max:5000'],
        ];
    }
}
