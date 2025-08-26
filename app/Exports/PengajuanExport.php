<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Pengajuan;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class PengajuanExport implements FromCollection, WithHeadings, WithMapping, WithCustomStartCell, ShouldAutoSize, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Pengajuan::where('jenis', 'slks')->where('status', '!=', 0)->get();
    }
    public function startCell(): string
    {
        return 'A3'; // Header mulai dari A3
    }

    /**
     * Header kolom
     */
    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'NIP',
            'Permohonan',
            'Waktu Usul',
            'Keterangan',
            'Waktu Selesai',
        ];
    }
    public function map($pengajuan): array
    {
        static $no = 0;
        $no++;
        if ($pengajuan->status == 1 && $pengajuan->verifikator == null) {
            $keterangan = 'Baru';
        } elseif ($pengajuan->status == 1 && $pengajuan->verifikator != null) {
            $keterangan = 'Diproses';
        } elseif ($pengajuan->status == 2) {
            $keterangan = 'Memenuhi Syarat (MS)';
        } else {
            $keterangan = '-';
        }


        return [
            $no,
            $pengajuan->pegawai->nama ?? '',
            "'" . $pengajuan->pegawai->nip ?? '',
            $pengajuan->layanan->nama ?? '',
            Carbon::parse($pengajuan->created_at)->translatedFormat('d F Y H:i:s') ?? '',
            $keterangan,
            Carbon::parse($pengajuan->updated_at)->translatedFormat('d F Y H:i:s') ?? '',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // === Judul Utama di A1 ===
                $sheet->mergeCells('A1:G1');
                $sheet->setCellValue('A1', 'Daftar Permohonan Usulan Satyalencana Karya Satya');


                $sheet->getRowDimension(1)->setRowHeight(25);

                // === Header Tabel di A3:G3 ===
                $sheet->getStyle('A3:G3')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF'], // putih
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                    'fill' => [
                        'fillType'   => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '4CAF50'], // hijau
                    ],
                ]);
                $sheet->getRowDimension(3)->setRowHeight(20);
            },
        ];
    }
}
