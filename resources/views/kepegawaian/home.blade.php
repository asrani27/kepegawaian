@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

@endpush
@section('title')
Beranda
@endsection
@section('content')
<div class="row">
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box bg-gradient-info">
            <span class="info-box-icon"><i class="fas fa-users"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Total Pegawai</span>
                <span class="info-box-number">0</span>

                <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                    Total Data Pegawai
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box bg-gradient-success">
            <span class="info-box-icon"><i class="fas fa-users"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">PNS</span>
                <span class="info-box-number">0</span>

                <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                    Total Data PNS
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box bg-gradient-warning">
            <span class="info-box-icon"><i class="fas fa-users"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">CPNS</span>
                <span class="info-box-number">0</span>

                <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                    Total Data CPNS
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box bg-gradient-danger">
            <span class="info-box-icon"><i class="fas fa-users"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Pensiun</span>
                <span class="info-box-number">30</span>

                <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                    Total Data Pensiun
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
</div>

@endsection

@push('js')

@endpush