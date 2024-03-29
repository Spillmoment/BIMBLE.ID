<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnitRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        if (request()->isMethod('post')) {
            $email = 'required|email|unique:unit';
            $password = 'required|min:3';
            $konfirmasi_password = 'required|same:password|min:3';
        } elseif (request()->isMethod('put')) {
            $email = 'required|email|unique:unit,email,' . $this->unit->id;;
            $password = 'sometimes|nullable|min:3';
            $konfirmasi_password = 'sometimes|same:password|nullable|min:3';
        }

        return [
            'nama_unit'             => 'required|min:3|max:100',
            'deskripsi'             => 'required|min:10',
            'alamat'                => 'required|min:3|max:200',
            'email'                 =>  $email,
            'whatsapp'              => 'required',
            'telegram'              => 'required',
            'instagram'             => 'required',
            'password'              => $password,
            'konfirmasi_password'   => $konfirmasi_password,
            'status'                => 'nullable'
        ];
    }
}
