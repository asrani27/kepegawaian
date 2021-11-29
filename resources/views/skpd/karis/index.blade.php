@extends('layouts.app')

@push('css')
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endpush
@section('title')
    DATA KARIS
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <a href="/admin/karis/create" class="btn btn-sm bg-gradient-purple"><i class="fas fa-plus"></i> Ajukan Karis</a>
        <br/><br/>
        <div class="card">
        <div class="card-header bg-gradient-secondary">
            <h3 class="card-title">Data Karis</h3>
            <div class="card-tools">
                <form method="get" action="/admin/karis/search">
                <div class="input-group input-group-sm" style="width: 250px;">
                    <input type="text" name="search" class="form-control float-right" value="{{old('search')}}" placeholder="Nama / NIP">

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
                <th>NIP/Nama/Jabatan</th>
                <th>Tanggal Dibuat</th>
                <th>Status</th>
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
                    <td>{{$item->pegawai->nip}}<br/>{{$item->pegawai->nama}}<br/>{{$item->pegawai->nm_pangkat}}
                    <br/>
                    @if ($item->status == 2)
                    <strong>
                        <span class="text-danger">Status : Dikembalikan <br/>
                        {{$item->keterangan}}
                        </span>
                    </strong>
                    @endif
                    </td>
                    <td>{{\Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i')}}</td>
                    <td>
                        
                        @if ($item->status == null || $item->status == 2)
                            <span class="text-danger"><strong>Menunggu Validasi Umpeg SKPD</strong></span>
                        @else
                            <span class="text-primary"><strong>Proses Di BKD</strong></span>
                        @endif
                    </td>
                    <td>
                        @if ($item->status == null || $item->status == 2)
                            <a href="/admin/karis/{{$item->id}}" class="btn btn-xs btn-outline-primary"> <i class="fas fa-upload"></i> Upload Dokumen</a>
                            <a href="/admin/karis/{{$item->id}}/kirim" class="btn btn-xs btn-outline-danger" onclick="return confirm('Yakin Sudah Selesai Semua?')"> <i class="fas fa-paper-plane"></i> Validasi & Kirim Ke BKD</a>
                            <a href="/admin/karis/{{$item->id}}/delete" class="btn btn-xs btn-outline-danger" onclick="return confirm('Yakin Ingin Dihapus?')"> <i class="fas fa-trash"></i></a>
                        @else
                            
                        @endif    
                    </td>
                </tr>
            @endforeach
            </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        </div>
        {{-- {{$data->links()}} --}}
    </div>
</div>

@endsection

@push('js')
@endpush