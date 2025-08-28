<div class="col-lg-10 col-md-6">
    <div class="card">
        <div class="card-header bg-gradient-secondary">
            Profil Pegawai
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                <div class="text-center">
                  <a href="{{$pegawai->foto == null ? '/theme/dist/img/default-150x150.png':$pegawai->foto}}"><img class="profile-user-img img-fluid" src="{{$pegawai->foto == null ? '/theme/dist/img/default-150x150.png':$pegawai->foto}}" alt="User profile picture"></a>
                </div>

                <h3 class="profile-username text-center"> {{$pegawai->nip}}</h3>
                <p class="text-muted text-center"> {{$pegawai->nama}}</p>
                </div>
                <div class="col-lg-9 col-md-6">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" name="nama" value="{{$pegawai->nama}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">NIP</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" name="nip" value="{{$pegawai->nip}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">NIK</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" name="nik" value="{{$pegawai->nik}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-9">
                            <select name="jenis_kelamin" class="form-control form-control-sm">
                                <option value="L">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Tempat, Tanggal Lahir</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control form-control-sm" name="tempat_lahir" value="{{$pegawai->tempat_lahir}}">
                        </div>
                        <div class="col-sm-4">
                            <input type="date" class="form-control form-control-sm" name="tanggal_lahir" value="{{$pegawai->tanggal_lahir}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Umur</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" name="umur">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Golongan Darah</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" name="gol_darah">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Agama</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" name="agama">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Status Pernikahan</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" name="status_pernikahan">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">No Telp</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" name="telp">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" name="alamat">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Status Kepegawaian</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" name="status_pegawai">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Status Aktif</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" name="status_aktif">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                            <a href="#" class="btn btn-sm btn-outline-primary"><i class="fa fa-save"></i> Perbaharui</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
        </div>
    </div>
</div>