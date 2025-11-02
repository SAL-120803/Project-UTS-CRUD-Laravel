<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MahasiswaExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Mahasiswa::select('id', 'nama', 'nim', 'email', 'created_at')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Nama', 'NIM', 'Email', 'Tanggal Dibuat'];
    }
}
