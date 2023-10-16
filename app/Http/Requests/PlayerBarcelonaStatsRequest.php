<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlayerBarcelonaStatsRequest extends FormRequest
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
            'birth_date' => ['required', 'date'],
            'height' => ['required', 'string', 'max:20'],
            'weight' => ['required', 'string', 'max:20'],
            'nationality' => ['required', 'string', 'max:255'],
            'injured' => ['required', 'boolean'],
            'games_appearances' => ['nullable', 'integer'],
            'games_lineups' => ['nullable', 'integer'],
            'games_minutes' => ['nullable', 'integer'],
            'games_rating' => ['nullable', 'integer'],
            'substitutes_in' => ['nullable', 'integer'],
            'substitutes_out' => ['nullable', 'integer'],
            'substitutes_bench' => ['nullable', 'integer'],
            'shots_total' => ['nullable', 'integer'],
            'shots_on' => ['nullable', 'integer'],
            'goals_total' => ['nullable', 'integer'],
            'goals_conceded' => ['nullable', 'integer'],
            'goals_assists' => ['nullable', 'integer'],
            'goals_saves' => ['nullable', 'integer'],
            'passes_total' => ['nullable', 'integer'],
            'passes_key' => ['nullable', 'integer'],
            'passes_accuracy' => ['nullable', 'integer'],
            'tackles_total' => ['nullable', 'integer'],
            'tackles_blocks' => ['nullable', 'integer'],
            'tackles_interceptions' => ['nullable', 'integer'],
            'duels_total' => ['nullable', 'integer'],
            'duels_won' => ['nullable', 'integer'],
            'dribbles_attempts' => ['nullable', 'integer'],
            'dribbles_success' => ['nullable', 'integer'],
            'dribbles_past' => ['nullable', 'integer'],
            'fouls_drawn' => ['nullable', 'integer'],
            'fouls_committed' => ['nullable', 'integer'],
            'cards_yellow' => ['nullable', 'integer'],
            'cards_yellowred' => ['nullable', 'integer'],
            'cards_red' => ['nullable', 'integer'],
            'penalty_won' => ['nullable', 'integer'],
            'penalty_committed' => ['nullable', 'integer'],
            'penalty_scored' => ['nullable', 'integer'],
            'penalty_missed' => ['nullable', 'integer'],
            'penalty_saved' => ['nullable', 'integer'],
        ];
    }
}
