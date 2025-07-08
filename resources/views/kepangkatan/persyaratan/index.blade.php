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
        <div class="card card-outline card-secondary">
            <div class="card-header">
                <h3 class="card-title">DATA PERSAYARATAN KENAIKAN PANGKAT</h3>
                <div class="card-tools">
                    <button class="btn btn-xs btn-outline-primary tambah-syarat">
                        <i class="fas fa-plus"></i> Jenis Kenaikan Pangkat</button>

                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered table-sm ">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Urut</th>
                            <th>Nama Persyaratan</th>
                            <th>Jenis Persyaratan</th>
                            <th>Jenis Kenaikan Pangkat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                        <tr>
                            <td>{{$data->firstItem() + $key}}</td>
                            <td>{{$item->no_urut}}</td>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->wajib}}</td>
                            <td>{{$item->nama_jenis}}</td>


                            <td>
                                <button class="btn btn-xs btn-outline-primary edit-syarat" data-id="{{$item->id}}"
                                    data-nama="{{$item->nama}}" data-no_urut="{{$item->no_urut}}"
                                    data-jenis_id="{{$item->layanan_id}}">
                                    <i class="fas fa-edit"></i></button>
                                <a href="/kepangkatan/persyaratan/delete/{{$item->id}}"
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
        {{-- {{$data->links()}} --}}
        <!-- /.card -->
    </div>

</div>

<div class="modal fade" id="modal-tambah" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="/kepangkatan/persyaratan/create" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-gradient-primary" style="padding:10px">
                    <h4 class="modal-title text-sm">TAMBAH DATA SYARAT KENAIKAN</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nomor Urut</label>
                        <input type="text" class="form-control" name="no_urut" placeholder="no urut"
                            onkeypress="return hanyaAngka(event)">
                    </div>
                    <div class="form-group">
                        <label>Nama Persyaratan</label>
                        <input type="text" class="form-control" name="nama" placeholder="Nama Syarat">
                    </div>
                    <div class="form-group">
                        <label>Jenis Kenaikan Pangkat</label>

                        <select class="form-control" name="layanan_id">
                            @foreach (layanan('kepangkatan') as $item)
                            <option value="{{$item->id}}">{{$item->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>jenis persyaratan</label>
                        <select class="form-control" name="wajib">

                            <option value=""></option>
                            <option value="optional">optional</option>
                        </select>
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
            <form method="post" action="/kepangkatan/persyaratan/edit" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-gradient-primary" style="padding:10px">
                    <h4 class="modal-title text-sm">EDIT DATA JENIS KENAIKAN PANGKAT</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>Nomor Urut</label>
                        <input type="text" class="form-control" id="no_urut" name="no_urut" placeholder="no urut"
                            onkeypress="return hanyaAngka(event)">
                    </div>
                    <div class="form-group">
                        <label>Nama Persyaratan </label>
                        <input type="text" class="form-control" id="nama_syarat" name="nama">
                        <input type="hidden" class="form-control" id="syarat_id" name="syarat_id">
                    </div>
                    <div class="form-group">
                        <label>Jenis Kenaikan Pangkat</label>

                        <select class="form-control" name="layanan_id" id="jenis_kenaikan_pangkat">
                            @foreach (layanan('kepangkatan') as $item)
                            <option value="{{$item->id}}">{{$item->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>jenis persyaratan</label>
                        <select class="form-control" name="wajib" id="wajib">

                            <option value=""></option>
                            <option value="optional">optional</option>
                        </select>
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
    $(document).on('click', '.tambah-syarat', function() {
   $("#modal-tambah").modal();
});
</script>
<script>
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
      return true;
    }
</script>

<script>
    $(document).on('click', '.edit-syarat', function() {
    console.log($(this).data('nama_jenis'));
   $('#syarat_id').val($(this).data('id'));
   $('#no_urut').val($(this).data('no_urut'));
   $('#nama_syarat').val($(this).data('nama'));
   $('#jenis_kenaikan_pangkat').val($(this).data('jenis_id'));
   $("#modal-edit").modal();
});
</script>

@endpush