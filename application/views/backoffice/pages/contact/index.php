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
</div>
<div class="box-content">
    <small class="box-title" style="font-style:italic">
        List pesan dari kontak website
    </small>
    <!-- /.box-title -->
    <table class="table table-hover">
    	<thead>
    		<tr>
    			<th>#</th>
    			<th>Nama</th> 
    			<th>E-mail</th> 
    			<th>Pesan</th> 
    			<th>Tanggal kirim</th> 
    			<th>Aksi</th> 
    		</tr> 
    	</thead> 
    	<tbody id="tbl_user"> 
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
