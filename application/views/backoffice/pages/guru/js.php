
<script>
    var $pagination = $('.pagination');
    var defaultOpts = {
        totalPages: 20,
    };
    $(document).ready(function(){
        loadJabatan();
        let searchParams = new URLSearchParams(window.location.search)
        if(searchParams.has('page')) get(searchParams.get('page'));
        else get();
            $("#tambah").on('click',function(event) {
                set_ckeditor('caption')
                event.preventDefault();
                // $("#form-berita").modal('show');
                $("#form-berita").modal();
                if(!$("#form-berita").parent().is('body')) $("#form-berita").appendTo("body");
                // $("#form-berita").appendTo("body");
                $(".modal-title").html("Tambah Data Guru");
                $("#title").val("");

                $("#file2").val("");
                $("#nama").val("");
                $("#jabatan").val("");
                $("#nip").val("");
                $("#matpel").val("");
                $("#idItem").val("");
                $("#btn_simpan").text("Simpan")
                $("#notif-container").show();
                $('#preview').attr("src","");
            });

            $("#lihatSemua").on('click',function(event) {
                event.preventDefault();
                localStorage.removeItem('berita_cate')
                $(".list-group-item").removeClass("active");
                get();
            });
            
            $("#tambahKategori").on('click',function(event) {
                event.preventDefault();
                $("#form-kategori").modal();
                if(!$("#form-kategori").parent().is('body')) $("#form-kategori").appendTo("body");
                $(".modal-title-kategori").html("Tambah Kategori");
                $("#title-kategori").val("");
                CKEDITOR.instances.captionKategori.setData("");
                $("#file2-kategori").val("");
                $("#picture-kategori").val("");
                $("#caption-kategori").text("");
                $("#idItemKategori").val();
                $("#btn_simpan_kategori").text("Simpan")
                $('#preview-kategori').attr("src","");
            });
            $("#btn_search").click(function(event) {
                event.preventDefault();
                var data = $("#search").val();
                get(1, data);
            });
            $('#search').on('keypress', function (e) {
                    if(e.which === 13){

                        var data = $("#search").val();
                        get(1, data);
                    }
            });
            
            $("#btn_simpan").click(function(event) {
                event.preventDefault();
                if($("#idItem").val()===""){
                    goInsert();
                }else{
                    goUpdate();
                }
            });
            $("#btn_simpan_kategori").click(function(event) {
                event.preventDefault();
                if($("#idItemKategori").val()==""){
                    goInsertCategory();
                }else{
                    goUpdateCategory();
                }
            });

            $('#form-berita').on('hidden.bs.modal', function (e) {
                // do something when this modal window is closed...
                CKEDITOR.instances.editor.destroy();
            });

            
    });

    function get(page=1,q=null,cate=null){
        var search = q!==null?`&q=${q}`:'';
        var category = cate!==null?`&category=${cate}`:'';
        var category= cate!=null?`&category=${cate}`:(localStorage.getItem('berita_cate')!==null?`&category=${localStorage.getItem('berita_cate')}`:'');

        var pages= page!==1?`&page=${page}`:(localStorage.getItem('berita_page')?`&page=${localStorage.getItem('berita_page')}`:'&page=1');

        $.ajax({
            // pages+search+category,
            url: "<?=urls('manajemenAction')?>?aksi=get&type=guru"+pages+search+category,
            beforeSend: function(result){
                NProgress.start();
                //HoldOn.open(optionsLoader);
            },
            success: function(data){
                NProgress.done();HoldOn.close();
                const res = JSON.parse(data);
                if(data.length>0){
                    // const result = data.result;
                    console.log(res);
                    const result = res.data;
                    let card=''
                    let pagination=''
                        $.each(result,function(key,item){
                            card+='<tr><td><div class="dropdown">'+
                                        '<button type="button" class="btn btn-default btn-xs  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></button>'+
                                        '<ul class="dropdown-menu"><input type="hidden" id="getId'+key+'" value="'+item.id+'">'+
                                            '<li><a href="#" onClick="event.preventDefault();update(\''+item.id+'\');"><i class="mdi mdi-tooltip-edit"></i> Update</a></li>'+
                                            // '<li><a href="#" onClick="event.preventDefault();approval(\''+item.status+'\',\''+item.id+'\');"><i class="mdi mdi-account-check"></i> '+(item.status===0?'Aktifkan':'Non-Aktifkan')+'</a></li>'+
                                            '<li><a href="#" onClick="event.preventDefault();hapus(\''+item.id+'\');"><i class="mdi mdi-delete-forever"></i> Delete</a></li>'+
                                        '</ul></div></td>'+
                                '<td><img src="'+item.image+'" width="150px"/></td>'+
                                '<td>'+item.nama+'</td>'+
                                '<td>'+item.nip+'</td>'+
                                '<td>'+item.matpel+'</td>'+
                                '<td>'+item.deskripsi+'</td>'+
                                '<td>'+item.created_at+'</td>'+
                                '<td>';
                            card+='</td>'+
                            '</tr>';

                        })
                        pagination+='<li class="page-item '+(res.current_page===1?'disabled':'')+'">'+
                                    '<a class="page-link" href="#" aria-label="Previous"  onClick="event.preventDefault();get('+(res.current_page-1)+');">'+
                                        '<span aria-hidden="true">&laquo;</span>'+
                                        '<span class="sr-only">Previous</span>'+
                                    '</a>'+
                                    '</li>';
                        for($i=0;$i<res.last_page;$i++){
                            pagination+='<li class="page-item '+(res.current_page===$i+1?'active':'')+'">'+
                                            '<a class="page-link" href="#" type="button" onClick="event.preventDefault();get('+($i+1)+');">'+($i+1)+'</a>'+
                                        '</li>';
                        }
                            pagination+='<li class="page-item '+(res.current_page===res.last_page?'disabled':'')+'">'+
                                    '<a class="page-link" href="#" aria-label="Next" onClick="event.preventDefault();get('+(res.current_page+1)+');">'+
                                        '<span aria-hidden="true">&raquo;</span>'+
                                        '<span class="sr-only">Next</span>'+
                                    '</a>'+
                                    '</li>';
                    $(".pagination").html(pagination);
                    $("#tbl_lowongan").html(card);
                }else{
                    card+="<div class='col-md-12'><div class='text-center'>Tidak ada data.</div></div>"
                }
            }
        });
    }

    function update(id){
        // $('.modal-body').html(id)
        set_ckeditor('caption')
         $.ajax({
            url: "<?=urls('manajemenAction')?>?aksi=detail&id="+id, 
            beforeSend: function(result){
                NProgress.start();
                // HoldOn.open(optionsLoader);
            },
            success: function(data){
                NProgress.done();
                // HoldOn.close();
                const res = JSON.parse(data);
                if(res){
                    $("#form-berita").modal();
                    if(!$("#form-berita").parent().is('body')) $("#form-berita").appendTo("body");
                    $(".modal-title").html("Update: "+res.nama);
                    $("#idItem").val(res.id);
                    $("#nama").val(res.nama);
                    $("#matpel").val(res.matpel);
                    $("#nip").val(res.nip);
                    $("#btn_simpan").text("Update")
                    CKEDITOR.instances['caption'].setData(res.deskripsi);

                    $('#preview').attr("src",res.image);
                    // $(".modal-body").html(data);
                }else{
                    $('#form-berita').modal('hide');
                   toastr["error"]("Gagal mengambil data.")
                }
                // id(result.)
            }
        });
    }

    function goUpdate(){
        let id=$("#idItem").val();
        let nama=$("#nama").val();
        let nip=$("#nip").val();
        let matpel=$("#matpel").val();
        let picture=$("#file2").val();
        if(nama===""){$("#err-nama").css("display", "block");$("#err-nama").html("Nama produk tidak boleh kosong.")}
        let caption=CKEDITOR.instances['caption'].getData();

        var fd =  new FormData();
        fd.append( 'id', id);
        fd.append( 'nama', nama);
        fd.append( 'jabatan', 7);
        fd.append( 'matpel', matpel);
        fd.append( 'nip', nip);
        fd.append( 'image', $('input[type=file]')[0].files[0])
        fd.append( 'deskripsi', caption);
            fd.append( 'id_jurusan', 0);

        if(nama!=="" && matpel!==""){
            $.ajax({
                url: "<?=urls('manajemenAction')?>?aksi=update", 
                type: "post",
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                data:fd,
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function(result){
                    NProgress.start();HoldOn.open(optionsLoader);
                },
                success: function(data){
                    NProgress.done();HoldOn.close();
                    const res = data;
                    get();
                    if(res){
                        toastr["success"]("Berhasil memperbaharui data.")
                        $("#form-berita").modal('hide');
                    }else{
                        toastr["error"]("Gagal memperbaharui data.")
                    }

                    // id(result.)
                }
            });
        }
    }
    
    function goInsert() {
        console.log("insert");

        let nama=$("#nama").val();
        let nip=$("#nip").val();
        let matpel=$("#matpel").val();
        let picture=$("#file2").val();
        if(nama===""){$("#err-nama").css("display", "block");$("#err-nama").html("Nama produk tidak boleh kosong.")}
        if(picture===""){$("#err-picture").css("display", "block");$("#err-picture").html("Gambar tidak boleh kosong.")}
        let caption=CKEDITOR.instances['caption'].getData();

        var fd =  new FormData();
        fd.append( 'nama', nama);
        fd.append( 'jabatan', 7);
        fd.append( 'matpel', matpel);
        fd.append( 'nip', nip);
        fd.append( 'image', $('input[type=file]')[0].files[0])
        fd.append( 'deskripsi', caption);
                    fd.append( 'id_jurusan', 0);

        if(nama!=="" && matpel!=="" ){
            console.log("oke")
            $.ajax({
                url:  "<?=urls('manajemenAction')?>?aksi=create",
                type: "post",
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                data:fd,
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function(result){
                    NProgress.start();
                },
                success: function(data){
                    NProgress.done();
                    get();
                    if(data){
                        toastr["success"]("Berhasil menambah data.")
                        $("#form-berita").modal('hide');
                    }else{
                        toastr["error"]("Gagal menambah data.")
                    }

                    // id(result.)
                }
            });
        }
    }

    function approval(status,id){
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
        if (result.value) {
            var fd = new FormData();
            fd.append( 'id', id);
            fd.append( 'status', status==1?0:1);
            $.ajax({
                url: "<?=urls('manajemenAction')?>?aksi=approval",
                type: "post",
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                data:fd,
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function(result){
                    NProgress.start();HoldOn.open(optionsLoader);
                },
                success: function(data){
                    NProgress.done();HoldOn.close();
                    if(data){
                        Swal.fire(
                            'Berhasil',
                            status==0?'Berhasil non-aktifkan data':'Berhasil mengaktifkan data.',
                            'success'
                        )
                    }else{
                        Swal.fire(
                            'Gagal',
                            status==0?'Gagal non-aktifkan data':'Gagal mengaktifkan data.',
                            'error'
                        )
                    }
                    get();
                }
            });
            
        }
        })
    }
    
    function hapus(id){
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.value) {
            var fd = new FormData();
            fd.append( 'id', id);
            $.ajax({
                url: "<?=urls('manajemenAction')?>?aksi=delete",
                type: "post",
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                data:fd,
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function(result){
                    NProgress.start();HoldOn.open(optionsLoader);
                },
                success: function(data){
                    NProgress.done();HoldOn.close();
                    if(data){
                        $("#form-berita").modal('hide');
                        toastr["success"]("Berhasil menghapus data.")
                    }else{
                        toastr["error"]("Gagal menghapus data.")
                    }
                    get();
                }
            });
            
        }
        })
    }

    function detail(id){
        // $('.modal-body').html(id)
        $.ajax({
            url: "{{url('')}}/berita/detail/"+id, 
            beforeSend: function(result){
                NProgress.start();HoldOn.open(optionsLoader);
            },
            success: function(data){
                NProgress.done();HoldOn.close();
                const res = JSON.parse(data);
                if(res.status==='success'){
                    $('#berita-detail').modal('show');
                    const result = res.result;
                    $(".modal-title").html(result.title);
                    console.log(result.category)
                    $('#tanggal').html("Tanggal :"+result.created_at);
                    $('#posted').html("Oleh :"+result.penulis);
                    $('#desc').html(result.caption);
                    $('#category_detail').append(result.category);
                    $('#thumb').attr("src",result.picture);
                    // $(".modal-body").html(data);
                }else{
                    $('#berita-detail').modal('hide');
                    Swal.fire(
                        'Gagal',
                        res.msg,
                        'danger'
                    )
                }
                // id(result.)
            }
        });
    }

    function loadJabatan(){
        $('#jabatan').empty().append('<option value="0">Pilih Jabatan</option>');
        $.ajax({
                url: "<?=urls('jabatanAction')?>?aksi=get", 
                dataType: 'json',
                type: 'GET',
                success: function(response) {
                var array = response.data;
                    if (array != ''){
                        for (i in array) {
                            $("#jabatan").append("<option value="+array[i].id+">"+array[i].title+"</option>");
                        }

                    }

                },
                

        });
    }

</script>