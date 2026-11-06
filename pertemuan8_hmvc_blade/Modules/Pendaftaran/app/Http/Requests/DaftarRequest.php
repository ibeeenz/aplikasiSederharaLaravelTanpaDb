<?php

namespace Modules\Pendaftaran\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DaftarRequest extends FormRequest
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
     * The file is required when creating, and optional when updating (keep the old file).
     *
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        $daftar = $this->route('daftar');

        return [
            'nama' => ['required', 'string', 'max:255'],
            'asal_sekolah' => ['required', 'string', 'max:255'],
            'prodi_tujuan' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('daftars', 'email')->ignore($daftar?->id),
            ],
            'no_hp' => ['required', 'string', 'regex:/^08[0-9]{8,13}$/'],
            'berkas' => [
                $this->isMethod('POST') ? 'required' : 'nullable',
                'file',
                'mimes:pdf',
                'max:2048',
            ],
        ];
    }
}