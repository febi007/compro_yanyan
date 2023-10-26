<div class="row">
    <div class="col-md-3">
        <ul class="list-group">
            <li class="list-group-item active" data-id='2' style="cursor:pointer" id="mgeneral" onClick='event.preventDefault();changeShow(this);'>Struktur Organisasi</li>
            <li class="list-group-item" data-id='3' style="cursor:pointer" id="mdetail" onClick='event.preventDefault();changeShow(this);'>Divisi</li>
            <li class="list-group-item" data-id='4' style="cursor:pointer" id="mfaq" onClick='event.preventDefault();changeShow(this);'>Akreditasi</li>
            <li class="list-group-item" data-id='5' style="cursor:pointer" id="msejarah" onClick='event.preventDefault();changeShow(this);'>Sejarah</li>
            <li class="list-group-item" data-id='6' style="cursor:pointer" id="mvm" onClick='event.preventDefault();changeShow(this);'>Visi & Misi</li>
            <li class="list-group-item" data-id='7' style="cursor:pointer" id="mbl" onClick='event.preventDefault();changeShow(this);'>Budaya & Logo</li>
            <li class="list-group-item" data-id='8' style="cursor:pointer" id="mlh" onClick='event.preventDefault();changeShow(this);'>Landasan Hukum</li>
            <?php 
            if($this->session->id_level==1||$this->session->id_level==5):?>
            <li class="list-group-item" data-id='13' style="cursor:pointer" id="mosis" onClick='event.preventDefault();changeShow(this);'>Osis</li>
            <li class="list-group-item" data-id='14' style="cursor:pointer" id="mpramuka" onClick='event.preventDefault();changeShow(this);'>Pramuka</li>
            <li class="list-group-item" data-id='15' style="cursor:pointer" id="mekstra" onClick='event.preventDefault();changeShow(this);'>Ekstrakurikuler</li>
            <li class="list-group-item" data-id='16' style="cursor:pointer" id="mprestasi" onClick='event.preventDefault();changeShow(this);'>Pestasi</li>
            <?php endif?>
        </ul>
    </div>
    <div class="col-md-9" >
        <div class="box-content" id="general">
            <h4 class="box-title">
                Struktur Organisasi
            </h4>
            <div class="table-responsive">
                <div class="form-group" id='gamar'>
                    <label for="">Gambar</label>
                    <input type="file" id="file2" class="form-control" onchange="readURL(this,'preview')">
                    <small id="err-picture" style="display:none" class="form-text text-danger">.</small>
                    <input type="hidden" name="picture" id="picture" require>
                    <div style="text-align:center;margin-top:20px">
                        <img src="" id="preview" alt="" width="60%">
                    </div>
                </div>

                <h4 style='font-weight:700'>keterangan:</h4>
                <div class="form-group">
                    <label for="price">Judul</label>
                    <input type="text" name="judul" id="judul" class="form-control">
                    <input type="hidden" name="idItem" id="idItem" class="form-control">
                    <small id="err-caption" style="display:none" class="form-text text-danger">.</small>
                </div>
                <div class="form-group">
                    <label for="price">Deskripsi <small style="font-style:italic">(Tekan TAB untuk menambah row tabel)</small></label>
                    <textarea name="caption" class="form-control" id="caption" cols="30" rows="10"></textarea>
                    <small id="err-caption" style="display:none" class="form-text text-danger">.</small>
                </div>
                <a href="#" class="btn btn-success" id="tambah">Simpan perubahan</a>
            </div>
        </div>
    </div>

</div>