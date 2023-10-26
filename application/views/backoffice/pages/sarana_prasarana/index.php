<style>
  /*
  * 8. team styles
  */
  .team-one {
    padding-bottom: 90px;
    padding-top: 30px;
  }

  .team-one__single {
    margin-bottom: 30px;
    -webkit-transition: all .4s ease;
    transition: all .4s ease;
  }

  .team-one__single:hover {
    -webkit-box-shadow: 0px 10px 30px 0px rgba(0, 0, 0, 0.05);
            box-shadow: 0px 10px 30px 0px rgba(0, 0, 0, 0.05);
  }

  .team-one__single:hover .team-one__image > img {
    -webkit-transform: scale(1.02);
            transform: scale(1.02);
  }

  .team-one__image {
    text-align: center;
    margin-bottom: -103px;
    width: 100%;
    background-color: #f1f1f1;
  }

  .team-one__image img {
    -webkit-transition: -webkit-transform .4s ease;
    transition: -webkit-transform .4s ease;
    transition: transform .4s ease;
    transition: transform .4s ease, -webkit-transform .4s ease;
    -webkit-transform: scale(1);
            transform: scale(1);
  }

  .team-one__content {
    text-align: center;
    border: 2px solid #f1f1f1;
    padding-bottom: 30px;
    padding-top: 135px;
    padding-left: 40px;
    padding-right: 40px;
  }

  .team-one__social {
    background-color: #f1f1f1;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center;
        -ms-flex-pack: center;
            justify-content: center;
    -webkit-box-align: center;
        -ms-flex-align: center;
            align-items: center;
    padding-top: 11.5px;
    padding-bottom: 11.5px;
  }

  .team-one__social a {
    font-size: 14px;
    color: #81868a;
    -webkit-transition: all .4s ease;
    transition: all .4s ease;
  }

  .team-one__social a:hover {
    color: #f16101;
  }

  .team-one__social a + a {
    margin-left: 28px;
  }

  .team-one__name {
    font-size: 18px;
    font-weight: 600;
    color: #012237;
    margin: 0;
    margin-bottom: -5px;
  }

  .team-one__name a {
    color: inherit;
    -webkit-transition: all .4s ease;
    transition: all .4s ease;
  }

  .team-one__name a:hover {
    color: #f16101;
  }

  .team-one__designation {
    font-size: 12px;
    text-transform: uppercase;
    color: #81868a;
    letter-spacing: .2em;
    line-height: 1em;
    margin: 0;
    margin-top: 15px;
    margin-bottom: 20px;
  }

  .team-one__text {
    margin: 0;
    font-size: 14px;
    color: #81868a;
    font-weight: 500;
    line-height: 30px;
    margin-bottom: -10px;
  }

  .team-details {
    padding-top: 40px;
  }

  .team-details .team-one__image {
    margin-bottom: 0;
  }

  .team-details .team-one__image img {
    border-radius: 0;
  }

  .team-details .team-one__content {
    padding-top: 30px;
  }

  .team-details .team-one__designation {
    margin-bottom: 0;
  }

  .team-details__title {
    margin: 0;
    color: #012237;
    font-size: 25px;
    font-weight: bold;
    margin-bottom: 10px;
  }

  .team-details__text {
    margin: 0;
    color: #81868a;
    font-size: 16px;
    line-height: 34px;
    font-weight: 500;
  }

  .team-details__subtitle {
    margin: 0;
    color: #012237;
    font-size: 20px;
    margin-bottom: 30px;
    margin-top: 30px;
  }

  .team-details__certificate-list {
    margin: 0;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    margin-bottom: 30px;
  }

  .team-details__certificate-list li + li {
    margin-left: 25px;
  }

  .progress-one__single + .progress-one__single {
    margin-top: 20px;
  }

  .progress-one__title {
    margin: 0;
    font-size: 16px;
    font-weight: 600;
    color: #012237;
    line-height: 1em;
  }

  .progress-one__percent {
    margin: 0;
    font-size: 20px;
    color: #f16101;
    font-family: "Satisfy";
    line-height: 1em;
  }

  .progress-one__top {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: justify;
        -ms-flex-pack: justify;
            justify-content: space-between;
    margin-bottom: 20px;
  }

  .progress-one__bar {
    width: 100%;
    height: 5px;
    background-color: #f1f1f1;
    position: relative;
    overflow: hidden;
  }

  .progress-one__bar span {
    position: absolute;
    top: 0;
    left: 0;
    background-color: #2da397;
    height: 100%;
  }

  .team-tab {
    position: relative;
    background-color: #022c46;
  }

  .team-tab:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: url(../img/jurusan.jpg);
    opacity: 0.08;
  }

  .team-tab .container {
    position: relative;
  }

  .team-tab__content {
    padding-right: 80px;
  }

  .team-tab__top {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: justify;
        -ms-flex-pack: justify;
            justify-content: space-between;
  }

  .team-tab__title {
    margin: 0;
    color: #fff;
    font-size: 30px;
    font-weight: 600;
  }

  .team-tab__designation {
    font-size: 12px;
    text-transform: uppercase;
    font-weight: 600;
    letter-spacing: .2em;
    color: #94a2ab;
    margin: 0;
  }

  .team-tab__text {
    margin: 0;
    font-size: 16px;
    font-weight: 500;
    line-height: 34px;
    color: #94a2ab;
    margin-top: 10px;
    margin-bottom: 20px;
  }

  .team-tab__social {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
        -ms-flex-align: center;
            align-items: center;
  }

  .team-tab__social a {
    font-size: 18px;
    color: #fff;
    -webkit-transition: all .4s ease;
    transition: all .4s ease;
  }

  .team-tab__social a:hover {
    color: #f16101;
  }

  .team-tab__social a + a {
    margin-left: 38px;
  }

  .team-tab .progress-one__bar {
    background-color: rgba(255, 255, 255, 0.2);
  }

  .team-tab .progress-one__percent {
    color: #fff;
  }

  .team-tab .progress-one__title {
    color: #fff;
  }

  .team-tab__btn {
    font-size: 18px;
    padding: 21.5px 47.5px;
    margin-top: 40px;
  }

  .team-tab__tab-navs {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    position: absolute;
    bottom: 100px;
    right: 20%;
    border: none;
  }

  .team-tab__tab-navs img {
    border-style: solid;
    border-width: 2px;
    border-color: #fff;
    border-radius: 50%;
    background-color: #012237;
    -webkit-box-shadow: 5px 8.66px 30px 0px rgba(0, 0, 0, 0.2);
            box-shadow: 5px 8.66px 30px 0px rgba(0, 0, 0, 0.2);
    width: 82px;
    opacity: 0.4;
    -webkit-transition: all .4s ease;
    transition: all .4s ease;
  }

  .team-tab__tab-navs .active img {
    opacity: 1;
  }

  .team-tab__tab-navs li + li {
    margin-left: 10px;
  }
