@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

@endpush
@section('title')
Data KARSU
@endsection
@section('content')

<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header bg-gradient-secondary">
          <h3 class="card-title">Daftar Pengajuan KARSU</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover table-sm table-striped">
              <thead>
                  <th>No</th>
                  <th>NIP/Nama/Jabatan</th>
                  <th>Tanggal Di Buat</th>
                  <th>SKPD</th>
                  <th>Aksi</th>
              </thead>
              <tbody>
                @foreach ($data as $key => $item) 
                <tr style="font-size:10px; font-family:Arial, Helvetica, sans-serif">
                  <td>{{$data->firstItem() + $key}}</td>
                  <td>{{$item->pegawai->nip}} <br/>{{$item->pegawai->nama}}<br/>{{$item->pegawai->nm_pangkat}} / {{$item->pegawai->pol_pangkat}}</td>
                  <td>{{\Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i')}}</td>
                  <td>{{$item->pegawai->skpd}} <br/>
                    Telah Di Validasi Oleh Umpeg
                  </td>
                  <td>
                    @if ($item->status == 3)
                        <span class="text-success text-bold">KARSU SELESAI</span>
                    @else
                    <a href="/karpeg/karsu/{{$item->id}}/dokumen" class="btn btn-xs btn-outline-primary"> <i class="fas fa-file"></i> LIHAT DOKUMEN</a><br/>
                    
                    <a href="#" data-id="{{$item->id}}" class="btn btn-xs kembalikan btn-outline-danger"> <i class="fas fa-hand-paper"></i> BERKAS TIDAK LENGKAP</a><br/>

                    <a href="/karpeg/karsu/{{$item->id}}/selesai" class="btn btn-xs btn-outline-success" onclick="return confirm('KONFIRMASI KARSU SELESAI?')"> <i class="fas fa-check"></i> KARSU SELESAI</a>
                    @endif
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
        <form method="post" action="/karpeg/karsu/ditolak" enctype="multipart/form-data">
            @csrf
        <div class="modal-header bg-gradient-danger" style="padding:10px">
            <h4 class="modal-title text-sm">Isi Alasan / Keterangan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>

        <div class="modal-body">
            <textarea name="keterangan_tolak" class="form-control"></textarea>
            <input type="hidden" id="karsu_id" name="karsu_id">
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
   $('#karsu_id').val($(this).data('id'));
   $("#modal-default").modal();
});
</script>
@endpush