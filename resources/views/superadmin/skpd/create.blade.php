@extends('layouts.app')

@push('css')
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endpush
@section('title')
    TAMBAH DATA LAYANAN
@endsection
@section('content')

<div class="row">
    <div class="col-12">
        <form method="post" action="/superadmin/layanan">
            @csrf
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama Layanan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama" required>
                            </div>
                            </div>

                            <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Centang Persyaratan</label>
                            <div class="col-sm-10">
                                @foreach ($syarat as $key => $item)
                                <div class="custom-control custom-checkbox">
                                  <input class="custom-control-input" type="checkbox" id="customCheckbox{{$item->id}}" name="syarat[]" value="{{$item->id}}">
                                  <label for="customCheckbox{{$item->id}}" class="custom-control-label">{{$item->nama}}</label>
                                </div>
                                @endforeach
                            </div>
                            </div>

                            <div class="form-group row">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-block btn-primary"><strong>SIMPAN</strong></button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@push('js')

@endpush