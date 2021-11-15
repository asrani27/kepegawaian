<?php

namespace App\Jobs;

use App\Models\Pegawai;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SyncAdminPegawai implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $attr['nip']             = $this->data->nip;
        $attr['nama']            = $this->data->nama;
        $attr['skpd_id']         = $this->data->skpd_id;
        $attr['tanggal_lahir']   = $this->data->tanggal_lahir;
        $attr['status_aktif']    = 1;
        
        $check = Pegawai::where('nip', $attr['nip'])->first();
        if($check == null){
            
            Pegawai::create($attr);
        }else{
            $check->update(['skpd_id' => $attr['skpd_id']]);
        }
    }
}
