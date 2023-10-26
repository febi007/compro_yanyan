
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
            $(".modal-title").html("Tambah Gallery");
            $("#judul").val('');
            $("#btn_hapus").hide();
            $("#btn_aktif").hide();
            $("#idItem").val('')
            $("#tipe").val('');
            $("#caption").val('');
            $('#preview').attr("src","#");
            $("#btn_simpan").text("Simpan")
        });
        $("#btn_aktif").click(function(event) {
            event.preventDefault();
            var status = $("#status").val();
            var id = $("#idItem").val();
            approve(status,id);
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
            url: "<?=urls('galleryAction')?>?aksi=get&page="+page+"&type="+kelas+search+sts,
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
                        $.each(result,function(key,item){
                            card+='<div class="col-md-4">'+
                                '<figure class="snip1477" onclick="update('+item.id+')">'+
                                    '<img src="'+item.image+'" style="background-position:center;background-repeat: no-repeat; background-size: auto;height:300px;width:100%;">'+
                                    '<div class="title">'+
                                        '<div>'+
                                            '<h3 style="color:white!important;">'+item.title+'</h3>'+
                                            (item.status==1?
                                            '<h4 style="font-size:.6em;text-align:left;margin-bottom:2px">Status: <span style="background:green;color:white">Aktif</span></h4>':'<h4 style="font-size:.6em;text-align:left;margin-bottom:2px">Status: <span style="background:red;color:white">Tidak Aktif</span></h4>'
                                            )+
                                            '<h4>'+(item.type==1?'Osis':(item.type==2?'Pramuka':item.type==3?'Ekstrakurikuler':(item.type==8?'Prestasi':'Kegiatan Lainnya')))+'</h4>'+
                                        '</div>'+
                                    '</div>'+
                                    '<figcaption>'+
                                        // '<p>'+item.deskripsi+'</p>'+
                                    '</figcaption>'+
                                    // '<a class="btn btn-success btn-custom waves-effect waves-light btn-xs" onclick="update(\''+item.id+'\')"><i class="fa fa-pencil"></i></a>'+
                                    '<a href="#"></a>'+
                                '</figure>'+
                            '</div>';

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
                    $("#gallery").html(card);
                }else{
                    card+="<div class='col-md-12'><div class='text-center'>Tidak ada data.</div></div>"
                }
                // id(result.)
            }
        });
    }

    function goInsert() {
        console.log("insert");

        let judul = $("#judul").val();
        let tipe = $("#tipe").val();
        // let link = $("#link").val();
        let caption = $("#caption").val();

        if(judul===""){$("#err-judul").css("display", "block");$("#err-judul").html("Kategori   produk tidak boleh kosong.")}
        if(caption===""){$("#err-caption").css("display", "block");$("#err-caption").html("Kategori   produk tidak boleh kosong.")}


        var fd =  new FormData();
        fd.append( 'title', judul);
        fd.append( 'type', tipe);
        fd.append( 'link', '-');
        fd.append( 'deskripsi',caption);
        // if ($('input[type=file]')[0].files.length !== 0) {
            fd.append( 'image', $('input[type=file]')[0].files[0])
        // }
        
        if(judul!=="" &&  caption!==""){
            console.log("oke")
            $.ajax({
                        url:  "<?=urls('galleryAction')?>?aksi=create",
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

    function update(id){
        // $('.modal-body').html(id)
        $("#btn_aktif").show();
        $("#btn_hapus").show();
        $.ajax({
            url:  "<?=urls('galleryAction')?>?aksi=detail&id="+id,
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
                    $("#caption").val(res.deskripsi);
                    $('#preview').attr("src",res.image);
                    if(res.status==1){
                        $("#btn_aktif").html('Non-aktifkan');
                    }else{
                        $("#btn_aktif").html('Aktifkan');
                    }

                    $("#idItem").val(res.id)
                    $("#status").val(res.status)
                    $('#tipe option[value='+res.type+']').attr('selected','selected');
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
        let tipe = $("#tipe").val();
        // let link = $("#link").val();
        let caption = $("#caption").val();

        if(judul===""){$("#err-judul").css("display", "block");$("#err-judul").html("Kategori   produk tidak boleh kosong.")}
        if(caption===""){$("#err-caption").css("display", "block");$("#err-caption").html("Kategori   produk tidak boleh kosong.")}


        var fd =  new FormData();
        fd.append( 'id', id);
        fd.append( 'title', judul);
        fd.append( 'type', tipe);
        fd.append( 'link', '-');
        fd.append( 'deskripsi', caption);
        if ($('input[type=file]')[0].files.length !== 0) {
            fd.append( 'image', $('input[type=file]')[0].files[0])
        }

        if(judul!=="" && tipe!==""){

            $.ajax({
                url:  "<?=urls('galleryAction')?>?aksi=update",
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
        Swal.fire({
            title: 'Anda yakin?',
            text: "Data yang sudah diubah tidak dapat kembali.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya.'
        }).then((result) => {
        if (result.value) {
            var fd = new FormData();
            fd.append('id',id);
            fd.append('status',status==1?0:1);
            $.ajax({
            url: "<?=urls('galleryAction')?>?aksi=approval",
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
                    $('#form-gallery').modal('hide');
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
            fd.append( 'id', $("#idItem").val());
            $.ajax({
                url: "<?=urls('galleryAction')?>?aksi=delete",
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
        get(1,null,sel.value)
    }

    function getval2(sel){
        // alert(sel.value);
        get(1,null,0,sel.value)
    }

</script>
