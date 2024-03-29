<?php

namespace App\Http\Requests;

use App\Models\Entity;
use App\Models\Instance;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateInstanceRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'parent_instance_id' => [
                'bail',
                'sometimes',
                'required',
                'string',
                Rule::exists('instances', 'ulid')
                    ->where('team_id', $this->team())
            ],
            'entity_id' => [
                'bail',
                'required',
                'string',
                Rule::exists('entities', 'ulid')
                    ->where('team_id', $this->team())
            ],
            'attributes' => [
                'bail',
                'required',
                'array',
            ],
            'attributes.*.attribute_id' => [
                'bail',
                'required',
                'string',
                Rule::exists('attributes', 'ulid')
            ],
            'attributes.*.value' => [
                'bail',
                'required',
                //TODO: Support custom validation
            ]
        ];
    }

    public function entity(): Entity
    {
        return Entity::whereUlid($this->input('entity_id'))->first();
    }

    public function parentInstance(): ?Instance
    {
        return Instance::whereUlid($this->input('parent_instance_id'))->first();
    }
}
