<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateEntityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return with($this->user(), fn(User $user) => $user->ownsTeam($user->currentTeam));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('entities', 'name')
                    ->where('team_id', $this->user()->currentTeam->id)
            ],
            'description' => ['sometimes', 'required', 'string', 'max:255'],
        ];
    }
}
