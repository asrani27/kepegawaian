@extends('layouts.app')

@push('css')
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endpush
@section('title')
    DATA PEGAWAI
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <a href="/superadmin/pegawai/create" class="btn btn-sm bg-gradient-purple"><i class="fas fa-plus"></i> Tambah Pegawai</a>
        <a href="/superadmin/pegawai/import" class="btn btn-sm bg-gradient-purple" data-toggle="modal" data-target="#modal-default"><i class="fas fa-upload"></i> Import Pegawai</a>
        <a href="/theme/format.xlsx" class="btn btn-sm bg-gradient-info" data-toggle="tooltip" title="Format Excel"><i class="fas fa-file-excel"></i></a>
        <a href="/superadmin/pegawai" class="btn btn-sm bg-gradient-warning" data-toggle="tooltip" title="Refresh Data"><i class="fas fa-sync"></i></a>
        <a href="/superadmin/pegawai/account" class="btn btn-sm bg-gradient-info" data-toggle="tooltip" title="Create Account"><i class="fas fa-key"></i></a>
        <br/><br/>
        <div class="card">
        <div class="card-header bg-gradient-secondary">
            <h3 class="card-title">Data Pegawai ({{$data->total()}})</h3>
            <div class="card-tools">
                <form method="get" action="/superadmin/pegawai/search">
                <div class="input-group input-group-sm" style="width: 250px;">
                    <input type="text" name="search" class="form-control float-right" value="{{old('search')}}" placeholder="Nama / NIK">

                    <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap table-sm">
            <thead>
                <tr>
                <th>#</th>
                <th>Foto</th>
                <th>NIP/Nama</th>
                <th>TTL</th>
                <th>Unit Kerja</th>
                <th>Aksi</th>
                </tr>
            </thead>
            @php
                $no =1;
            @endphp
            <tbody>
            @foreach ($data as $key => $item)
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                    <td>{{$data->firstItem() + $key}}</td>
                    <td>
                        @if ($item->foto == null)
                        <img class="img-circle img-bordered-sm" src="/theme/dist/img/default-150x150.png" alt="user image" width="60px">
                        @else
                        <img class="img-circle img-bordered-sm" src="/storage/{{$item->nip}}/{{$item->foto}}" alt="user image" width="60px">
                        @endif
                    </td>
                    <td>{{$item->nip}}<br/>{{$item->nama}}</td>
                    <td>{{$item->tempat_lahir}}, {{$item->tanggal_lahir}}</td>
                    <td>{{$item->unit_kerja}}</td>
                    <td>
                        
                    <form action="/superadmin/pegawai/{{$item->id}}" method="post">
                        <a href="/superadmin/pegawai/{{$item->id}}/detail" class="btn btn-xs bg-gradient-success"><i class="fas fa-eye"></i></a>
                        @if ($item->user == null)
                            <a href="/superadmin/pegawai/{{$item->id}}/akun" class="btn btn-xs bg-gradient-info"><i class="fas fa-lock"></i></a>
                        @else
                            <a href="/superadmin/pegawai/{{$item->id}}/reset" class="btn btn-xs bg-gradient-warning"><i class="fas fa-key"></i></a>
                        @endif
                        {{-- @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('yakin DI Hapus?');"><i class="fas fa-trash"></i> Delete</button>
                        
                        @if ($item->user == null)

                        <a href="/superadmin/pegawai/{{$item->id}}/akun" class="btn btn-xs btn-warning"><i class="fas fa-key"></i> Buat Akun</a>  
                        @else
                        <a href="/superadmin/pegawai/{{$item->id}}/pass" class="btn btn-xs btn-secondary"><i class="fas fa-key"></i> Reset Pass</a>  
                        @endif    --}}
                    </form>

                    </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        </div>
        {{$data->onEachSide(0)->links()}}
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
        <div class="card-header bg-gradient-secondary">
            <h3 class="card-title">Data File Import</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap table-sm">
            <thead>
                <tr>
                <th>#</th>
                <th>File</th>
                <th>Aksi</th>
                </tr>
            </thead>
            @php
                $no =1;
            @endphp
            <tbody>
            @foreach ($import as $key => $item)
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                    <td>{{$no++}}</td>
                    <td>{{$item->file}}</td>
                    <td>                            
                        <a href="/superadmin/pegawai/import/{{$item->id}}/delete"  onclick="return confirm('Yakin Ingin Di Hapus?');" class="btn btn-xs bg-gradient-danger"><i class="fas fa-trash"></i></a>
                        <a href="/superadmin/pegawai/import/{{$item->id}}/sync" class="btn btn-xs bg-gradient-success text-sm"><i class="fas fa-sync"></i> Sinkron Server BKD</a>
                    </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        </div>
    </div>
</div>

<div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form method="post" action="/superadmin/pegawai/import" enctype="multipart/form-data">
            @csrf
        <div class="modal-header bg-gradient-secondary" style="padding:10px">
            <h4 class="modal-title text-sm">Import File</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>

        <div class="modal-body">
            <p>Harap Upload file excel sesuai dengan format yang telah ditentukan</p>
            <input type="file" name="file" required>
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
@endpush