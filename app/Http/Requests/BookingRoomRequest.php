<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRoomRequest extends FormRequest
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
            'fullname' => ['required', 'string', 'regex:/(^[A-Z][a-z]+ [A-Z][a-z]+( [A-Z][a-z]+)?$)|(^[А-Я][а-я]+ [А-Я][а-я]+( [А-Я][а-я]+)?$)/u', 'max:255'],
            'age' => ['required', 'integer'],
            'institute' => ['required', 'string', 'max:255'],
            'course' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'regex:/((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,20}/u', 'max:255'],
            'social_network' => ['string', 'max:255'],
        ];
    }
}
