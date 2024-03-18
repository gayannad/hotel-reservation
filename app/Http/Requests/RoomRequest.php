<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
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
        if (request()->isMethod('POST')) {
            return [
                'name' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string'],
                'capacity' => ['required', 'numeric'],
                'price' => ['required', 'numeric'],
                'image' => ['required', 'file'],
                'type' => ['required', 'string'],
            ];
        } else {
            return [
                'name' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string'],
                'capacity' => ['required', 'numeric'],
                'price' => ['required', 'numeric'],
                'type' => ['required', 'string'],
            ];
        }
    }
}
