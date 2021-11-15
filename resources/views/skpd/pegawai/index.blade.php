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
        <a href="/admin/pegawai/sync" class="btn btn-sm bg-gradient-purple"><i class="fas fa-sync"></i> Sinkronisasi Pegawai</a>
        <a href="/admin/pegawai/sync/unitkerja" class="btn btn-sm bg-gradient-purple"><i class="fas fa-sync"></i> Sinkronisasi UnitKerja</a>
        <a href="/admin/pegawai/account" class="btn btn-sm bg-gradient-info" data-toggle="tooltip" title="Create Account"><i class="fas fa-key"></i></a>
        <br/><br/>
        <div class="card">
        <div class="card-header bg-gradient-secondary">
            <h3 class="card-title">Data Pegawai : {{$data->total()}}</h3>
            <div class="card-tools">
                <form method="get" action="/admin/pegawai/search">
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
                        
                    <form action="/admin/pegawai/{{$item->id}}" method="post">
                        <a href="/admin/pegawai/{{$item->id}}/detail" class="btn btn-xs bg-gradient-success"><i class="fas fa-eye"></i></a>
                        @if ($item->user == null)
                            <a href="/admin/pegawai/{{$item->id}}/akun" class="btn btn-xs bg-gradient-info"><i class="fas fa-lock"></i></a>
                        @else
                            <a href="/admin/pegawai/{{$item->id}}/reset" class="btn btn-xs bg-gradient-warning"><i class="fas fa-key"></i></a>
                        @endif
                    </form>

                </td>
                </tr>
            @endforeach
            </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        </div>
        {{$data->links()}}
    </div>
</div>

@endsection

@push('js')
@endpush