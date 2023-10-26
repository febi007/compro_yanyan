
<script>
    var $pagination = $('.pagination');
    var defaultOpts = {
        totalPages: 20,
    };
    $(document).ready(function(){
        set_ckeditor('caption')

       get(2);
            $("#tambah").on('click',function(event) {
                event.preventDefault();
                console.log('object');
                goUpdate();
            });

            $("#btn_simpan").click(function(event) {
                event.preventDefault();
                if($("#idItem").val()===""){
                    goInsert();
                }else{
                    goUpdate();
                }
            });

            
    });

    function changeShow(that){
        set_ckeditor('caption')
        $("#gamar").show();

        $('#mgeneral').removeClass('active')
        $('#mdetail').removeClass('active')
        $('#mfaq').removeClass('active')
        $('#msejarah').removeClass('active')
        $('#mvm').removeClass('active')
        $('#mbl').removeClass('active')
        $('#mlh').removeClass('active')
        $('#mosis').removeClass('active')
        $('#mpramuka').removeClass('active')
        $('#mekstra').removeClass('active')
        $('#mprestasi').removeClass('active')
        // if($(that).attr('id')=='mgeneral') {
        //     $('.box-title').text($(that).text());
        //     get($(that).attr('data-id'))
        // }
        // if($(that).attr('id')=='mdetail') {
        //     $('.box-title').text($(that).text());
        //     get($(that).attr('data-id'))
        // }
        // if($(that).attr('id')=='mfaq') {
        //     $('.box-title').text($(that).text());
        //     get($(that).attr('data-id'))
        // }
        // if($(that).attr('id')=='msejarah') {
        //     $('.box-title').text($(that).text());
        //     get($(that).attr('data-id'))
        // }
        if($(that).attr('id')=='mvm') {
            $("#gamar").hide();
        }
        if($(that).attr('id')=='mekstra') {
            $("#gamar").hide();
        }
        if($(that).attr('id')=='mprestasi') {
            $("#gamar").hide();
        }
        // if($(that).attr('id')=='mbl') {
        //     $('.box-title').text($(that).text());
        //     get($(that).attr('data-id'))
        // }
        // if($(that).attr('id')=='mlh') {
            $('.box-title').text($(that).text());
            get($(that).attr('data-id'))

        $(that).addClass('active')
    }

    function get(id){
        $.ajax({
            url: "<?=urls('beritaAction')?>?aksi=detail&id="+id,
            beforeSend: function(result){
                NProgress.start();
                //HoldOn.open(optionsLoader);
            },
            success: function(data){
                NProgress.done();HoldOn.close();
                const res = JSON.parse(data);
                console.log(res);
                if(res){
                    $("#judul").val(res.title);
                    $("#caption").val(res.judul);
                    $("#idItem").val(res.id);
                    $('#preview').attr("src",res.image);
                    CKEDITOR.instances['caption'].setData(res.content);
                }else{
                   toastr["error"]("Gagal mengambil data.")

                }
            }
        });
    }

    function goUpdate(){
        let id=$("#idItem").val();
        let title=$("#judul").val();
        let caption=CKEDITOR.instances['caption'].getData();
        if(title===""){$("#err-title").css("display", "block");$("#err-title").html("Nama produk tidak boleh kosong.")}
        if(caption===""){$("#err-caption").css("display", "block");$("#err-caption").html("Deskripsi tidak boleh kosong.")}

        var fd =  new FormData();
        fd.append( 'id', id);
        fd.append( 'title', title);
        fd.append( 'id_category', 0);
        // fd.append( 'image', picture);
        if ($('input[type=file]')[0].files.length !== 0) {
            fd.append( 'image', $('input[type=file]')[0].files[0])
        }
        fd.append( 'content', caption);
        fd.append( 'type', 3);
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
                    console.log(id);
                    NProgress.done();HoldOn.close();
                    const res = data;
                    if(res){
                        $("#form-berita").modal('hide');
                        toastr["success"]("Berhasil memperbaharui data.")
                    }else{
                        toastr["error"]("Gagal memperbaharui data.")
                    }
                    get(id);

                    // id(result.)
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
                            if(data){
                                $("#form-berita").modal('hide');
                            toastr["success"]("Berhasil menambah data.")
                            }else{
                                toastr["error"]("Gagal menambah data.")
                            }
                            get();

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


</script>