
<script>
    $(document).ready(function(){
        let searchParams = new URLSearchParams(window.location.search)
        if(searchParams.has('page')) get(searchParams.get('page'));
        else get();

        $("#tambah").on('click',function(event) {
            event.preventDefault();
            // $("#form-berita").modal('show');
            $("#form-gallery").modal();
            if(!$("#form-gallery").parent().is('body')) $("#form-gallery").appendTo("body");
            // $("#form-gallery").appendTo("body");
            $(".modal-title").html("Tambah Files");
            $("#judul").val('');
            $("#idItem").val('')
            $("#tipe").val('');
            // $("#caption").val('');
            $('#preview').attr("src","#");
            $("#btn_hapus").hide();
            $("#btn_simpan").text("Simpan")
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
                if($("#idItem").val()==""){
                    console.log("btn_simpan");
                    goInsert();
                }else{
                    goUpdate();
                }
            });

    });

    function get(page=1,q=null,kelas=0,status=3){
        var search = q!==null?`&q=${q}`:'';
        var sts = parseInt(status)!==3?`&status=${status}`:'';
        $.ajax({
            url: "<?=urls('filesAction')?>?aksi=get&type=9&page="+page+search+sts,
            beforeSend: function(result){
                NProgress.start();HoldOn.open(optionsLoader);
            },
            success: function(data){
                NProgress.done();HoldOn.close();
                const res = JSON.parse(data);
                if(data.length>0){
                    // const result = data.result;
                    const result = res.data;
                    let card=''
                    let pagination=''
                    let no=1;
                        $.each(result,function(key,item){
                            card+='<tr>'+
                                '<td>'+no+'</td>'+
                                '<td>'+item.title+'</td>'+
                                '<td><a href="'+item.link+'" target="_blank">'+item.link+'</a></td>'+  
                                '<td>'+(item.status==1?'<span class="label label-success">Aktif</span>':'<span class="label label-danger">Non-Aktif</span>')+'</td>'+
                                '<td>'+item.hits+'</td>'+  
                                '<td>'+item.created_at+'</td>'+  
                                '<td>'+
                                '<span <?= (int)$this->session->grant_access!=1?'style="display:none"':''?>>'+
                                    (item.status==1?'<a href="#" class="label label-warning" onclick="approve(\''+item.status+'\',\''+item.id+'\')" title="Non-aktifkan" <?= (int)$this->session->grant_access!=1?'style="display:none"':''?>><i class="fa fa-remove"></i></a> ':'<a href="#" class="label label-info" onclick="approve(\''+item.status+'\',\''+item.id+'\')" title="Aktifkan" <?= (int)$this->session->grant_access!=1?'style="display:none"':''?>><i class="fa fa-check"></i></a> ')+
                                '</span>'
                                +'<a href="#" class="label label-danger" onclick="hapus(\''+item.id+'\')" title="Hapus"><i class="fa fa-trash"></i></a>'+
                                '</td>'+  
                            '</tr>';
                            no++;

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
                    $("#tbl_partnership").html(card);
                }else{
                    card+="<div class='col-md-12'><div class='text-center'>Tidak ada data.</div></div>"
                }
                // id(result.)
            }
        });
    }

    function goInsert() {
        console.log("insert");

        let title = $("#title").val();
        let status = $("#status").val();
        // let link = $("#link").val();
        // let caption = $("#caption").val();

        if(title===""){$("#err-title").css("display", "block");$("#err-title").html("Kategori   produk tidak boleh kosong.")}

        var fd =  new FormData();
        fd.append( 'title', title);
        fd.append( 'status', status);
        // if ($('input[type=file]')[0].files.length !== 0) {
            fd.append( 'fileupload', $('input[type=file]')[0].files[0])
        // }
        
        if(title!=="" ){
            console.log("oke")
            $.ajax({
                        url:  "<?=urls('filesAction')?>?aksi=create",
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
                                toastr["success"]("Berhasil menambah data.")
                            }else{
                                toastr["error"]("Gagal upload file. File yang didukung: pdf | ppt | pptx | xlsx | xls | doc | docx | ppt | pptx | zip")
                            }
                            $("#form-gallery").modal('hide');

                            get();

                    // id(result.)
                        }
                    });
                }
    }

    function update(id){
        // $('.modal-body').html(id)
        $.ajax({
            url:  "<?=urls('filesAction')?>?aksi=detail&id="+id,
            beforeSend: function(result){
                NProgress.start();HoldOn.open(optionsLoader);
            },
            success: function(data){
                NProgress.done();HoldOn.close();
                const res = JSON.parse(data);
                if(res){
                    $("#form-gallery").modal();
                    if(!$("#form-gallery").parent().is('body')) $("#form-gallery").appendTo("body");
                    const result = res;
                    $(".modal-title").html("Update: "+result.title);
                    $("#judul").val(res.title);
                    // $("#caption").val(res.deskripsi);
                    $('#preview').attr("src",res.image);
                    $("#idItem").val(res.id)
                    // $('#tipe option[value='+res.type+']').attr('selected','selected');
                    $("#btn_simpan").text("Update")

                    // $(".modal-body").html(data);
                }else{
                    $('#form-gallery').modal('hide');
                    Swal.fire(
                        'Gagal',
                        'Gagal mengambil data.',
                        'danger'
                    )
                }
                // id(result.)
            }
        });
    }

    function goUpdate(){

        let id = $("#idItem").val();
        let judul = $("#judul").val();
        // let tipe = $("#tipe").val();
        // let link = $("#link").val();
        // let caption = $("#caption").val();

        if(judul===""){$("#err-judul").css("display", "block");$("#err-judul").html("Kategori   produk tidak boleh kosong.")}


        var fd =  new FormData();
        fd.append( 'id', id);
        d.append( 'title', judul);
        fd.append( 'type', 9);
        fd.append( 'link', '-');
        fd.append( 'deskripsi', '-');
        // if ($('input[type=file]')[0].files.length !== 0) {
        if ($('input[type=file]')[0].files.length !== 0) {
            fd.append( 'image', $('input[type=file]')[0].files[0])
        }

        if(judul!=="" && id!==""){

            $.ajax({
                url:  "<?=urls('filesAction')?>?aksi=update",
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
                        $("#form-gallery").modal('hide');
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

    function approve(status,id){
        var sts = status ===1?'Terima!':'Tolak!'
        Swal.fire({
            title: 'Anda yakin?',
            text: "Data yang sudah diubah tidak dapat kembali.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, '+sts+'.'
        }).then((result) => {
        if (result.value) {
            var fd = new FormData();
            fd.append('id',id);
            fd.append('status',status==1?0:1);
            $.ajax({
            url: "<?=urls('filesAction')?>?aksi=approval",
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
                            status==1?'Berhasil non-aktifkan data':'Berhasil mengaktifkan data.',
                            'success'
                        )
                    }else{
                        Swal.fire(
                            'Gagal',
                            status==1?'Gagal non-aktifkan data':'Gagal mengaktifkan data.',
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
                url: "<?=urls('filesAction')?>?aksi=delete",
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
                        $("#form-gallery").modal('hide');
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


    function getval(sel){
        // alert(sel.value);
        get(1,null,0,sel.value)
    }

</script>
