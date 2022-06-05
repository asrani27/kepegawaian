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
                <h3 class="card-title">DATA GENDER</h3>
                <div class="card-tools">
                    <a href="#" class="btn btn-xs btn-outline-primary tambah-gender">
                        <i class="fas fa-plus"></i> Gender</a>

                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered table-sm ">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Gender</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                        <tr>
                            <td>{{$data->firstItem() + $key}}</td>
                            <td>{{$item->nama}}</td>

                            <td>
                                <a href="#" class="btn btn-xs btn-outline-primary edit-gender" data-id="{{$item->id}}"
                                    data-nama="{{$item->nama}}">
                                    <i class="fas fa-edit"></i></a>
                                <a href="/kepegawaian/data/gender/{{$item->id}}/delete"
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
            <form method="post" action="/kepegawaian/data/gender" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-gradient-primary" style="padding:10px">
                    <h4 class="modal-title text-sm">TAMBAH DATA GENDER</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama gender</label>
                        <input type="text" class="form-control" name="nama" placeholder="Nama gender">
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
            <form method="post" action="/kepegawaian/data/gender/edit" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-gradient-primary" style="padding:10px">
                    <h4 class="modal-title text-sm">EDIT DATA GENDER</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Gender</label>
                        <input type="text" class="form-control" id="nama_gender" name="nama">
                        <input type="hidden" class="form-control" id="gender_id" name="gender_id">
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
    $(document).on('click', '.tambah-gender', function() {
   $("#modal-tambah").modal();
});
</script>


<script>
    $(document).on('click', '.edit-gender', function() {
   $('#gender_id').val($(this).data('id'));
   $('#nama_gender').val($(this).data('nama'));
   $("#modal-edit").modal();
});
</script>

@endpush