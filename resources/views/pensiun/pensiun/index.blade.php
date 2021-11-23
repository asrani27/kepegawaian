@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

@endpush
@section('title')
Pensiun
@endsection
@section('content')

<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header bg-gradient-secondary">
          <h3 class="card-title">Daftar Pengajuan Pensiun</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover table-sm table-striped">
              <thead>
                  <th>No</th>
                  <th>NIP/Nama/Jabatan</th>
                  <th>Jenis</th>
                  <th>Tanggal Di Buat</th>
                  <th>SKPD</th>
                  <th>Aksi</th>
              </thead>
              <tbody>
                @foreach ($data as $key => $item) 
                <tr style="font-size:10px; font-family:Arial, Helvetica, sans-serif">
                  <td>{{$data->firstItem() + $key}}</td>
                  <td>{{$item->pegawai->nip}} <br/>{{$item->pegawai->nama}}<br/>{{$item->pegawai->nm_pangkat}} / {{$item->pegawai->pol_pangkat}}</td>
                  <td>
                    @if ($item->jenis == 1)
                        APS
                    @elseif($item->jenis == 2)
                        BUP
                    @elseif($item->jenis == 3)
                        UZUR/SAKIT
                    @elseif($item->jenis == 4)
                        JANDA/DUDA/YATIM
                    @endif
                  </td>
                  <td>{{\Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i')}}</td>
                  <td>{{$item->pegawai->skpd}} <br/>
                    Telah Di Validasi Oleh Umpeg
                  </td>
                  <td>
                    
                    <a href="/pensiun/pensiun/{{$item->id}}/dokumen" class="btn btn-xs btn-outline-primary"> <i class="fas fa-file"></i> LIHAT DOKUMEN</a><br/>
                    
                    <a href="#" data-id="{{$item->id}}" class="btn btn-xs kembalikan btn-outline-danger"> <i class="fas fa-hand-paper"></i> TOLAK / KEMBALIKAN</a><br/>

                    {{-- <a href="/kepangkatan/pangkat/{{$item->id}}/zip" class="btn btn-xs btn-outline-success"> <i class="fas fa-download"></i> DOWNLOAD DOKUMEN</a> --}}
                  </td>
                </tr>
                @endforeach
              </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      
      <!-- /.card -->
    </div>
</div>

<div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form method="post" action="/kepangkatan/pangkat/ditolak" enctype="multipart/form-data">
            @csrf
        <div class="modal-header bg-gradient-danger" style="padding:10px">
            <h4 class="modal-title text-sm">Isi Alasan / Keterangan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>

        <div class="modal-body">
            <textarea name="keterangan_tolak" class="form-control"></textarea>
            <input type="hidden" id="pangkat_id" name="pangkat_id">
        </div>
        
        <div class="modal-footer justify-content-between">
            <button type="submit" class="btn btn-block btn-danger"><i class="fas fa-paper-plane"></i> Kirim</button>
        </div>
        </form>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
$(document).on('click', '.kembalikan', function() {
   $('#pangkat_id').val($(this).data('id'));
   $("#modal-default").modal();
});
</script>
@endpush