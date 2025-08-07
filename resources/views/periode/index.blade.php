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
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">DATA PERIDOE</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-xs btn-outline-primary tambah-agama">
                        <i class="fas fa-plus"></i> Periode</button>

                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered table-sm ">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Periode</th>
                            <th>Mulai</th>
                            <th>Sampai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                        <tr>
                            <td>{{$data->firstItem() + $key}}</td>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->mulai}}</td>
                            <td>{{$item->sampai}}</td>

                            <td>
                                <button type="button" class="btn btn-xs btn-outline-primary edit-periode"
                                    data-id="{{$item->id}}" data-nama="{{$item->nama}}" data-mulai="{{$item->mulai}}"
                                    data-sampai="{{$item->sampai}}">
                                    <i class="fas fa-edit"></i></button>
                                <a href="/periode/delete/{{$item->id}}"
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

<div class="modal fade" id="modal-tambah" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="/periode" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-gradient-primary" style="padding:10px">
                    <h4 class="modal-title text-sm">TAMBAH DATA PERIODE</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Periode</label>
                        <input type="text" class="form-control" name="nama" placeholder="Nama Periode">
                    </div>
                    <div class="form-group">
                        <label>Mulai</label>
                        <input type="datetime-local" class="form-control" name="mulai" placeholder="Mulai">
                    </div>
                    <div class="form-group">
                        <label>Sampai</label>
                        <input type="datetime-local" class="form-control" name="sampai" placeholder="Sampai">
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="submit" class="btn btn-block btn-primary"><i class="fas fa-paper-plane"></i>
                        Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="/periode/edit" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-gradient-primary" style="padding:10px">
                    <h4 class="modal-title text-sm">EDIT DATA PERIODE</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Periode</label>
                        <input type="text" class="form-control" id="nama_periode" name="nama">
                        <input type="hidden" class="form-control" id="periode_id" name="periode_id">
                    </div>

                    <div class="form-group">
                        <label>Mulai</label>
                        <input type="datetime-local" class="form-control" name="mulai" id="mulai" placeholder="Mulai">
                    </div>

                    <div class="form-group">
                        <label>Sampai</label>
                        <input type="datetime-local" class="form-control" name="sampai" id="sampai"
                            placeholder="sampai">
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="submit" class="btn btn-block btn-primary"><i class="fas fa-paper-plane"></i>
                        Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).on('click', '.tambah-agama', function() {
   $("#modal-tambah").modal();
});
</script>


<script>
    $(document).on('click', '.edit-periode', function() {
   $('#periode_id').val($(this).data('id'));
   $('#nama_periode').val($(this).data('nama'));
   $('#mulai').val($(this).data('mulai'));
   $('#sampai').val($(this).data('sampai'));
   $("#modal-edit").modal();
});
</script>

@endpush