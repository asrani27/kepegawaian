@extends('layouts.app')

@push('css')
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endpush
@section('title')
    DATA LAYANAN
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <a href="/superadmin/layanan/create" class="btn btn-sm bg-gradient-purple"><i class="fas fa-plus"></i> Tambah</a>
        <br/><br/>
        <div class="card">
        <div class="card-header bg-gradient-secondary">
            <h3 class="card-title">Data Layanan</h3>
            <div class="card-tools">
                <form method="get" action="/superadmin/layanan/search">
                <div class="input-group input-group-sm" style="width: 250px;">
                    <input type="text" name="search" class="form-control float-right" value="{{old('search')}}">

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
                <th>Nama layanan</th>
                <th>Persyaratan</th>
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
                    <td>{{$item->nama}}</td>
                    <td>
                        <ul>
                        @foreach ($item->persyaratan as $item2)
                            <li>{{$item2->nama}}</li>
                        @endforeach   
                        </ul> 
                    </td>
                    <td>
                        
                    <form action="/superadmin/layanan/{{$item->id}}" method="post">
                        @csrf
                        @method('delete')
                        <a href="/superadmin/layanan/{{$item->id}}/edit" class="btn btn-xs bg-gradient-success"><i class="fas fa-edit"></i></a>
                        <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Yakin Di Hapus?');"><i class="fas fa-trash"></i></button>
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

@endsection

@push('js')
@endpush