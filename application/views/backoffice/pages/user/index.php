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
            <a href="#" class="btn btn-primary btn-sm float-right" id="tambah">Tambah User</a>
        </div>
    </div>
    </h4>
    <!-- /.box-title -->
    <table class="table table-hover">
    	<thead>
    		<tr>
    			<th>#</th>
    			<th>Nama</th> 
    			<th>Username</th> 
    			<th>Level</th> 
    			<th>Status</th> 
    			<th>Dibuat pada</th> 
    			<th>Tanggal Perubahan</th> 
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
                        <label for="title">Username</label>
                        <input type="text" class="form-control" id="username" require>
                        <small id="err-username" style="display:none" class="form-text text-danger">.</small>
                    </div>
                    <div class="form-group">
                        <label for="title">Password <small>(Kosongkan jika tidak di edit)</small></label>
                        <input type="password" class="form-control" id="password" require>
                        <small id="err-password" style="display:none" class="form-text text-danger">.</small>
                    </div>
                    <div class="form-group">
                        <label for="title">Level</label>
                        <select name="level" class="form-control" id="level">
                            <option value=""></option>
                        </select>
                        <small id="err-level" style="display:none" class="form-text text-danger">.</small>
                    </div>
                    <div class="form-group">
                        <label for="title">Status</label>
                        <select name="status" class="form-control" id="status">
                            <option value="0">Non-Aktif</option>
                            <option value="1">Aktif</option>
                        </select>
                        <small id="err-status" style="display:none" class="form-text text-danger">.</small>
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