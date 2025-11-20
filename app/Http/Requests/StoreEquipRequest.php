<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEquipRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nom' => 'required|string|min:3|unique:equips,nom',
            'ciutat' => 'nullable|string|min:2',
            'lliga' => 'nullable|string|min:2',
            'escut' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048'
        ];
    }
}