</style>
<div class='row'>
<div class="col-md-3">
            <div class="form-group">
                    <label for="">Pencarian</label>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari dengan nama.." id="search">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit" id="btn_search">
                                <i style="color:white;" class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
            </div>
        </div>
   <div class="col-md-3">
                    <label for="">Status</label>

                <select name="" id="" class="form-control" onchange="getval(this)"> 
                    <option value="3">Semua</option>
                    <option value="1">Aktif</option>
                    <option value="0">Tidak Aktif</option>
                </select>
        </div>
  <div class="col-md-3 float-right" style="margin-bottom:10px">
      <a href="#" class="btn btn-primary btn-sm float-right" style="margin-right:5px" id="tambah">Tambah Sarana dan Prasarana</a> 
  </div>
</div>
<div class="box-content">
    <h4 class="box-title">
    <div class="row">
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
                            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">judul</label>
                                    <input type="text" name="judul" id="judul" class="form-control judul">
                                    <input type="hidden" name="idItem" id="idItem" class="form-control">
                                </div>
                                <!-- <div class="form-group">
                                    <label for="" class="control-label">Tipe/Kategori</label>
                                    <select name="tipe" id="tipe" class="form-control">
                                    <option value="1">Osis</option>
                                    <option value="2">Pramuka</option>
                                    <option value="3">Ekstrakurikuler</option>
                                    <option value="4">Kegiatan Lainnya</option>
                                    </select>
                                </div> -->
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
                    <button type="button" class="btn btn-primary" id="btn_simpan">Simpan</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>