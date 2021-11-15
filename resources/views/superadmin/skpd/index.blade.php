@extends('layouts.app')

@push('css')
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endpush
@section('title')
    DATA SKPD
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        
        <div class="card">
        <div class="card-header bg-gradient-secondary">
            <h3 class="card-title">Data Skpd</h3>
            <div class="card-tools">
                <form method="get" action="/superadmin/skpd/search">
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
                <th>Kode SKPD</th>
                <th>Nama SKPD</th>
                <th>Aksi</th>
                </tr>
            </thead>
            @php
                $no =1;
            @endphp
            <tbody>
            @foreach ($data as $key => $item)
                    <tr style="font-size:11px; font-family:Arial, Helvetica, sans-serif">
                    <td>{{$no + $key}}</td>
                    <td>{{$item->kode_skpd}}</td>
                    <td>{{$item->nama}}</td>
                    <td>
                        @if ($item->user == null)
                        <a href="/superadmin/skpd/{{$item->id}}/akun" class="btn btn-xs bg-gradient-success"><i class="fas fa-key"></i> Buat Akun</a>
                            
                        @else
                        <a href="/superadmin/skpd/{{$item->id}}/reset" class="btn btn-xs bg-gradient-info"><i class="fas fa-sync"></i> Reset Password</a>
                            
                        @endif
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

@endsection

@push('js')
@endpush