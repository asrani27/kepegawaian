<?php

namespace App\Console\Commands;

use App\Models\Pegawai;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class importasn extends Command
{

    public function __construct()
    {
        parent::__construct();
    }

    protected $signature = 'import:asn-excel {file=excel/dataasn.xlsx}';
    protected $description = 'Import ASN dari Excel, update jika nip sudah ada.';

    public function handle()
    {
        $filePath = public_path($this->argument('file'));

        if (!File::exists($filePath)) {
            $this->error("File tidak ditemukan: {$filePath}");
            return Command::FAILURE;
        }

        $data = Excel::toArray([], $filePath);
        $rows = $data[0]; // Sheet pertama

        if (count($rows) < 2) {
            $this->error("Data kosong atau format salah.");
            return Command::FAILURE;
        }

        $header = array_map('strtolower', array_map('trim', $rows[0]));
        $nipIndex = array_search('nip', $header);
        $namaIndex = array_search('nama', $header);
        $telpIndex = array_search('nomor telpon', $header);
        $ket_jabatanIndex = array_search('jabatan nama', $header);
        $skpdIndex = array_search('unor', $header);

        if ($nipIndex === false || $namaIndex === false) {
            $this->error("Kolom 'nip' dan 'nama' tidak ditemukan.");
            return Command::FAILURE;
        }

        $totalBaru = 0;
        $totalUpdate = 0;

        foreach (array_slice($rows, 1) as $row) {
            $nip = trim($row[$nipIndex] ?? '');
            $nama = trim($row[$namaIndex] ?? '');
            $telp = trim($row[$telpIndex] ?? '');
            $skpd = trim($row[$skpdIndex] ?? '');
            $ket_jabatan = trim($row[$ket_jabatanIndex] ?? '');

            if ($nip && $nama) {
                $pegawai = Pegawai::where('nip', $nip)->first();
                if ($pegawai) {
                    $pegawai->nama = $nama;
                    $pegawai->ket_jabatan = $ket_jabatan;
                    $pegawai->skpd = $skpd;
                    $pegawai->telp = $telp;
                    $pegawai->save();
                    $totalUpdate++;
                } else {
                    Pegawai::create(['nip' => $nip, 'nama' => $nama, 'telp' => $telp]);
                    $totalBaru++;
                }
            }
        }

        $this->info("Import selesai.");
        $this->info("Baru ditambahkan: {$totalBaru}");
        $this->info("Data diupdate: {$totalUpdate}");

        return Command::SUCCESS;
    }
}
