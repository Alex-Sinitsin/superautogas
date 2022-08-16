<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nickname' => ['required', 'string', 'max:255'],
            'car_model' => ['required', 'string'],
            'rating' => ['required', 'integer', 'min:1'],
            'text' => ['required'],
            'is_published' => ['nullable', 'boolean']
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['is_published' => (bool) $this->is_published, 'rating' => (int) $this->rating]);
    }
}
