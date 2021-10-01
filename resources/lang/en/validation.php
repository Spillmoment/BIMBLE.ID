<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Inputan :attribute harus diterima.',
    'active_url' => 'Inputan :attribute bukan URL yang valid.',
    'after' => 'Inputan :attribute harus tanggal setelah :date.',
    'after_or_equal' => 'Inputan :attribute harus berupa tanggal setelah atau sama dengan tanggal :date.',
    'alpha' => 'Inputan :attribute hanya boleh berisi huruf.',
    'alpha_dash' => 'Inputan :attribute hanya boleh berisi huruf, angka, dan strip.',
    'alpha_num' => 'Inputan :attribute hanya boleh berisi huruf dan angka.',
    'array' => 'Inputan :attribute harus berupa sebuah array.',
    'before' => 'Inputan :attribute harus tanggal sebelum tanggal :date.',
    'before_or_equal' => 'Inputan :attribute harus berupa tanggal sebelum atau sama dengan tanggal :date.',
    'between' => [
        'numeric' => 'Inputan :attribute harus di antara :min dan :max.',
        'file' => 'Inputan :attribute harus di antara :min dan :max kilobytes.',
        'string' => 'Inputan :attribute harus di antara :min dan :max karakter.',
        'array' => 'Inputan :attribute harus ada di antara :min dan :max item.',
    ],
    'boolean' => 'Inputan  :attribute harus bernilai true or false.',
    'confirmed' => 'Inputan :attribute konfirmasi tidak cocok.',
    'date' => 'Inputan :attribute bukan tanggal yang valid.',
    'date_equals' => 'Inputan :attribute harus sama dengan tanggal :date.',
    'date_format' => 'Inputan :attribute tidak cocok dengan format :format.',
    'different' => 'Inputan :attribute dan :other harus berbeda.',
    'digits' => 'Inputan :attribute harus berupa angka :digits.',
    'digits_between' => 'Inputan :attribute harus di antara angka :min dan angka :max.',
    'dimensions' => 'Inputan :attribute memiliki dimensi gambar yang tidak valid.',
    'distinct' => 'Inputan  :attribute memiliki nilai duplikat.',
    'document' => 'Inputan :attribute harus berupa dokumen.',
    'email' => 'Inputan :attribute harus alamat e-mail yang valid.',
    'ends_with' => 'Inputan :attribute harus diakhiri dengan salah satu dari yang berikut: :values',
    'exists' => 'Inputan :attribute yang dipilih tidak valid.',
    'file' => 'Inputan :attribute harus berupa file.',
    'filled' => 'Inputan  :attribute harus memiliki nilai.',
    'gt' => [
        'numeric' => 'Inputan :attribute harus lebih besar dari :value.',
        'file' => 'Inputan :attribute harus lebih besar dari :value kilobytes.',
        'string' => 'Inputan :attribute harus lebih besar dari :value karakter.',
        'array' => 'Inputan :attribute harus memiliki lebih dari :value item.',
    ],
    'gte' => [
        'numeric' => 'Inputan :attribute harus lebih besar atau sama dengan :value.',
        'file' => 'Inputan :attribute harus lebih besar atau sama dengan :value kilobytes.',
        'string' => 'Inputan :attribute harus lebih besar atau sama dengan :value karakter.',
        'array' => 'Inputan :attribute harus punya :value item atau lebih.',
    ],
    'image' => 'Inputan :attribute harus berupa gambar.',
    'in' => 'Inputan :attribute yang dipilih tidak valid.',
    'in_array' => 'Inputan  :attribute tidak ada di :other.',
    'integer' => 'Inputan :attribute harus berupa integer.',
    'ip' => 'Inputan :attribute harus valid dengan IP address.',
    'ipv4' => 'Inputan :attribute harus valid dengan IPv4 address.',
    'ipv6' => 'Inputan :attribute harus valid dengan IPv6 address.',
    'json' => 'Inputan :attribute harus valid dengan JSON string.',
    'lt' => [
        'numeric' => 'Inputan :attribute harus kurang dari :value.',
        'file' => 'Inputan :attribute harus kurang dari :value kilobytes.',
        'string' => 'Inputan :attribute harus kurang dari :value karakter.',
        'array' => 'Inputan :attribute harus kurang dari :value item.',
    ],
    'lte' => [
        'numeric' => 'Inputan :attribute harus kurang dari atau sama dengan :value.',
        'file' => 'Inputan :attribute harus kurang dari atau sama dengan :value kilobytes.',
        'string' => 'Inputan :attribute harus kurang dari atau sama dengan :value karakter.',
        'array' => 'Inputan :attribute seharusnya tidak boleh lebih dari :value item.',
    ],
    'max' => [
        'numeric' => 'Inputan :attribute seharusnya tidak lebih besar dari :max.',
        'file' => 'Inputan :attribute seharusnya tidak lebih besar dari :max kilobytes.',
        'string' => 'Inputan :attribute seharusnya lebih besar dari :max karakter.',
        'array' => 'Inputan :attribute seharusnya memiliki lebih dari :max item.',
    ],
    'mimes' => 'Inputan :attribute harus berupa file bertipe: :values.',
    'mimetypes' => 'Inputan :attribute harus berupa file bertipe: :values.',
    'min' => [
        'numeric' => 'Inputan :attribute harus minimal :min.',
        'file' => 'Inputan :attribute harus minimal :min kilobytes.',
        'string' => 'Inputan :attribute harus minimal :min karakter.',
        'array' => 'Inputan :attribute minimal harus :min item.',
    ],
    'not_in' => 'Inputan :attribute yang dipilih tidak valid.',
    'not_regex' => 'Inputan :attribute format tidak valid.',
    'numeric' => 'Inputan :attribute berupa angka.',
    'password' => 'Inputan password salah.',
    'present' => 'Inputan  :attribute harus ada.',
    'regex' => 'Inputan :attribute format tidak valid.',
    'required' => 'Inputan  :attribute wajib diisi.',
    'required_if' => 'Inputan  :attribute wajib diisi bila :other adalah :value.',
    'required_unless' => 'Inputan  :attribute wajib diisi kecuali :other ada di :values.',
    'required_with' => 'Inputan  :attribute wajib diisi bila terdapat :values.',
    'required_with_all' => 'Inputan  :attribute wajib diisi bila terdapat :values.',
    'required_without' => 'Inputan  :attribute wajib diisi bila tidak terdapat :values.',
    'required_without_all' => 'Inputan  :attribute wajib diisi bila tidak terdapat :values yang ada.',
    'same' => 'Inputan :attribute dan :other harus cocok.',
    'size' => [
        'numeric' => 'Inputan :attribute harus berukuran :size.',
        'file' => 'Inputan :attribute harus berukuran :size kilobytes.',
        'string' => 'Inputan :attribute harus berukuran :size karakter.',
        'array' => 'Inputan :attribute harus mengandung :size item.',
    ],
    'starts_with' => 'Inputan :attribute harus dimulai dengan salah satu dari yang berikut: :values',
    'string' => 'Inputan :attribute harus berupa string.',
    'timezone' => 'Inputan :attribute harus berupa zona waktu yang valid.',
    'unique' => 'Inputan :attribute sudah ada sebelumnya.',
    'uploaded' => 'Inputan :attribute gagal diunggah.',
    'url' => 'Inputan :attribute format tidak valid.',
    'uuid' => 'Inputan :attribute harus berupa UUID yang valid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
