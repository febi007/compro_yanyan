
<script>
    $(document).ready(function(){
        let searchParams = new URLSearchParams(window.location.search)
        if(searchParams.has('page')) get(searchParams.get('page'));
        else get();
        loadCategory();

        $("#tambah").on('click',function(event) {
            event.preventDefault();
            // $("#form-berita").modal('show');
            $("#form-user").modal();
            if(!$("#form-user").parent().is('body')) $("#form-user").appendTo("body");
            // $("#form-user").appendTo("body");
            $(".modal-title").html("Tambah Level");
            $("#title").val("");
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

    function get(page=1,q=null){
        var search = q!==null?`&q=${q}`:'';
        $.ajax({
            url: "<?=urls('userLevelAction')?>?aksi=get",
            beforeSend: function(result){
                NProgress.start();HoldOn.open(optionsLoader);
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
                                            '<li><a href="#" onClick="event.preventDefault();approve(\''+item.status+'\',\''+item.id+'\');"><i class="mdi mdi-account-check"></i> '+(item.status===0?'Aktifkan':'Non-Aktifkan')+'</a></li>'+
                                            // '<li><a href="#" onClick="event.preventDefault();hapus(\''+item.id+'\');"><i class="mdi mdi-delete-forever"></i> Delete</a></li>'+
                                        '</ul></div></td>'+
                                '<td>'+item.title+'</td>'+
                                '<td>'+(item.grant_access==1?'Dengan Akses Penuh':'Tanpa Akses Penuh')+'</td>'+
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
                    $("#tbl_user").html(card);
                }else{
                    card+="<div class='col-md-12'><div class='text-center'>Tidak ada data.</div></div>"
                }
                // id(result.)
            }
        });
    }

    function goInsert() {
        console.log("insert");

        let nama = $("#nama").val();
        let username = $("#username").val();
        let password = $("#password").val();
        let level = $("#level").val();
        let status = $("#status").val();
        if(nama===""){$("#err-nama").css("display", "block");$("#err-nama").html("Kategori   produk tidak boleh kosong.")}
        if(username===""){$("#err-username").css("display", "block");$("#err-username").html("Gambar tidak boleh kosong.")}
        if(password===""){$("#err-password").css("display", "block");$("#err-password").html("Deskripsi tidak boleh kosong.")}

        var fd =  new FormData();
        fd.append( 'nama', nama);
        fd.append( 'username', username);
        fd.append( 'password', password)
        fd.append( 'level', level);
        fd.append( 'status', status);

        
        if(nama!=="" &&  username!=="" && password!==""){
            console.log("oke")
            $.ajax({
                        url:  "<?=urls('userLevelAction')?>?aksi=create",
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
                                $("#form-user").modal('hide');
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
        $.ajax({
            url:  "<?=urls('userLevelAction')?>?aksi=detail&id="+id,
            beforeSend: function(result){
                NProgress.start();HoldOn.open(optionsLoader);
            },
            success: function(data){
                NProgress.done();HoldOn.close();
                const res = JSON.parse(data);
                if(res){
                    $("#form-user").modal();
                    if(!$("#form-user").parent().is('body')) $("#form-user").appendTo("body");
                    const result = res;
                    $(".modal-title").html("Update: "+result.nama);
                    $("#nama").val(result.name);
                    $("#idItem").val(result.id);
                    $("#nama").val(result.nama);
                    $("#username").val(result.username);
                    $('#level option[value='+res.id_level+']').attr('selected','selected');
                    $('#status option[value='+res.status+']').attr('selected','selected');

                    $("#btn_simpan").text("Update")

                    // $(".modal-body").html(data);
                }else{
                    $('#form-testimoni').modal('hide');
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

    function goUpdate(){

        let nama = $("#nama").val();
        let username = $("#username").val();
        let password = $("#password").val();
        let level = $("#level").val();
        let id = $("#idItem").val();
        let status = $("#status").val();
        if(nama===""){$("#err-nama").css("display", "block");$("#err-nama").html("Kategori   produk tidak boleh kosong.")}
        if(username===""){$("#err-username").css("display", "block");$("#err-username").html("Gambar tidak boleh kosong.")}

        var fd =  new FormData();
        fd.append( 'id', id);
        fd.append( 'nama', nama);
        fd.append( 'username', username);
        fd.append( 'password', password)
        fd.append( 'level', level);
        fd.append( 'status', status);


        if(nama!=="" && username!==""){
                    console.log("update");

            $.ajax({
                url:  "<?=urls('userLevelAction')?>?aksi=update",
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
                        $("#form-user").modal('hide');
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
            url: "<?=urls('userLevelAction')?>?aksi=approval",
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

    function loadCategory(){
        $('#level').empty().append('<option value="0">Pilih Level</option>');
        $.ajax({
                url: "<?=urls('UserLevelAction')?>?aksi=get", 
                dataType: 'json',
                type: 'GET',
                success: function(response) {
                var array = response.data;
                    if (array != ''){
                        for (i in array) {
                            $("#level").append("<option value="+array[i].id+">"+array[i].title+"</option>");
                        }

                    }

                },
                error: function(x, e) {

                }

        });
    }

</script>
