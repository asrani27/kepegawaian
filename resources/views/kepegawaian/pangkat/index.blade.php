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
                <h3 class="card-title">DATA PANGKAT</h3>
                <div class="card-tools">
                    <a href="#" class="btn btn-xs btn-outline-primary tambah-pangkat">
                        <i class="fas fa-plus"></i> Pangkat</a>

                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered table-sm ">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pangkat</th>
                            <th>Golongan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                        <tr>
                            <td>{{1 + $key}}</td>
                            <td>{{$item->pangkat}}</td>
                            <td>{{$item->golongan}}</td>

                            <td>
                                <a href="#" class="btn btn-xs btn-outline-primary edit-pangkat" data-id="{{$item->id}}"
                                    data-pangkat="{{$item->pangkat}}" data-golongan="{{$item->golongan}}">
                                    <i class="fas fa-edit"></i></a>
                                <a href="/kepegawaian/data/pangkat/{{$item->id}}/delete"
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
        <!-- /.card -->
    </div>

</div>

<div class="modal fade" id="modal-tambah" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="/kepegawaian/data/pangkat" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-gradient-primary" style="padding:10px">
                    <h4 class="modal-title text-sm">TAMBAH DATA PANGKAT</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>Pangkat</label>
                        <input type="text" class="form-control" name="pangkat" placeholder="Pangkat">
                    </div>
                    <div class="form-group">
                        <label>Golongan</label>
                        <input type="text" class="form-control" name="golongan" placeholder="Golongan">
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="submit" class="btn btn-block btn-primary"><i class="fas fa-paper-plane"></i>
                        Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="/kepegawaian/data/pangkat/edit" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-gradient-primary" style="padding:10px">
                    <h4 class="modal-title text-sm">EDIT DATA PANGKAT</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>Pangkat</label>
                        <input type="text" class="form-control" id="nama_pangkat" name="pangkat">

                        <input type="hidden" class="form-control" id="pangkat_id" name="pangkat_id">
                    </div>
                    <div class="form-group">
                        <label>Golongan</label>
                        <input type="text" class="form-control" id="nama_golongan" name="golongan">
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
    $(document).on('click', '.tambah-pangkat', function() {
   $("#modal-tambah").modal();
});
</script>


<script>
    $(document).on('click', '.edit-pangkat', function() {
   $('#pangkat_id').val($(this).data('id'));
   $('#nama_pangkat').val($(this).data('pangkat'));
   $('#nama_golongan').val($(this).data('golongan'));
   $("#modal-edit").modal();
});
</script>

@endpush