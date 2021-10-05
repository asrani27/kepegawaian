@extends('layouts.app')

@push('css')
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endpush
@section('title')
    UPLOAD FILE
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header bg-gradient-secondary">
          <h3 class="card-title">Daftar File Upload</h3>
        </div>
        <!-- /.card-header -->
        @csrf
        <div class="card-body">
            <table class="table table-bordered">
                <thead>                  
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Jenis</th>
                    <th>File</th>
                    <th style="width: 40px">Aksi</th>
                  </tr>
                </thead>
                @php
                    $no =1;
                @endphp
                <tbody>
                    @foreach ($upload as $item)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$item->nama}}</td>
                        <td>
                          <ul>
                            @foreach ($item->datafile as $file)
                                <li>{{$file->nama}}<a href="/pegawai/upload/{{$file->id}}/delete" onclick="return confirm('Yakin Di Hapus?');"> <b><span class="text-danger">X</span></b></a>
                                  <a href="/storage/{{$file->pegawai->nip}}/{{$file->file}}" target="_blank"><i class="fas fa-eye"></i></a></li>
                            @endforeach
                          </ul>
                        </td>
                        <td><button type="button" class="btn btn-sm btn-outline-primary upload-file" data-id="{{$item->id}}"><i class="fas fa-upload"></i></button></td>
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
        <form method="post" action="/pegawai/upload" enctype="multipart/form-data">
            @csrf
        <div class="modal-header bg-gradient-secondary" style="padding:10px">
            <h4 class="modal-title text-sm">Upload File</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>

        <div class="modal-body">
            Isi Nama File<br/>
            <input type="text" name="nama" class="form-control" required>
            <input type="hidden" id="id_syarat" name="persyaratan_id" class="form-control">
            <p></p>
            <input type="file" name="file" class="form-controll" required><br/>Harap Upload file maximal 5MB (Megabyte)
        </div>
        
        <div class="modal-footer justify-content-between">
            <button type="submit" class="btn btn-block btn-primary"><i class="fas fa-file-excel"></i> Upload</button>
        </div>
        </form>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
$(document).on('click', '.upload-file', function() {
    $('#id_syarat').val($(this).data('id'));
    $('#modal-default').modal('show');
});
</script>
@endpush