
<script>
    var $pagination = $('.pagination');
    var defaultOpts = {
        totalPages: 20,
    };
    $(document).ready(function(){
        
        loadCategory();
        categorySide();
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
                $(".modal-title").html("Tambah Berita");
                $("#title").val("");
                CKEDITOR.instances['caption'].setData('');

                $("#file2").val("");
                $("#picture").val("");
                $("#caption").text("");
                $("#tags").val("");
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
                if($("#idItemKategori").val()===""){
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

    function get(page=1,q=null,cate=null,status=3){
        var search = q!==null?`&q=${q}`:'';
        var sts = parseInt(status)!==3?`&status=${status}`:'';
        var category= cate!==null?`&category=${cate}`:(localStorage.getItem('berita_cate')!==null?`&category=${localStorage.getItem('berita_cate')}`:'');
        var pages= page!==1?`&page=${page}`:(localStorage.getItem('berita_page')?`&page=${localStorage.getItem('berita_page')}`:'&page=1');

        // if(cate) {$(".list-group-item").removeClass("active");$("#ID"+stringToHex(cate)).addClass("active");if(category!=null)localStorage.setItem('berita_cate',cate);}

        // if(localStorage.getItem('berita_cate')!=null||localStorage.getItem('berita_cate')!='') {$("#ID"+stringToHex(localStorage.getItem('berita_cate'))).addClass("active");console.log(localStorage.getItem('berita_cate'))}
        $.ajax({
            // pages+search+category,
            url: "<?=urls('beritaAction')?>?aksi=get&type=1"+pages+search+category+sts,
            beforeSend: function(result){
                NProgress.start();
                //HoldOn.open(optionsLoader);
            },
            success: function(data){
                NProgress.done();
                //HoldOn.close();
                if(data.length!==0){
                    const result = JSON.parse(data);
                    let card=''
                    let pagination=''
                            $.each(result.data,function(key,item){
                                card+='<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">'+
                                        '<div class="single-article blog-content">'+
                                                '<div class="box-img article-img">'+
                                                    '<div class="thumb" style="background-image: url(\''+item.image+'\'); background-size: cover; background-position: center center;height:180px"></div>'+
                                                '</div>'+
                                            '<div class="single-desc">'+
                                                '<div class="row">'+
                                                    '<div class="col-md-9">'+
                                                        '<a class="label label-primary" style="font-weight:600">'+
                                                                item.category+
                                                        '</a> '+
                                                        (item.status===0?
                                                        '<a class="label label-danger"  style="font-weight:600">Tidak Aktif</a>':'<a class="label label-success" style="font-weight:600">Aktif</a>')+
                                                        '<h1 class="single-title" style="margin-top:5px;margin-bottom:2px;font-size:1.1em">'+(item.title.length>20?item.title.slice(0,20)+'...':item.title)+'</h1>'+
                                                    '</div>'+
                                                    '<div class="col-md-3">'+
                                                    ' <div class="btn-group float-right">'+
                                                        '<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
                                                        '<span class="caret"></span>'+
                                                    ' </button>'+
                                                        '<ul class="dropdown-menu">'+
                                                            '<li><a target="_blank" href="<?=base_url()?>detail?type=berita&title='+item.slug+'"><i class="fa fa-eye"></i> Detail</a></li>'+
                                                            '<li><a href="#" onclick="update(\''+item.id+'\')"><i class="fa fa-edit"></i> Update</a></li>'+
                                                            '<li <?= (int)$this->session->grant_access!=1?'style="display:none"':''?>>'+
                                                            (item.status===0?'<li  <?= (int)$this->session->grant_access!=1?'style="display:none"':''?>><a href="#"  onclick="approval(\''+item.id+'\',\'1\')"><i class="fa fa-check"></i> Aktifkan</a></li>':'<li  <?= (int)$this->session->grant_access!=1?'style="display:none"':''?>><a href="#"  onclick="approval(\''+item.id+'\',\'0\')"><i class="fa fa-close"></i> Non-Aktifkan</a></li>')+
                                                            '</li>'+
                                                            '<li><a href="#" onclick="hapus(\''+item.id+'\')"><i class="fa fa-trash"></i> Hapus</a></li>'+
                                                        '</ul>'+
                                                        '</div>'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div style="font-weight:100;font-size:.8em">'+
                                                'Oleh: '+item.nama+
                                                '<br>Jumlah like: '+item.likes+
                                                '</div>'+
                                                '<p>'+(item.content.length>80?item.content.slice(0,80).replace(/(<([^>]+)>)/ig,"")+'...':item.content.replace(/(<([^>]+)>)/ig,""))+
                                                '</p>'+
                                                '</div></div></div>';
                            })
                        var totalPages = result.last_page;
                        var currentPage = result.current_page;
                        $pagination.twbsPagination('destroy');
                        $pagination.twbsPagination($.extend({}, defaultOpts, {
                            startPage: currentPage,
                            totalPages: totalPages
                        })).on('page', function (evt, page) {
                            console.log(page);
                            localStorage.setItem('berita_page',page);
                            get(page)
                        });
                        $("#berita").html(card);
                    }else{
                        $("#berita").html('<div style="text-align:center">Tidak ada data.</div>');
                    }
                // id(result.)
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
                // HoldOn.open(optionsLoader);
            },
            success: function(data){
                NProgress.done();
                // HoldOn.close();
                const res = JSON.parse(data);
                if(res){
                    $("#form-berita").modal();
                    if(!$("#form-berita").parent().is('body')) $("#form-berita").appendTo("body");
                    $(".modal-title").html("Update: "+res.title);
                    $("#title").val(res.title);
                    $("#idItem").val(res.id);
                    $("#tags").val(res.tags);
                    $("#btn_simpan").text("Update")
                    $('#category option[value='+res.id_category+']').attr('selected','selected');
                    
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
        let category=$("#category").val();
        let tags=$("#tags").val();
        if(title===""){$("#err-title").css("display", "block");$("#err-title").html("Nama produk tidak boleh kosong.")}
        if(category===""){$("#err-category").css("display", "block");$("#err-category").html("Kategori   produk tidak boleh kosong.")}
        if(caption===""){$("#err-caption").css("display", "block");$("#err-caption").html("Deskripsi tidak boleh kosong.")}

        var fd =  new FormData();
        fd.append( 'id', id);
        fd.append( 'title', title);
        fd.append( 'id_category', category);
        // fd.append( 'image', picture);
        if ($('input[type=file]')[0].files.length !== 0) {
            fd.append( 'image', $('input[type=file]')[0].files[0])
        }
        fd.append( 'content', caption);
        fd.append( 'tags', tags);
        fd.append( 'type', 1);

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

        let title=$("#title").val();
        let caption=CKEDITOR.instances['caption'].getData();
        console.log(caption);
        let category=$("#category").val();
        let tags=$("#tags").val();
        let picture=$("#file2").val();
        if(title===""){$("#err-title").css("display", "block");$("#err-title").html("Nama produk tidak boleh kosong.")}
        if(category===""){$("#err-category").css("display", "block");$("#err-category").html("Kategori   produk tidak boleh kosong.")}
        if(picture===""){$("#err-picture").css("display", "block");$("#err-picture").html("Gambar tidak boleh kosong.")}
        if(caption===""){$("#err-caption").css("display", "block");$("#err-caption").html("Deskripsi tidak boleh kosong.")}

        var fd =  new FormData();
        fd.append( 'title', title);
        fd.append( 'id_category', category);
        // fd.append( 'image', picture);
        fd.append( 'image', $('input[type=file]')[0].files[0])
        fd.append( 'content', caption);
        fd.append( 'tags', tags);
        fd.append( 'type', 1);

        
        if(title!=="" &&  caption!=="" && category>0){
            console.log("oke")
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

    function approval(id,status){
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
                fd.append( 'status', status);
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
                                status===0?'Berhasil non-aktifkan data':'Berhasil mengaktifkan data.',
                                'success'
                            )
                        }else{
                            Swal.fire(
                                'Gagal',
                                status===0?'Gagal non-aktifkan data':'Gagal mengaktifkan data.',
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
                url: "<?=urls('beritaAction')?>/berita/delete?aksi=delete",
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
                            'Info',
                            'Data berhasil dihapus',
                            'success'
                        )
                    }else{
                        Swal.fire(
                            'Kesalahan',
                            'Data gagal dihapus!',
                            'error'
                        )
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


    function goInsertCategory() {
        console.log("insert");

        let title=$("#titleKategori").val();
        // let caption=CKEDITOR.instances.captionKategori.getData();
        if(title===""){$("#err-title-kategori").css("display", "block");$("#err-title-kategori").html("Nama kategori tidak boleh kosong.")}
        // if(caption===""){$("#err-caption-kategori").css("display", "block");$("#err-caption-kategori").html("Deskripsi tidak boleh kosong.")}
        var fd = new FormData();
        fd.append( 'title', title);
        // fd.append( 'captionKategori', caption);
       
        if(title!==""){
            console.log("oke");
            console.log(title);
            $.ajax({
                url: "<?=urls('categoryAction')?>?aksi=create",
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
                    if(res){
                        $("#form-kategori").modal('hide');
                        toastr["success"]("Berhasil menambah kategori.")
                    }else{
                        toastr["error"]("Gagal menambah kategori.")
                    }
                    categorySide();

                    // id(result.)
                }
            });
        }
    }

    function goUpdateCategory(){
        let title=$("#titleKategori").val();
        let id=$("#idItemKategori").val();

        if(title===""){$("#err-title").css("display", "block");$("#err-title").html("Nama produk tidak boleh kosong.")}

        var fd = new FormData();
        fd.append( 'id', id);
        fd.append( 'title', title);

        if(title!==""){
            $.ajax({
                url: "<?=urls('categoryAction')?>?aksi=update",
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
                    if(res){
                        $("#form-kategori").modal('hide');
                        toastr["success"]("Berhasil merubah kategori.")
                    }else{
                        toastr["error"]("Gagal merubah kategori.")
                    }
                    categorySide();

                    // id(result.)
                }
            });
        }
    }
    
    function updateCategory(id){
        // alert(id);
        // $('.modal-body').html(id)
        $("#notif-container").hide();
        $.ajax({
            url: "<?=urls('categoryAction')?>?aksi=detail&id="+id,
            beforeSend: function(result){
                NProgress.start();HoldOn.open(optionsLoader);
            },
            success: function(data){
                NProgress.done();HoldOn.close();
                const res = JSON.parse(data);
                if(res){
                   $("#form-kategori").modal();
                    if(!$("#form-kategori").parent().is('body')) $("#form-kategori").appendTo("body");
                    $("#titleKategori").val(res.title);
                    $("#idItemKategori").val(res.id);
                    // $(".modal-body").html(data);
                }else{
                    $('#form-kategori').modal('hide');
                    toastr["error"]("Gagal merubah kategori.")
                    
                }
                // id(result.)
            }
        });
    }

    function hapusCategory(id){
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
                url: "<?=urls('categoryAction')?>?aksi=delete",
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
                            'Berhail menghapus data.',
                            'success'
                        )
                    }else{
                        Swal.fire(
                            'Gagal',
                            'Gagal menghapus data.',
                            'error'
                        )
                    }
                    categorySide();
                }
            });
            
        }
        })
    }

    function categorySide(){
        $('#kategori_side').html('');
        $.ajax({
                url: "<?=urls('categoryAction')?>?aksi=get", 
                dataType: 'json',
                type: 'GET',
                success: function(response) {
                    var array = response.data;
                    console.log(array);
                    var html = '';
                        for (i in array) {
                            html+="<li class='list-group-item' id='ID"+stringToHex(array[i].title)+"'>";
                            html+="<div class='row'>"
                            html+="<div class='col-md-8' style='cursor:pointer' onClick='event.preventDefault();get(1,null,\""+array[i].id+"\");'>"
                            html+="<span>"+array[i].title+"</span>";
                            html+="</div>"
                            <?php if( (int)$this->session->grant_access!=0):?>
                            html+="<div class='col-md-4' style='margin:0;padding:0;'>"
                            html+='<a class="label label-success label-custom waves-effect waves-light label-xs" onclick="updateCategory(\''+array[i].id+'\')">'+
                                '<i class="fa fa-pencil"></i>'+
                            '</a> ';
                            html+='<a class="label label-danger label-custom waves-effect waves-light label-xs" onclick="hapusCategory(\''+array[i].id+'\')">'+
                                '<i class="fa fa-trash"></i>'+
                            '</a> ';
                            html+="</div>"
                            <?php endif?>
                            html+="</div>"
                            html+="</li>";
                        }
                        $('#kategori_side').html(html);
                },
                error: function(x, e) {}

            });
    }

    function stringToHex (tmp) {
        var str = '',
            i = 0,
            tmp_len = tmp.length,
            c;
    
        for (; i < tmp_len; i += 1) {
            c = tmp.charCodeAt(i);
            str += d2h(c);
        }
        return str;
    }

    function d2h(d) {
        return d.toString(16);
    }

    function max_width() {
        w_max = 0;
            jQuery('.binary-genealogy-tree').each(function () {
                max_w_ele = jQuery(this).find('.last_level_user').parent().parent().width();
                n = jQuery(this).find('.last_level_user').length;
                max_w = max_w_ele * n;
                if (w_max < max_w) {
                w_max = max_w;
                }
            });
        return w_max;
        }

    function getval(sel){
        // alert(sel.value);
        get(1,null,null,sel.value)
    }


</script>