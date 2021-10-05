@extends('layouts.app')

@push('css')
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endpush
@section('title')
    DETAIL PEGAWAI
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <tr>
            <td>
              <div class="btn-group">
                <a href="/superadmin/pegawai/{{$id}}/detail" class="btn bg-gradient-{{$page == 'profil' ? 'danger':'info'}}"><i class="fas fa-user"></i> Profil</a>
                <a href="/superadmin/pegawai/{{$id}}/pasangan" class="btn bg-gradient-{{$page == 'pasangan' ? 'danger':'info'}}"><i class="fas fa-list"></i> Pasangan</a>
                <a href="/superadmin/pegawai/{{$id}}/anak" class="btn bg-gradient-{{$page == 'anak' ? 'danger':'info'}}"><i class="fas fa-list"></i> Anak</a>
                <a href="/superadmin/pegawai/{{$id}}/orangtua" class="btn bg-gradient-{{$page == 'orangtua' ? 'danger':'info'}}"><i class="fas fa-list"></i> Orang Tua</a>
                <a href="/superadmin/pegawai/{{$id}}/pendidikan" class="btn bg-gradient-{{$page == 'pendidikan' ? 'danger':'info'}}"><i class="fas fa-list"></i> Pendidikan</a>
              </div>
            </td>
        </tr>
    </div>
</div>
<br/>
<div class="row">

    @include('superadmin.pegawai.detail.'.$page)
    <div class="col-lg-2 col-md-6">
        <div class="card">
            <div class="card-header bg-gradient-secondary">
                <i class="fas fa-book"></i> Kepegawaian
            </div>
            <div class="card-body">
                <a href="#" class="btn btn-block btn-outline-info text-left"><i class="fa fa-calendar-alt"></i> Pensiun</a>
                <a href="#" class="btn btn-block btn-outline-info text-left"><i class="fa fa-calendar-alt"></i> Naik Gaji</a>
                <a href="#" class="btn btn-block btn-outline-info text-left"><i class="fa fa-calendar-alt"></i> Naik Pangkat</a>
                <a href="#" class="btn btn-block btn-outline-info text-left"><i class="fa fa-calendar-alt"></i> Jabatan</a>
                <a href="#" class="btn btn-block btn-outline-info text-left"><i class="fa fa-calendar-alt"></i> Kepangkatan</a>
                <a href="#" class="btn btn-block btn-outline-info text-left"><i class="fa fa-calendar-alt"></i> Hukuman</a>
                <a href="#" class="btn btn-block btn-outline-info text-left"><i class="fa fa-calendar-alt"></i> Diklat</a>
                <a href="#" class="btn btn-block btn-outline-info text-left"><i class="fa fa-calendar-alt"></i> Penghargaan</a>
                <a href="#" class="btn btn-block btn-outline-info text-left"><i class="fa fa-calendar-alt"></i> Penugasan LN</a>
                <a href="#" class="btn btn-block btn-outline-info text-left"><i class="fa fa-calendar-alt"></i> Seminar</a>
                <a href="#" class="btn btn-block btn-outline-info text-left"><i class="fa fa-calendar-alt"></i> Cuti</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')

@endpush