@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endpush
@section('title')
BERANDA
@endsection
@section('content')
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="card">
      <div class="card-header bg-gradient-secondary">
        <h3 class="card-title">Layanan BKD</h3>
      </div>
      <div class="card-body table-responsive p-2">

        <form method="post" action="/pegawai/home/ajukan-layanan">
          @csrf
          <select class="form-control" name="layanan_id">
            @foreach ($layanan as $item)
            <option value="{{$item->id}}">{{$item->nama}}</option>
            @endforeach
          </select>
          <br />
          <button type="submit" class="btn btn-sm btn-block btn-outline-primary"><i class="fa fa-paper-plane"></i>
            Ajukan</button>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-12 col-md-6">
    <div class="card">
      <div class="card-header bg-gradient-secondary">
        <h3 class="card-title">Riwayat Pengajuan Anda</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover table-sm table-striped">
          <thead>
            <th>No</th>
            <th>NIP/Nama</th>
            <th>Layanan</th>
            <th>Tanggal Di Buat</th>
            <th>Status</th>
            <th>Diproses Oleh</th>
            <th></th>
          </thead>
          @php
          $no=1;
          @endphp
          <tbody>
            @foreach ($pengajuan as $item)
            <tr style="font-size:12px">
              <td>{{$no++}}</td>
              <td>{{$item->pegawai->nip}} <br />{{$item->pegawai->nama}}</td>
              <td>{{$item->layanan->nama}}</td>
              <td>{{\Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i')}}</td>
              <td>
                @if ($item->status == 0)
                <span class="badge badge-primary"> HARAP UPLOAD DOKUMEN</span>
                @endif
                @if ($item->status == 1 && $item->verifikator == null)
                <span class="badge badge-primary"> DIKIRIM</span>
                @endif
                @if ($item->status == 1 && $item->verifikator != null)
                <span class="badge badge-warning"> DIPROSES</span>
                @endif
                @if ($item->status == 2)
                <span class="badge badge-success"> SELESAI</span>
                @endif
              </td>
              <td>{{$item->nama_verifikator == null ? null : $item->nama_verifikator->name}}</td>
              <td> <a href="/pegawai/home/{{$item->id}}/dokumen" class="btn btn-sm btn-outline-primary"> Persyaratan
                  Dokumen</a>
                @if ($item->status != 2)
                <a href="/pegawai/home/{{$item->id}}/delete" class="btn btn-sm btn-outline-danger"
                  onclick="return confirm('Yakin Di Hapus?');"> <i class="fas fa-trash-alt"></i></a>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>

  {{-- @include('pegawai.layanan.menu') --}}
</div>
@endsection

@push('js')

@endpush