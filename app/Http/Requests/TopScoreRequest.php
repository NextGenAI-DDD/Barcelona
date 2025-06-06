<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TopScoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            '*.name' => ['required'],
            '*.photo'  => ['required', 'string', 'max:80'],
            '*.goals'  => ['required', 'integer'],
            '*.games_appearances'  => ['required', 'integer'],
            '*.games_minutes'  => ['required', 'integer'],
            '*.games_position'  => ['required', 'string', 'max:15'],
            '*.club_name' => ['required', 'string', 'max:80'],
            '*.club_logo' => ['required', 'string', 'max:180'],
        ];
    }
}
