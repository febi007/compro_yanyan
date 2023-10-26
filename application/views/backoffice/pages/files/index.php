    <div class="row" style="margin-bottom:20px">
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
        <div class="col-md-3 float-right">
            <a href="#" class="btn btn-primary btn-sm float-right" style="margin-right:5px" id="tambah">Tambah Files</a> 
        </div>
    </div>
<div class="box-content">
    <h4 class="box-title">
    </h4>
    <!-- /.box-title -->
    <table class="table table-hover">
    	<thead>
    		<tr>
    			<th>#</th>
    			<th>Judul</th> 
    			<th>Link</th> 
                <th>Status</th>
                <th>Jumlah Download</th>
    			<th>Tanggal Input</th> 
    			<th>Aksi</th> 
    		</tr> 
    	</thead> 
    	<tbody id="tbl_partnership"> 
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
                            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Judul</label>
                                    <input type="text" name="title" id="title" class="form-control title">
                                    <input type="hidden" name="idItem" id="idItem" class="form-control">
                                </div>
                               
                                <div class="form-group">
                                    <label class="control-label">File</label>
                                    <input type="file" id="file2" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Status</label>
                                    <select name="status" id="status"  class="form-control">
                                        <option value="0">Tidak Aktif</option>
                                        <option value="1">Aktif</option>
                                    </select>
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