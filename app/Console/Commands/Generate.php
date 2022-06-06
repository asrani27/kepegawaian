<?php

namespace App\Console\Commands;

use App\Models\M_unit1;
use App\Models\M_unit2;
use App\Models\M_unit3;
use App\Models\M_jenjab;
use App\Models\M_keljab;
use App\Models\M_pangkat;
use App\Models\M_unitkerja;
use Illuminate\Console\Command;

class Generate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate {--modul=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $modul = $this->option('modul');
        if ($modul == 'jenjab') {
            $jenjab = M_jenjab::get();
            foreach ($jenjab as $item) {
                $item->update([
                    'keljab_id' => M_keljab::where('kode', $item->kode_keljab)->first()->id,
                    'min_pangkat_id' => M_pangkat::where('kode', $item->min_golpangkat)->first()->id,
                    'max_pangkat_id' => M_pangkat::where('kode', $item->max_golpangkat)->first()->id,
                ]);
            }
        } elseif ($modul == 'unitkerja') {
            $unitkerja = M_unitkerja::get();
            foreach ($unitkerja as $item) {
                $item->update([
                    'nama_unit1' => M_unit1::where('kode', $item->kode_unit1)->first()->nama,
                    'nama_unit2' => M_unit2::where('kode', $item->kode_unit2)->first()->nama,
                    'nama_unit3' => M_unit3::where('kode', $item->kode_unit3)->first()->nama,
                ]);
            }
        } else {
        }
    }
}
