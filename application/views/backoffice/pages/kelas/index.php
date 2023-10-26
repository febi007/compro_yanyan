<div class="box-content">
    <h4 class="box-title">
    <div class="row">
        <div class="col-md-3">
            <label for="">Pencarian</label>
            <input type="text" name="search" id="search" class="form-control" placeholder="Cari dengan nama...">
        </div>
        <div class="col-md-3">
            <label for="">Jurusan</label>
            <select name="jurusanfilter" class="form-control" onChange="getval(this);"  id="jurusanfilter">
                <option value="1">x</option>
            </select>
        </div>
        <div class="col-md-3 float-right">
            <a href="#" class="btn btn-primary btn-sm float-right" style="margin-right:5px" id="tambah">Tambah Kelas</a> 
        </div>
    </div>
    </h4>
    <!-- /.box-title -->
    <table class="table table-hover">
    	<thead>
    		<tr>
    			<th>#</th>
    			<th>Kelas</th> 
    			<th>Jurusan</th> 
    			<th>Tanggal Input</th> 
    		</tr> 
    	</thead> 
    	<tbody id="tbl_user"> 
    	</tbody> 
    </table>
</div>

<div class="modal" id="form-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <label for="title">Nama</label>
                        <input type="text" class="form-control" id="nama" require>
                        <input type="hidden" name="idItem" id="idItem">
                        <small id="err-nama" style="display:none" class="form-text text-danger">.</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="title">Jurusan</label>
                        <select name="jurusan" class="form-control" id="jurusan">
                            <option value="1">x</option>
                        </select>
                        <small id="err-jurusan" style="display:none" class="form-text text-danger">.</small>
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
