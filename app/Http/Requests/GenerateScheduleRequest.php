<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenerateScheduleRequest extends FormRequest
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
            'date' => 'required|date_format:Y-m-d',
            'doctor_id' => 'nullable|exists:users,id',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'duration' => 'required|integer|min:5',

        ];
    }

    public function messages()
    {
        return [
            'date.required' => 'La fecha es obligatoria.',
            'doctor_id.exists' => 'El médico seleccionado no existe.',
            'start_time.required' => 'La hora de inicio es obligatoria.',
            'start_time.date_format' => 'El formato de la hora de inicio debe ser H:i.',
            'end_time.required' => 'La hora de fin es obligatoria.',
            'end_time.date_format' => 'El formato de la hora de fin debe ser H:i.',
            'end_time.after' => 'La hora de fin debe ser posterior a la hora de inicio.',
            'duration.required' => 'La duración es obligatoria.',
            'duration.integer' => 'La duración debe ser un número entero.',
            'duration.min' => 'La duración debe ser al menos de 5 minutos.',
        ];
    }

}
