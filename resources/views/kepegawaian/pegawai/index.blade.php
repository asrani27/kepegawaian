@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

@endpush
@section('title')
Beranda
@endsection
@section('content')

<div class="row">

    <div class="col-12">
        <a href="/kepegawaian/kelola/pegawai/add" class="btn btn btn-outline-primary">
            <i class="fas fa-plus"></i> PEGAWAI</a>
        <a href="#" class="btn btn btn-outline-primary import-pegawai">
            <i class="fas fa-upload"></i> IMPORT DATA</a>
        <br /><br />
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">DATA PEGAWAI</h3>
                <div class="card-tools">
                    <form method="GET" action="/kepegawaian/kelola/pegawai/search">
                        <div class="input-group input-group-sm" style="width: 300px;">
                            <input type="text" name="search" class="form-control float-right" placeholder="Nama/NIP"
                                value="{{old('search')}}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>SKPD</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                        <tr>
                            <td>{{$data->firstItem() + $key}}</td>
                            <td>{{$item->nip}}</td>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->ket_jabatan}}</td>
                            <td>{{$item->skpd}}</td>

                            <td>
                                <a href="/kepegawaian/kelola/pegawai/{{$item->id}}/edit"
                                    class="btn btn-xs btn-outline-primary">
                                    <i class="fas fa-edit"></i></a>
                                <a href="/kepegawaian/kelola/pegawai/{{$item->id}}/delete"
                                    onclick="return confirm('Yakin ingin di Hapus');"
                                    class="btn btn-xs kembalikan btn-outline-danger"> <i class="fas fa-trash"></i> </a>
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

</div>
<div class="modal fade" id="modal-import" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="/kepegawaian/kelola/pegawai/import" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-gradient-primary" style="padding:10px">
                    <h4 class="modal-title text-sm">IMPORT DATA PEGAWAI</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>FILE</label>
                        <input type="file" class="form-control" name="file">
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="submit" class="btn btn-block btn-primary"><i class="fas fa-paper-plane"></i>
                        KIRIM</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')

<script>
    $(document).on('click', '.import-pegawai', function() {
   $("#modal-import").modal();
});
</script>

@endpush