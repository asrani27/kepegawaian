@extends('layouts.app')

@push('css')
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endpush
@section('title')
    EDIT
@endsection
@section('content')
<br/>
<div class="row">
    <div class="col-12">
        <a href="/superadmin/soal" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a><br/><br/>
<form method="post" action="/superadmin/soal/{{$data->id}}">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="card">
                <div class="card-body">  
                       
                    <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col-sm-10">
                        <select name="kategori_id" class="form-control">
                            @foreach ($kategori as $item)
                                <option value="{{$item->id}}" {{$data->kategori_id == $item->id ? 'selected':''}}>{{$item->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    </div>

                    <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Pertanyaan</label>
                    <div class="col-sm-10">
                        <textarea id="summernote" name="pertanyaan">{!!$data->pertanyaan!!}</textarea>
                    </div>
                    </div>
                    
                    <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Pilihan A</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="pil_a" value="{{$data->pil_a}}" required>
                    </div>
                    </div>

                    <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Pilihan B</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="pil_b" value="{{$data->pil_b}}" required>
                    </div>
                    </div>
                    
                    <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Pilihan C</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="pil_c" value="{{$data->pil_c}}" required>
                    </div>
                    </div>
                    
                    <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Pilihan D</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="pil_d" value="{{$data->pil_d}}" required>
                    </div>
                    </div>

                    <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kunci Jawaban</label>
                    <div class="col-sm-10">
                        <select name="kunci" class="form-control">
                            <option value="A" {{$data->kunci == "A" ? 'selected':''}}>A</option>
                            <option value="B" {{$data->kunci == "B" ? 'selected':''}}>B</option>
                            <option value="C" {{$data->kunci == "C" ? 'selected':''}}>C</option>
                            <option value="D" {{$data->kunci == "D" ? 'selected':''}}>D</option>
                        </select>
                    </div>
                    </div>
                    <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-block btn-primary"><strong>UPDATE</strong></button>
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
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
 <script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
  </script>

@endpush