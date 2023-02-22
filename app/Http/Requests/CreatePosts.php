<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePosts extends FormRequest
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
            'message' => 'required|max:200',
            'date' => 'required|date|after_or_equal:today',
        ];
    }

    public function attributes()
    {
        return [
            'message' => 'メッセージ',
            'date' => '期限日',
        ];
    }

    public function messages()
    {
        return [
            'date.after_or_equal' => ':attribute には今日以降の日付を入力してください。',
        ];
    }
}
