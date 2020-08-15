<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MentorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama_mentor'   => 'required|min:3|max:100',
            'kompetensi'    => 'required',
            'foto' => 'sometimes|nullable|image|mimes:jpeg,jpg,png,bmp'
        ];
    }
}
