@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

@endpush
@section('title')
Admin Hukuman Disiplin
@endsection
@section('content')
<div class="row">
    <div class="col-md-4 col-sm-6 col-12">
        <div class="info-box bg-gradient-info">
            <span class="info-box-icon"><i class="fas fa-users"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Hukuman Disiplin</span>
                <span class="info-box-number">0</span>

                <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                    Total Data Hukuman Disiplin
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
</div>


@endsection

@push('js')

@endpush