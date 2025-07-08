<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Pegawai;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
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
        $totalUserBaru = 0;
        $totalUserUpdate = 0;

        foreach (array_slice($rows, 1) as $i => $row) {
            $index = $i + 2;

            $nip = trim($row[$nipIndex] ?? '');
            $nama = trim($row[$namaIndex] ?? '');
            $telp = trim($row[$telpIndex] ?? '');
            $skpd = trim($row[$skpdIndex] ?? '');
            $ket_jabatan = trim($row[$ket_jabatanIndex] ?? '');

            if ($nip && $nama) {
                // 🔐 Buat atau update User
                $user = User::where('username', $nip)->first();
                if ($user) {
                    $user->password = Hash::make('simpegbjm');
                    $user->save();
                    $totalUserUpdate++;
                    $this->line("[$index] 🔑 Update user: $nip (password direset)");
                } else {
                    $user = User::create([
                        'username' => $nip,
                        'name' => $nama,
                        'password' => Hash::make('simpegbjm'),
                    ]);
                    $totalUserBaru++;
                    $this->info("[$index] ✅ Buat user baru: $nip");
                }

                // 👤 Buat atau update Pegawai
                $pegawai = Pegawai::where('nip', $nip)->first();
                if ($pegawai) {
                    $pegawai->update([
                        'nama' => $nama,
                        'ket_jabatan' => $ket_jabatan,
                        'skpd' => $skpd,
                        'telp' => $telp,
                        'user_id' => $user->id,
                    ]);
                    $totalUpdate++;
                    $this->line("[$index] ✏️  Update pegawai: $nip - $nama");
                } else {
                    Pegawai::create([
                        'nip' => $nip,
                        'nama' => $nama,
                        'telp' => $telp,
                        'skpd' => $skpd,
                        'ket_jabatan' => $ket_jabatan,
                        'user_id' => $user->id,
                    ]);
                    $totalBaru++;
                    $this->info("[$index] ➕ Tambah pegawai baru: $nip - $nama");
                }
            }
        }

        $this->info("Import selesai.");
        $this->info("Pegawai ditambahkan: {$totalBaru}");
        $this->info("Pegawai diupdate: {$totalUpdate}");
        $this->info("User baru dibuat: {$totalUserBaru}");
        $this->info("User diupdate (password): {$totalUserUpdate}");

        return Command::SUCCESS;
    }
}
