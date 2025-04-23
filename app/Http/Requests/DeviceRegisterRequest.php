<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeviceRegisterRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'device_name' => 'nullable|string|max:255',
            'device_token' => [
                'required',
                'string',
                'max:255',
                Rule::unique('devices')->where(function ($query) {
                    return $query->where('user_id', $this->input('user_id'))
                        ->where('device_name', $this->input('device_name'));
                })
            ]
        ];
    }
}
