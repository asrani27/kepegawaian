@extends('layouts.app')

@push('css')

@endpush

@section('content')
<form method="post" action="/kepegawaian/gantipass">
    @csrf
    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        GANTI PASSWORD
                    </h3>
                    <!-- tools box -->
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse"
                            data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool btn-sm" data-card-widget="remove"
                            data-toggle="tooltip" title="Remove">
                            <i class="fas fa-times"></i></button>
                    </div>
                    <!-- /. tools -->
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Masukkan Password Lama</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="password_lama" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Password Baru</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="password1" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Masukkan Password lagi</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="password2" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-block btn-primary"><strong><i class="fas fa-save"></i>
                                    UPDATE</strong></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('js')
@endpush