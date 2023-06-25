<?php

namespace App\Http\Requests;

use App\Enum\Cardinality;
use App\Models\Entity;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRelationshipRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // TODO, correctly authorize this
        return true;
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
                'bail',
                'required',
                'string',
                'max:255',
            ],
            'parent_entity_id' => [
                'bail',
                'required',
                'string',
                Rule::exists('entities', 'ulid'),
            ],
            'child_entity_id' => [
                'bail',
                'required',
                'string',
                Rule::exists('entities', 'ulid'),
            ],
            'minimum' => [
                'bail',
                'required',
                Rule::enum(Cardinality::class),
            ],
            'maximum' => [
                'bail',
                'required',
                Rule::enum(Cardinality::class),
            ]
        ];
    }

    public function parentEntity(): Entity
    {
        return Entity::whereUlid($this->input('parent_entity_id'))->first();
    }

    public function childEntity(): Entity
    {
        return Entity::whereUlid($this->input('child_entity_id'))->first();
    }
}
