@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

@endpush
@section('title')
DATA SATYA LENCANA
@endsection
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header bg-gradient-secondary">
          <h3 class="card-title">Daftar Pengajuan Satya Lencana</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover table-sm table-striped">
              <thead>
                  <th>No</th>
                  <th>NIP/Nama/Jabatan</th>
                  <th>File Persyaratan</th>
                  <th>Tanggal Di Buat</th>
                  <th>SKPD</th>
                  <th>Aksi</th>
              </thead>
              <tbody>
                @foreach ($data as $key => $item) 
                <tr style="font-size:10px; font-family:Arial, Helvetica, sans-serif">
                  <td>{{$data->firstItem() + $key}}</td>
                  <td>{{$item->pegawai->nip}} <br/>{{$item->pegawai->nama}}<br/>{{$item->pegawai->nm_pangkat}}</td>
                  <td>
                    
                    <strong>
                      @if ($item->sk_cpns == null)
                      SK CPNS
                      @else
                      <a href="/storage/{{$item->pegawai->nip}}/satyalencana/{{$item->id}}/{{$item->sk_cpns}}" class="text-primary" target="_blank">SK CPNS</a>
                      @endif
                      <br/>
                      @if ($item->sk_pns == null)
                      SK PNS
                      @else
                      <a href="/storage/{{$item->pegawai->nip}}/satyalencana/{{$item->id}}/{{$item->sk_pns}}" class="text-primary" target="_blank">SK PNS</a>
                      @endif
                      
                      <br/>
                      @if ($item->sk_jabatan == null)
                      SK JABATAN
                      @else
                      <a href="/storage/{{$item->pegawai->nip}}/satyalencana/{{$item->id}}/{{$item->sk_jabatan}}" class="text-primary" target="_blank">SK JABATAN</a>
                      @endif
                      
                      <br/>
                      @if ($item->skp1thn == null)
                      SKP 1 TAHUN
                      @else
                      <a href="/storage/{{$item->pegawai->nip}}/satyalencana/{{$item->id}}/{{$item->skp1thn}}" class="text-primary" target="_blank">SKP 1 TAHUN</a>
                      @endif
                    </strong>
                  </td>
                  <td>{{\Carbon\Carbon::parse($item->updated_at)->format('d-m-Y H:i')}}</td>
                  <td>{{$item->pegawai->skpd}} <br/>
                  Telah Di Validasi Oleh Umpeg
                  </td>
                  <td>

                  </td>
                </tr>
                @endforeach
              </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      {{$data->links()}}
      <!-- /.card -->
    </div>

    
    {{-- <div class="col-12">
      <div class="card">
        <div class="card-header bg-gradient-secondary">
          <h3 class="card-title">Daftar Yang Di Kembalikan</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover table-sm table-striped">
              <thead>
                  <th>No</th>
                  <th>NIP/Nama/Jabatan</th>
                  <th>File Persyaratan</th>
                  <th>Tanggal Di Buat</th>
                  <th>SKPD</th>
                  <th>Keterangan</th>
              </thead>
              <tbody>
                @foreach ($tolak as $key => $item) 
                <tr style="font-size:10px; font-family:Arial, Helvetica, sans-serif">
                  <td>{{$data->firstItem() + $key}}</td>
                  <td>{{$item->pegawai->nip}} <br/>{{$item->pegawai->nama}}<br/>{{$item->pegawai->pangkat}}</td>
                  <td>
                    
                    <strong>
                      @if ($item->sk_cpns == null)
                      SK CPNS
                      @else
                      <a href="/storage/{{$item->pegawai->nip}}/satyalencana/{{$item->id}}/{{$item->sk_cpns}}" class="text-primary" target="_blank">SK CPNS</a>
                      @endif

                      <br/>
                      @if ($item->sk_pns == null)
                      SK PNS
                      @else
                      <a href="/storage/{{$item->pegawai->nip}}/satyalencana/{{$item->id}}/{{$item->sk_pns}}" class="text-primary" target="_blank">SK PNS</a>
                      @endif
                      
                      <br/>
                      @if ($item->sk_jabatan == null)
                      SK JABATAN
                      @else
                      <a href="/storage/{{$item->pegawai->nip}}/satyalencana/{{$item->id}}/{{$item->sk_pangkat}}" class="text-primary" target="_blank">SK PANGKAT</a>
                      @endif
                      
                      <br/>
                      @if ($item->skp1thn == null)
                      SKP 1 TAHUN
                      @else
                      <a href="/storage/{{$item->pegawai->nip}}/satyalencana/{{$item->id}}/{{$item->sk_berkala}}" class="text-primary" target="_blank">SK BERKALA</a>
                      @endif
                    </strong>
                  </td>
                  <td>{{\Carbon\Carbon::parse($item->updated_at)->format('d-m-Y H:i')}}</td>
                  <td>{{$item->pegawai->skpd}} <br/>
                    
                  </td>
                  <td>
                    {{$item->keterangan}}
                  </td>
                </tr>
                @endforeach
              </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      {{$data->links()}}
      <!-- /.card -->
    </div> --}}
</div>

<div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form method="post" action="/pensiun/satyalencana/ditolak" enctype="multipart/form-data">
            @csrf
        <div class="modal-header bg-gradient-danger" style="padding:10px">
            <h4 class="modal-title text-sm">Isi Alasan / Keterangan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>

        <div class="modal-body">
            <textarea name="keterangan_tolak" class="form-control"></textarea>
            <input type="hidden" id="berkala_id" name="berkala_id">
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
   $('#berkala_id').val($(this).data('id'));
   $("#modal-default").modal();
});
</script>


<script>
  $(document).on('click', '.upload', function() {
     $('#berkala_id_upload').val($(this).data('id'));
     $("#modal-upload").modal();
  });
</script>
@endpush