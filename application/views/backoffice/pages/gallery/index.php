<style>
  .hovereffect {
    width: 100%;
    height: 230px;
    float: left;
    overflow: hidden;
    position: relative;
    text-align: center;
    cursor: default;
  }
  
  .hovereffect .overlay {
    width: 100%;
    height: 100%;
    position: absolute;
    overflow: hidden;
    top: 0;
    left: 0;
    background-color: rgba(0,0,0,0.6);
    opacity: 0;
    filter: alpha(opacity=0);
    -webkit-transform: translate(460px, -100px) rotate(180deg);
    -ms-transform: translate(460px, -100px) rotate(180deg);
    transform: translate(460px, -100px) rotate(180deg);
    -webkit-transition: all 0.2s 0.4s ease-in-out;
    transition: all 0.2s 0.4s ease-in-out;
  }
  
  .hovereffect img {
    background-position: center;
    display: block;
    position: relative;
    -webkit-transition: all 0.2s ease-in;
    transition: all 0.2s ease-in;
    width: 100%;
  }
  
  .hovereffect p {
    /*text-transform: uppercase;*/
    color: #fff;
    text-align: center;
    position: relative;
    font-size: 12px;
    padding: 10px;
    /*background: rgba(0, 0, 0, 0.6);*/
    /*height: 150px;*/
  }
  
  .hovereffect a.info {
    display: inline-block;
    text-decoration: none;
    padding: 7px 14px;
    /*text-transform: uppercase;*/
    color: #fff;
    border: 1px solid #fff;
    margin: 50px 0 0 0;
    background-color: transparent;
    -webkit-transform: translateY(-200px);
    -ms-transform: translateY(-200px);
    transform: translateY(-200px);
    -webkit-transition: all 0.2s ease-in-out;
    transition: all 0.2s ease-in-out;
  }
  
  .hovereffect a.info:hover {
    box-shadow: 0 0 5px #fff;
  }
  
  .hovereffect:hover .overlay {
    opacity: 1;
    filter: alpha(opacity=100);
    -webkit-transition-delay: 0s;
    transition-delay: 0s;
    -webkit-transform: translate(0px, 0px);
    -ms-transform: translate(0px, 0px);
    transform: translate(0px, 0px);
  }
  
  .hovereffect:hover p {
    -webkit-transform: translateY(0px);
    -ms-transform: translateY(0px);
    transform: translateY(0px);
    -webkit-transition-delay: 0.5s;
    transition-delay: 0.5s;
    /*height: 200px;*/
  }
  
  .hovereffect:hover a.info {
    -webkit-transform: translateY(0px);
    -ms-transform: translateY(0px);
    transform: translateY(0px);
    -webkit-transition-delay: 0.3s;
    transition-delay: 0.3s;
  }

  figure.snip1477 {
    font-family: 'Raleway', Arial, sans-serif;
    position: relative;
    overflow: hidden;
    margin: 10px;
    width: 100%;
    height:auto;
    color: #ffffff;
    text-align: center;
    font-size: 16px;
    background-color: #000000;
  }
  figure.snip1477 *,
  figure.snip1477 *:before,
  figure.snip1477 *:after {
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    -webkit-transition: all 0.55s ease;
    transition: all 0.55s ease;
  }
  figure.snip1477 img {
    max-width: 100%;
    backface-visibility: hidden;
    vertical-align: top;
    opacity: 0.9;
  }
  figure.snip1477 .title {
    position: absolute;
    top: 58%;
    left: 25px;
    padding: 5px 10px 10px;
  }
  figure.snip1477 .title:before,
  figure.snip1477 .title:after {
    height: 2px;
    width: 400px;
    position: absolute;
    content: '';
    background-color: #ffffff;
  }
  figure.snip1477 .title:before {
    top: 0;
    left: 10px;
    -webkit-transform: translateX(100%);
    transform: translateX(100%);
  }
  figure.snip1477 .title:after {
    bottom: 0;
    right: 10px;
    -webkit-transform: translateX(-100%);
    transform: translateX(-100%);
  }
  figure.snip1477 .title div:before,
  figure.snip1477 .title div:after {
    width: 2px;
    height: 300px;
    position: absolute;
    content: '';
    background-color: #ffffff;
  }
  figure.snip1477 .title div:before {
    top: 10px;
    right: 0;
    -webkit-transform: translateY(100%);
    transform: translateY(100%);
  }
  figure.snip1477 .title div:after {
    bottom: 10px;
    left: 0;
    -webkit-transform: translateY(-100%);
    transform: translateY(-100%);
  }
  figure.snip1477 h2,
  figure.snip1477 h4 {
    margin: 0;
    text-transform: uppercase;
  }
  figure.snip1477 h2 {
    font-weight: 400;
  }
  figure.snip1477 h4 {
    display: block;
    font-weight: 700;
    background-color: #ffffff;
    padding: 5px 10px;
    color: #000000;
  }
  figure.snip1477 figcaption {
    position: absolute;
    bottom: 42%;
    left: 25px;
    text-align: left;
    opacity: 0;
    padding: 5px 60px 5px 10px;
    font-size: 0.8em;
    font-weight: 500;
    letter-spacing: 1.5px;
  }
  figure.snip1477 figcaption p {
    margin: 0;
  }
  figure.snip1477 a {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
  }
  figure.snip1477:hover img,
  figure.snip1477.hover img {
    zoom: 1;
    filter: alpha(opacity=35);
    -webkit-opacity: 0.35;
    opacity: 0.35;
  }
  figure.snip1477:hover .title:before,
  figure.snip1477.hover .title:before,
  figure.snip1477:hover .title:after,
  figure.snip1477.hover .title:after,
  figure.snip1477:hover .title div:before,
  figure.snip1477.hover .title div:before,
  figure.snip1477:hover .title div:after,
  figure.snip1477.hover .title div:after {
    -webkit-transform: translate(0, 0);
    transform: translate(0, 0);
  }
  figure.snip1477:hover .title:before,
  figure.snip1477.hover .title:before,
  figure.snip1477:hover .title:after,
  figure.snip1477.hover .title:after {
    -webkit-transition-delay: 0.15s;
    transition-delay: 0.15s;
  }
  figure.snip1477:hover figcaption,
  figure.snip1477.hover figcaption {
    opacity: 1;
    -webkit-transition-delay: 0.2s;
    transition-delay: 0.2s;
  }
