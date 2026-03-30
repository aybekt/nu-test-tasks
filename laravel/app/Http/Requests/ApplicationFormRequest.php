<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationFormRequest extends FormRequest
{
    private const IIN_LENGTH = 12;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:255'],
            'iin' => ['required', 'digits:' . self::IIN_LENGTH],
            'date' => ['required', 'date'],
            'text' => ['required', 'string', 'max:5000'],
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.required' => 'Введите ФИО.',
            'iin.required' => 'Введите ИИН.',
            'iin.digits' => 'ИИН должен содержать ' . self::IIN_LENGTH . ' цифр.',
            'date.required' => 'Выберите дату.',
            'date.date' => 'Некорректная дата.',
            'text.required' => 'Введите текст.',
        ];
    }

    protected function prepareForValidation(): void
    {
        // Нормализуем ввод: убираем пробелы/символы в числовых полях и подрезаем текст.
        $this->merge([
            'full_name' => trim((string) $this->input('full_name')),
            'iin' => preg_replace('/\D+/', '', (string) $this->input('iin')),
            'text' => trim((string) $this->input('text')),
        ]);
    }
}
