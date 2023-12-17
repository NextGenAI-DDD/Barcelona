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
            '*.referee' => ['nullable', 'string', 'max:255'],
            '*.stadium'  => ['nullable', 'string', 'max:255'],
            '*.city'  => ['nullable', 'string', 'max:255'],
            '*.date'  => ['nullable'],
            '*.home_team_name'  => ['nullable', 'string', 'max:255'],
            '*.home_team_logo'  => ['nullable', 'string', 'max:255'],
            '*.home_team_winner'  => ['nullable', 'boolean'],
            '*.away_team_name'  => ['nullable', 'string', 'max:255'],
            '*.away_team_logo'  => ['nullable', 'string', 'max:255'],
            '*.away_team_winner'  => ['nullable', 'boolean'],
            '*.league_name'  => ['nullable', 'string', 'max:255'],
            '*.league_logo'  => ['nullable', 'string', 'max:255'],
            '*.league_round'  => ['nullable', 'string', 'max:255'],
            '*.goals_home'  => ['nullable', 'integer'],
            '*.goals_away'  => ['nullable', 'integer'],
            '*.home_penalty'  => ['nullable', 'integer'],
            '*.away_penalty'  => ['nullable', 'integer'],
        ];
    }
}
