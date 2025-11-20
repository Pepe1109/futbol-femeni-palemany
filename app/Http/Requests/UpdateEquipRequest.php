<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEquipRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $equipId = $this->route('equip'); // si la ruta usa {equip}

        return [
            'nom' => ['required','string','min:3', Rule::unique('equips','nom')->ignore($equipId)],
            'ciutat' => 'nullable|string|min:2',
            'lliga' => 'nullable|string|min:2',
            'escut' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048'
        ];
    }
}
