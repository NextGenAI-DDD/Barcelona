<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GamesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            '*.referee' => ['required', 'string', 'nullable', 'max:80'],
            '*.stadium'  => ['required', 'string', 'max:80'],
            '*.city'  => ['required', 'string', 'max:80'],
            '*.date'  => ['required', 'dateTime'],
            '*.home_team_name'  => ['required', 'string', 'max:80'],
            '*.home_team_logo'  => ['required', 'string', 'max:80'],
            '*.home_team_winner'  => ['required', 'boolean'],
            '*.away_team_name'  => ['required', 'string', 'max:80'],
            '*.away_team_logo'  => ['required', 'string', 'max:80'],
            '*.away_team_winner'  => ['required', 'boolean'],
            '*.league_name'  => ['required', 'string', 'max:80'],
            '*.league_logo'  => ['required', 'string', 'max:80'],
            '*.league_round'  => ['required', 'string', 'max:80'],
            '*.goals_home'  => ['required', 'integer', 'nullable'],
            '*.goals_away'  => ['required', 'integer', 'nullable'],
            '*.home_penalty'  => ['required', 'integer', 'nullable'],
            '*.away_penalty'  => ['required', 'integer', 'nullable'],

        ];
    }
}
