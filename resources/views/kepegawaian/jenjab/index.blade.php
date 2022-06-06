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
        <a href="/kepegawaian/kelola/jenjab/add" class="btn btn btn-outline-primary">
            <i class="fas fa-plus"></i> JENJAB</a>
        <br /><br />
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">DATA JENJAB</h3>
                <div class="card-tools">
                    <form method="GET" action="/kepegawaian/kelola/jenjab/search">
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
                            <th>Nama Keljab</th>
                            <th>Nama Jenjab</th>
                            <th>Min Pangkat</th>
                            <th>Max Pangkat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                        <tr>
                            <td>{{$data->firstItem() + $key}}</td>
                            <td>{{$item->nama_keljab}}</td>
                            <td>{{$item->nama_jenjab}}</td>
                            <td>{{$item->minpangkat->pangkat}}</td>
                            <td>{{$item->maxpangkat->pangkat}}</td>

                            <td>
                                <a href="/kepegawaian/kelola/jenjab/{{$item->id}}/edit"
                                    class="btn btn-xs btn-outline-primary">
                                    <i class="fas fa-edit"></i></a>
                                <a href="/kepegawaian/kelola/jenjab/{{$item->id}}/delete"
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