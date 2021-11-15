@extends('layouts.app')

@push('css')
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endpush
@section('title')
    DATA PMK
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <a href="/admin/pmk/create" class="btn btn-sm bg-gradient-purple"><i class="fas fa-plus"></i> Ajukan PMK</a>
        <br/><br/>
        <div class="card">
        <div class="card-header bg-gradient-secondary">
            <h3 class="card-title">Data PMK </h3>
            <div class="card-tools">
                <form method="get" action="/admin/pmk/search">
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
        {{-- <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap table-sm">
            <thead>
                <tr>
                <th>#</th>
                <th>NIP/Nama/Jabatan</th>
                <th>File Persyaratan</th>
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
                </tr>
            @endforeach
            </tbody>
            </table>
        </div> --}}
        <!-- /.card-body -->
        </div>
        {{-- {{$data->links()}} --}}
    </div>
</div>

@endsection

@push('js')
@endpush