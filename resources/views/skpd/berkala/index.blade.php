@extends('layouts.app')

@push('css')
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endpush
@section('title')
    DATA BERKALA
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <a href="/admin/berkala/create" class="btn btn-sm bg-gradient-purple"><i class="fas fa-plus"></i> Ajukan Berkala</a>
        <br/><br/>
        <div class="card">
        <div class="card-header bg-gradient-secondary">
            <h3 class="card-title">Data Berkala : {{$data->total()}}</h3>
            <div class="card-tools">
                <form method="get" action="/admin/berkala/search">
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
                <th>NIP/Nama/Jabatan</th>
                <th>File Persyaratan</th>
                <th>Tanggal Di Buat</th>
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
                    <td>{{$item->nip}} <br/>{{$item->nama}}<br/>{{$item->pangkat}} <br/>
                    
                        @if ($item->status_tolak == 1)
                        <strong>
                            <span class="text-danger">Status : Dikembalikan <br/>
                            {{$item->keterangan_tolak}}
                            </span>
                        </strong>
                        @endif
                    </td>
                    <td>
                    <strong>
                      @if ($item->sk_cpns == null)
                      SK CPNS
                      @else
                      <a href="/storage/{{$item->nip}}/berkala/{{$item->id}}/{{$item->sk_cpns}}" class="text-primary" target="_blank">SK CPNS</a>
                      @endif
                      <br/>
                      @if ($item->sk_pns == null)
                      SK PNS
                      @else
                      <a href="/storage/{{$item->nip}}/berkala/{{$item->id}}/{{$item->sk_pns}}" class="text-primary" target="_blank">SK PNS</a>
                      @endif
                      
                      <br/>
                      @if ($item->sk_pangkat == null)
                      SK PANGKAT
                      @else
                      <a href="/storage/{{$item->nip}}/berkala/{{$item->id}}/{{$item->sk_pangkat}}" class="text-primary" target="_blank">SK PANGKAT</a>
                      @endif
                      
                      <br/>
                      @if ($item->sk_berkala == null)
                      SK BERKALA
                      @else
                      <a href="/storage/{{$item->nip}}/berkala/{{$item->id}}/{{$item->sk_berkala}}" class="text-primary" target="_blank">SK BERKALA</a>
                      @endif
                    </strong>
                    </td>
                    <td>{{\Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i')}}</td>
                    <td>
                      @if ($item->validasi_skpd == null)
                      <a href="/admin/berkala/{{$item->id}}/upload" class="btn btn-xs btn-outline-primary"> <i class="fas fa-upload"></i> Upload Dokumen</a>
                      <a href="/admin/berkala/{{$item->id}}/kirim" class="btn btn-xs btn-outline-danger" onclick="return confirm('Yakin Sudah Selesai Semua?')"> <i class="fas fa-paper-plane"></i> Validasi & Kirim Ke BKD</a>
                          
                      @else
                            @if ($item->sk_ttd == null)
                                <span class="text-primary text-bold">Menunggu Di Proses BKD</span>
                            @else
                                <span class="text-success text-bold">SK SELESAI, Silahkan ambil ke BKD</span>
                            @endif
                      @endif
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