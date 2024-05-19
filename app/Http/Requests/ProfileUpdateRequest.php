<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'phone' => ['nullable', 'string', 'max:20'], // Adjust max length as needed
            'ville' => ['required', 'string', Rule::in(['Agadir', 'Al Hoceima', 'Azemmour', 'Beni Mellal', 'Benslimane', 'Bouznika', 'Casablanca', 'Chefchaouen', 'Dakhla', 'El Jadida', 'Erfoud', 'Essaouira', 'Fes', 'Fnideq', 'Guelmim', 'Ifrane', 'Kenitra', 'Khemisset', 'Khenifra', 'Khouribga', 'Ksar El Kebir', 'Laayoune', 'Larache', 'Marrakech', 'Martil', 'Meknes', 'Mohammedia', 'Nador', 'Oualidia', 'Ouarzazate', 'Oujda', 'Rabat', 'Safi', 'Sale', 'Tangier', 'Tan-Tan', 'Taroudant', 'Taza', 'Temara', 'Tetouan', 'Tiznit', 'Zagora'])],
        ];
    }
}
