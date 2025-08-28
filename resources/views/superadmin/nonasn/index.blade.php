@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endpush
@section('title')
DATA PEGAWAI NON ASN
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <a href="/superadmin/nonasn/create" class="btn btn-sm bg-gradient-purple"><i class="fas fa-plus"></i> Tambah
            Pegawai Non ASN</a>

        <br /><br />
        <div class="card">
            <div class="card-header bg-gradient-secondary">
                <h3 class="card-title">Data Pegawai NON ASN ({{$data->total()}})</h3>
                <div class="card-tools">
                    <form method="get" action="/superadmin/nonasn/search">
                        <div class="input-group input-group-sm" style="width: 250px;">
                            <input type="text" name="search" class="form-control float-right" value="{{old('search')}}"
                                placeholder="Nama / NIK">

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
                            <th>NIK/Nama</th>
                            <th>TTL</th>
                            <th>SKPD</th>
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
                                <img class="img-circle img-bordered-sm" src="/theme/dist/img/default-150x150.png"
                                    alt="user image" width="60px">
                                @else
                                <img class="img-circle img-bordered-sm" src="/storage/{{$item->nip}}/{{$item->foto}}"
                                    alt="user image" width="60px">
                                @endif
                            </td>
                            <td>{{$item->nik}}<br />{{$item->nama}}</td>
                            <td>{{$item->tempat_lahir}}, {{$item->tanggal_lahir}}</td>
                            <td>{{$item->skpd}}</td>
                            <td>

                                <form action="/superadmin/nonasn/{{$item->id}}" method="post">
                                    <a href="/superadmin/nonasn/{{$item->id}}/detail"
                                        class="btn btn-xs bg-gradient-success"><i class="fas fa-eye"></i></a>
                                    @if ($item->user == null)
                                    <a href="/superadmin/nonasn/{{$item->id}}/akun"
                                        class="btn btn-xs bg-gradient-info"><i class="fas fa-lock"></i></a>
                                    @else
                                    <a href="/superadmin/nonasn/{{$item->id}}/reset"
                                        class="btn btn-xs bg-gradient-warning"><i class="fas fa-key"></i></a>
                                    @endif
                                    {{-- @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-xs btn-danger"
                                        onclick="return confirm('yakin DI Hapus?');"><i class="fas fa-trash"></i>
                                        Delete</button>

                                    @if ($item->user == null)

                                    <a href="/superadmin/pegawai/{{$item->id}}/akun" class="btn btn-xs btn-warning"><i
                                            class="fas fa-key"></i> Buat Akun</a>
                                    @else
                                    <a href="/superadmin/pegawai/{{$item->id}}/pass" class="btn btn-xs btn-secondary"><i
                                            class="fas fa-key"></i> Reset Pass</a>
                                    @endif --}}
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