</style>

<div class="box-content">
    <h4 class="box-title">
    <div class="row">
      <div class="col-md-3">
                    <div class="form-group">
                            <label for="">Pencarian</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Cari dengan judul.." id="search">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="submit" id="btn_search">
                                        <i style="color:white;" class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                    </div>
        </div>
        <div class="col-md-3">
            <label for="" class="control-label">Tipe/Kategori</label>
            <select name="filtertipe" id="filtertipe" onClick='getval(this)' class="form-control">
                <option value="0">Semua</option>
                <option value="1">Osis</option>
                <option value="2">Pramuka</option>
                <option value="3">Ekstrakurikuler</option>
                <option value="8">Prestasi</option>
                <!-- <option value="9">Prestasi</option> -->
                <option value="4">Kegiatan Lainnya</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="" class="control-label">Status</label>

                <select name="" id="" class="form-control" onchange="getval2(this)"> 
                    <option value="3">Semua</option>
                    <option value="1">Aktif</option>
                    <option value="0">Tidak Aktif</option>
                </select>
        </div>
        <div class="col-md-3 float-right">
            <a href="#" class="btn btn-primary btn-sm float-right" style="margin-right:5px" id="tambah">Tambah Gallery</a> 
        </div>
    </div>
    </h4>
    <div class="row" id="gallery">
        
    </div>
    <div class="row">
        <div class="col-md-12">
           <nav class="float-right" aria-label="Page navigation example">
                   <ul class="pagination">
                   </ul>
               </nav>
           </div>
        </div>
    </div>
</div>

<div class="modal" id="form-gallery" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="exampleModalLabel">Create Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addBerita">
                <div class="modal-body">
                    <div class="row">
                        <form id="form_input" novalidate="novalidate">
                            <p class="text-center" id="pesan" style="color: red;"></p>
                            <input type="hidden" name="id_gallery" class="id_gallery" value="69">
                            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <label class="control-label">judul</label>
                                    <input type="text" name="judul" id="judul" class="form-control judul">
                                    <input type="hidden" name="idItem" id="idItem" class="form-control">
                                    <input type="hidden" name="status" id="status" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Tipe/Kategori</label>
                                    <select name="tipe" id="tipe" class="form-control">
                                    <option value="1">Osis</option>
                                    <option value="2">Pramuka</option>
                                    <option value="3">Ekstrakurikuler</option>
                                    <option value="8">Prestasi</option>
                                    <option value="4">Kegiatan Lainnya</option>
                                    </select>
                                </div>
                                <!-- <div class="form-group">
                                    <label for="">Link</label>
                                     <input type="text" name="link" id="link" class="form-control link">
                                </div> -->
                                <div class="form-group">
                                    <label class="control-label">Gambar</label>
                                    <input type="file" id="file2" class="form-control" onchange="readURL(this,'preview')">
                                </div>
                            </div>
                        
                            <div class="col-sm-6" id="desk" style="">
                                <div class="form-group">
                                    <label class="control-label">Deskripsi</label>
                                    <textarea class="form-control deskripsi" name="deskripsi" id="caption"></textarea>
                                </div>
                                <div class="form-group">
                                    <img src="" id="preview" alt="" width="100%" height="200px">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                    <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sm" id="btn_simpan">Simpan</button>
                    <?= (int)$this->session->grant_access!=1?'':' <button type="button" class="btn btn-success btn-sm" id="btn_aktif">Aktifkan</button>'?>
                   
                    <button type="button" class="btn btn-danger btn-sm" id="btn_hapus" onClick="hapus()">Hapus</button>
                    <button type="button" class="btn btn-warning btn-sm" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>