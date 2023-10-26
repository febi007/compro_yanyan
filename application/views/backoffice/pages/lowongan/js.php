
<script>
    var $pagination = $('.pagination');
    var defaultOpts = {
        totalPages: 20,
    };
    $(document).ready(function(){
        
        let searchParams = new URLSearchParams(window.location.search)
        if(searchParams.has('page')) get(searchParams.get('page'));
        else get(1);
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
            $("#tambah").on('click',function(event) {
                set_ckeditor('caption')
                event.preventDefault();
                
                // $("#form-berita").modal('show');
                $("#form-berita").modal();
                if(!$("#form-berita").parent().is('body')) $("#form-berita").appendTo("body");
                // $("#form-berita").appendTo("body");
                $(".modal-title").html("Tambah Lowongan Pekerjaan");
                $("#title").val("");
                CKEDITOR.instances['caption'].setData('');

                $("#file2").val("");
                $("#picture").val("");
                $("#caption").text("");
                $("#idItem").val("");
                $("#btn_simpan").text("Simpan")
                $("#notif-container").show();
                $('#preview').attr("src","");
            });

            $("#lihatSemua").on('click',function(event) {
                event.preventDefault();
                localStorage.removeItem('berita_cate')
                $(".list-group-item").removeClass("active");
                get(1);
            });
            
           
            $("#btn_simpan").click(function(event) {
                event.preventDefault();
                if($("#idItem").val()===""){
                    goInsert();
                }else{
                    goUpdate();
                }
            });

            $('#form-berita').on('hidden.bs.modal', function (e) {
            // do something when this modal window is closed...
                CKEDITOR.instances.editor.destroy();
            });

            
    });

    function get(page=1,q=null,cate=null,status=3){
        var search = q!==null?`&q=${q}`:'';
        var category = cate!==null?`&category=${cate}`:'';
        var category= cate!=null?`&category=${cate}`:(localStorage.getItem('berita_cate')!==null?`&category=${localStorage.getItem('berita_cate')}`:'');
        var sts = parseInt(status)!==3?`&status=${status}`:'';

        var pages= page!==1?`&page=${page}`:(localStorage.getItem('berita_page')?`&page=${localStorage.getItem('berita_page')}`:'&page=1');

        // if(cate) {$(".list-group-item").removeClass("active");$("#ID"+stringToHex(cate)).addClass("active");if(category!=null)localStorage.setItem('berita_cate',cate);}

        // if(localStorage.getItem('berita_cate')!=null||localStorage.getItem('berita_cate')!='') {$("#ID"+stringToHex(localStorage.getItem('berita_cate'))).addClass("active");console.log(localStorage.getItem('berita_cate'))}
        $.ajax({
            // pages+search+category,
            url: "<?=urls('beritaAction')?>?aksi=get&type=2"+pages+search+category+sts,
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
                                            '<li <?= (int)$this->session->grant_access!=1?'style="display:none"':''?>>'+
                                            '<li><a href="#" onClick="event.preventDefault();approval(\''+item.status+'\',\''+item.id+'\');" <?= (int)$this->session->grant_access!=1?'style="display:none"':''?>><i class="mdi mdi-account-check"></i> '+(item.status==0?'Aktifkan':'Non-Aktifkan')+'</a></li>'+'</li>'+
                                            '<li><a href="#" onClick="event.preventDefault();hapus(\''+item.id+'\');" <?= (int)$this->session->grant_access!=1?'style="display:none"':''?>><i class="mdi mdi-delete-forever"></i> Delete</a></li>'+
                                        '</ul></div></td>'+
                                '<td><img src="'+item.image+'" width="100px"/></td>'+
                                '<td>'+item.title+'</td>'+
                                '<td>'+item.content.replace(/(<([^>]+)>)/ig,"")+'</td>'+
                                '<td>'+item.nama+'</td>'+
                                '<td>'+(item.status=='1'?'<span class="label label-success">Aktif</span>':'<span class="label label-danger">Non-Aktif</span>')+'</td>'+
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
            url: "<?=urls('beritaAction')?>?aksi=detail&id="+id, 
            beforeSend: function(result){
                NProgress.start();
                HoldOn.open(optionsLoader);
            },
            success: function(data){
                NProgress.done();
                HoldOn.close();
                const res = JSON.parse(data);
                if(res){
                    $("#form-berita").modal();
                    if(!$("#form-berita").parent().is('body')) $("#form-berita").appendTo("body");
                    $(".modal-title").html("Update: "+res.title);
                    $("#title").val(res.title);
                    $("#idItem").val(res.id);
                    $("#btn_simpan").text("Update")
                    
                    $('#preview').attr("src",res.image);
                    CKEDITOR.instances['caption'].setData(res.content);
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
        let title=$("#title").val();
        let caption=CKEDITOR.instances['caption'].getData();
        console.log(caption);
        let tags=$("#tags").val();
        if(title===""){$("#err-title").css("display", "block");$("#err-title").html("Nama produk tidak boleh kosong.")}
        if(caption===""){$("#err-caption").css("display", "block");$("#err-caption").html("Deskripsi tidak boleh kosong.")}

        var fd =  new FormData();
        fd.append( 'id', id);
        fd.append( 'title', title);
        fd.append( 'id_category', 4);
        // fd.append( 'image', picture);
        if ($('input[type=file]')[0].files.length !== 0) {
            fd.append( 'image', $('input[type=file]')[0].files[0])
        }
        fd.append( 'content', caption);
        fd.append( 'type', 2);
        fd.append( 'tags', '-');

        if(title!=="" && caption!==""){
            $.ajax({
                url: "<?=urls('beritaAction')?>?aksi=update&id="+id, 
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
                    console.log(data);
                    get(1);
                    if(data){
                        toastr["success"]("Berhasil memperbaharui data.")
                        $("#form-berita").modal('hide');
                    }else{
                        toastr["error"]("Gagal memperbaharui data.")
                    }
                }
            });
        }
    }
    
    function goInsert() {
        console.log("insert");

        let title=$("#title").val();
        let caption=CKEDITOR.instances['caption'].getData();
        let picture=$("#file2").val();
        if(title===""){$("#err-title").css("display", "block");$("#err-title").html("Nama produk tidak boleh kosong.")}
        if(picture===""){$("#err-picture").css("display", "block");$("#err-picture").html("Gambar tidak boleh kosong.")}
        if(caption===""){$("#err-caption").css("display", "block");$("#err-caption").html("Deskripsi tidak boleh kosong.")}

        var fd =  new FormData();
        fd.append( 'title', title);
        fd.append( 'id_category', 0);
        // fd.append( 'image', picture);
        fd.append( 'image', $('input[type=file]')[0].files[0])
        fd.append( 'content', caption);
        fd.append( 'type', 2);
        fd.append( 'tags', '-');

        
        if(title!=="" &&  caption!==""){
            $.ajax({
                url:  "<?=urls('beritaAction')?>?aksi=create",
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
                    get(1);
                    if(data){
                        toastr["success"]("Berhasil menambah data.")
                        $("#form-berita").modal('hide');
                    }else{
                        toastr["error"]("Gagal menambah data.")
                    }
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
                url: "<?=urls('beritaAction')?>?aksi=approval",
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
                            '',
                            'success'
                        )
                    }else{
                        Swal.fire(
                            'Gagal',
                            '',
                            'error'
                        )
                    }
                    get(1);
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
                url: "<?=urls('beritaAction')?>?aksi=delete",
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
                    get(1);
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

    function loadCategory(){
        $('#category').empty().append('<option value="0">Pilih Kategori</option>');
        $.ajax({
                url: "<?=urls('categoryAction')?>?aksi=get", 
                dataType: 'json',
                type: 'GET',
                success: function(response) {
                var array = response.data;
                    if (array != ''){
                        for (i in array) {
                            $("#category").append("<option value="+array[i].id+">"+array[i].title+"</option>");
                        }

                    }

                },
                error: function(x, e) {

                }

        });
    }


   function getval(sel){
        // alert(sel.value);
        get(1,null,null,sel.value)
    }

</script>