 <!-- <div class="box-content"> -->
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
                <label for="">Status</label>

                <select name="" id="" class="form-control" onchange="getval(this)"> 
                    <option value="3">Semua</option>
                    <option value="1">Aktif</option>
                    <option value="0">Tidak Aktif</option>
                </select>
            </div>
            <?php if( (int)$this->session->grant_access!=0):?>
           <div class="float-right" style="margin-right:15px;margin-bottom:10px;">
               <a href="#!" class="btn btn-success" id="tambahKategori">Tambah Kategori</a>
           </div>
            <?php endif;?>
           <div class="float-right" style="margin-right:15px;margin-bottom:10px;">
               <a href="#!" class="btn btn-success" id="tambah">Tambah</a>
           </div>
        </div>

    </h4>
    <!-- /.box-title -->
           <div class="row">
               <div class="col-md-9">
                   <div class="row" id="berita">
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
               <div class="col-lg-3">
                   <div class="card p-4">
                       <div class="card-body">
                           <h5 class="card-title">Kategori <small><a href="" id="lihatSemua">Lihat Semua</small></a></h5>
                           <div class="panel panel-default" id="kategori_side">
                               
                               
                           </div>
                           <!-- <ul class="list-group" id="kategori_side">
                               <li class="list-group-item active">Suplemen</li>
                               <li class="list-group-item">Tanah</li>
                           </ul> -->
                       </div>
                   </div>
               </div>
           </div>

<div class="modal" id="form-berita" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <div class="form-group">
                        <label for="title">Judul</label>
                        <input type="text" class="form-control" id="title" require>
                        <input type="hidden" name="idItem" id="idItem">
                        <small id="err-title" style="display:none" class="form-text text-danger">.</small>
                    </div>
                    <div class="form-group">
                        <label for="price">Kategori</label>
                        <!-- <input type="text" class="form-control" id="qty" placeholder="Qty"> -->
                        <select name="category" class="form-control" id="category">
                            <option value="1">Suplemen</option>
                            <option value="2">Kavling</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price">Deskripsi</label>
                        <textarea name="caption" class="form-control" id="caption" cols="30" rows="10"></textarea>
                        <small id="err-caption" style="display:none" class="form-text text-danger">.</small>
                    </div>
                    <div class="form-group">
                        <label for="">Gambar</label>
                        <input type="file" id="file2" class="form-control" onchange="readURL(this,'preview')">
                        <small id="err-picture" style="display:none" class="form-text text-danger">.</small>
                        <input type="hidden" name="picture" id="picture" require>
                        <img src="" id="preview" alt="" width="100%">
                    </div>
                    <div class="form-group">
                        <label for="title">Tags</label>
                        <input type="text" class="form-control" id="tags" require>
                    </div>
                </div>
                    <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn_simpan">Simpan</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="form-kategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <div class="form-group">
                        <label for="title">Judul</label>
                        <input type="text" class="form-control" id="titleKategori" require>
                        <input type="hidden" name="idItem" id="idItemKategori">
                        <small id="err-title" style="display:none" class="form-text text-danger">.</small>
                    </div>
                </div>
                    <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn_simpan_kategori">Simpan</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>