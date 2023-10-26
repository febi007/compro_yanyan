
    <div class="row" style="margin-bottom:10px;">
        <div class="col-md-3">
                <select name="" id="" class="form-control" onchange="getval(this)"> 
                    <option value="3">Semua</option>
                    <option value="1">Aktif</option>
                    <option value="0">Tidak Aktif</option>
                </select>
        </div>
        <div class="col-md-3 float-right">
            <a href="#" class="btn btn-primary btn-sm float-right" style="margin-right:5px" id="tambah">Tambah Slider</a> 
        </div>
    </div>

<div class="box-content">
    <h4 class="box-title">
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
                                <div class="form-group">
                                    <label for="">Link</label>
                                     <input type="text" name="link" id="link" class="form-control link">
                                </div>
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