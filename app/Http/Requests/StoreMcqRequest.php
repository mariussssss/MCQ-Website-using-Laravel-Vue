<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMcqRequest extends FormRequest
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
            'name' => 'required',
            'color' => 'required',
            'questionTab' => 'required|array|min:1',
            'questionTab.*.text' => 'required',
            'questionTab.*.answers' => 'required|array|min:2|max:4',
            'questionTab.*.answers.*' => 'required',
            'questionTab.*.answers.*.text' => 'required',
            'questionTab.*.answers.*.isCorrect' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'questionTab.*.text' => 'The question field is required',
            'questionTab.*.answers.*.text'  => 'The answer field is required',
        ];
    }
}
