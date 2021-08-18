<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnitDaftarReq extends FormRequest
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
            'nama_unit' => 'required',
            'email'     => 'required|unique:unit',
            'no_telp'     => 'required|unique:unit',
            'alamat'     => 'required',
            'bukti_alumni'  => 'required|file|mimes:doc,csv,xlsx,xls,docx,ppt,pdf',
        ];
    }
}
