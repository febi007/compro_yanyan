<div class="box-content">
    <h4 class="box-title">
    <div class="row">
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
        <div class="col-md-3 float-right">
            <a href="#" class="btn btn-primary btn-sm float-right" id="tambah">Tambah </a>
        </div>
    </div>
    </h4>
    <!-- /.box-title -->
    <table class="table table-hover">
    	<thead>
    		<tr>
    			<th>#</th>
    			<th>Gambar</th> 
    			<th>Nama Jurusan</th> 
    			<th>Deskripsi</th> 
    			<th>Visi</th> 
    			<th>Misi</th> 
    			<th>icon</th> 
    			<th>Dibuat pada</th> 
    		</tr> 
    	</thead> 
    	<tbody id="tbl_lowongan"> 
    	</tbody> 
    </table>
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
                        <label for="title">Nama Jurusan</label>
                        <input type="text" class="form-control" id="title" require>
                        <input type="hidden" name="idItem" id="idItem">
                        <small id="err-title" style="display:none" class="form-text text-danger">.</small>
                    </div>
                    <div class="form-group">
                        <label for="price">Deskripsi</label>
                        <textarea name="caption" class="form-control" id="caption" cols="30" rows="10"></textarea>
                        <small id="err-caption" style="display:none" class="form-text text-danger">.</small>
                    </div>
                    <div class="form-group">
                        <label for="price">Visi</label>
                        <textarea name="visi" class="form-control" id="visi" cols="30" rows="10"></textarea>
                        <small id="err-visi" style="display:none" class="form-text text-danger">.</small>
                    </div>
                    <div class="form-group">
                        <label for="price">Misi</label>
                        <textarea name="misi" class="form-control" id="misi" cols="30" rows="10"></textarea>
                        <small id="err-misi" style="display:none" class="form-text text-danger">.</small>
                    </div>
                    <div class="form-group">
                        <label for="">Gambar</label>
                        <input type="file" id="file2" class="form-control" onchange="readURL(this,'preview')">
                        <small id="err-picture" style="display:none" class="form-text text-danger">.</small>
                        <img src="" id="preview" alt="" width="100%">
                    </div>
                    <div class="form-group">
                        <label for="">Icon Jurusan <small>(Icon dihomepage)</small></label>
                        <input type="file" id="file3" class="form-control">
                        <small id="err-picture" style="display:none" class="form-text text-danger">.</small>
                        <img src="" id="preview" alt="" width="100%">
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
