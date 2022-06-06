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
        <a href="/disiplin/jenis/add" class="btn btn btn-outline-primary">
            <i class="fas fa-plus"></i> JENIS</a>
        <br /><br />
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">DATA JENIS</h3>
                <div class="card-tools">
                    <form method="GET" action="/kepegawaian/kelola/jenis/search">
                        <div class="input-group input-group-sm" style="width: 300px;">
                            <input type="text" name="search" class="form-control float-right" value="{{old('search')}}">
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
                            <th>Nama Jenis</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                        <tr>
                            <td>{{$data->firstItem() + $key}}</td>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->kategori->nama}}</td>

                            <td>
                                <a href="/disiplin/jenis/{{$item->id}}/edit" class="btn btn-xs btn-outline-primary">
                                    <i class="fas fa-edit"></i></a>
                                <a href="/disiplin/jenis/{{$item->id}}/delete"
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

@endsection

@push('js')

@endpush