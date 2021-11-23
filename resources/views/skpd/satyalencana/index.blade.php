@extends('layouts.app')

@push('css')
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endpush
@section('title')
    DATA SATYA LENCANA
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <a href="/admin/satyalencana/create" class="btn btn-sm bg-gradient-purple"><i class="fas fa-plus"></i> Ajukan Satya Lencana</a>
        <br/><br/>
        <div class="card">
        <div class="card-header bg-gradient-secondary">
            <h3 class="card-title">Data Satya Lencana : {{$data->total()}}</h3>
            <div class="card-tools">
                <form method="get" action="/admin/satyalencana/search">
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
                    <td>{{$item->pegawai->nip}} <br/>{{$item->pegawai->nama}}<br/>{{$item->pegawai->nm_pangkat}} <br/>
                    
                        @if ($item->status == 2)
                        <strong>
                            <span class="text-danger">Status : Dikembalikan <br/>
                            {{$item->keterangan}}
                            </span>
                        </strong>
                        @endif
                    </td>
                    <td>
                    <strong>
                      @if ($item->sk_cpns == null)
                      SK CPNS
                      @else
                      <a href="/storage/{{$item->pegawai->nip}}/satyalencana/{{$item->id}}/{{$item->sk_cpns}}" class="text-primary" target="_blank">SK CPNS</a>
                      @endif
                      <br/>
                      @if ($item->sk_pns == null)
                      SK PNS
                      @else
                      <a href="/storage/{{$item->pegawai->nip}}/satyalencana/{{$item->id}}/{{$item->sk_pns}}" class="text-primary" target="_blank">SK PNS</a>
                      @endif
                      
                      <br/>
                      @if ($item->sk_jabatan == null)
                      SK JABATAN
                      @else
                      <a href="/storage/{{$item->pegawai->nip}}/satyalencana/{{$item->id}}/{{$item->sk_jabatan}}" class="text-primary" target="_blank">SK JABATAN</a>
                      @endif
                      
                      <br/>
                      @if ($item->skp1thn == null)
                      SKP 1 TAHUN
                      @else
                      <a href="/storage/{{$item->pegawai->nip}}/satyalencana/{{$item->id}}/{{$item->skp1thn}}" class="text-primary" target="_blank">SKP 1 TAHUN</a>
                      @endif
                    </strong>
                    </td>
                    <td>{{\Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i')}}</td>
                    <td>
                      @if ($item->validasi_skpd == null)
                      <a href="/admin/satyalencana/{{$item->id}}/upload" class="btn btn-xs btn-outline-primary"> <i class="fas fa-upload"></i> Upload Dokumen</a>
                      <a href="/admin/satyalencana/{{$item->id}}/kirim" class="btn btn-xs btn-outline-danger" onclick="return confirm('Yakin Sudah Selesai Semua?')"> <i class="fas fa-paper-plane"></i> Validasi & Kirim Ke BKD</a>
                          
                      @else
                            @if ($item->status == 1)
                                <span class="text-success text-bold">SELESAI</span>
                            @else
                                <span class="text-primary text-bold">Di Proses</span>
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