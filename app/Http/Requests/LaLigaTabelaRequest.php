<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LaLigaTabelaRequest extends FormRequest
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
            '*.rank' => ['required'],
            '*.logo'  => ['required', 'string', 'max:80'],
            '*.team'  => ['required', 'string', 'max:30'],
            '*.match_played'  => ['required'],
            '*.win'  => ['required'],
            '*.draw'  => ['required'],
            '*.lose'  => ['required'],
            '*.goals_for'  => ['required'],
            '*.goals_against'  => ['required'],
            '*.goals_diff'  => ['required'],
            '*.points'  => ['required'],
            '*.form'  => ['required'],
        ];
    }
}
