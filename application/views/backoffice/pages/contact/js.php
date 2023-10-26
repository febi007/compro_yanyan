
<script>
    $(document).ready(function(){
        let searchParams = new URLSearchParams(window.location.search)
        if(searchParams.has('page')) get(searchParams.get('page'));
        else get();

        $("#tambah").on('click',function(event) {
            event.preventDefault();
            // $("#form-berita").modal('show');
            $("#form-user").modal();
            if(!$("#form-user").parent().is('body')) $("#form-user").appendTo("body");
            // $("#form-user").appendTo("body");
            $(".modal-title").html("Tambah Kelas");
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

    function get(page=1,q=null,kelas=0){
        var search = q!==null?`&q=${q}`:'';
        $.ajax({
            url: "<?=urls('contactAction')?>?aksi=get&page="+page+"&jurusan="+kelas+search,
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
                    let pagination='';
                    let page=1;
                        $.each(result,function(key,item){
                            card+='<tr>'+
                                '<td>'+page+'</td>'+
                                '<td>'+item.nama+'</td>'+
                                '<td>'+item.email+'</td>'+
                                '<td>'+item.pesan+'</td>'+
                                '<td>'+item.created_at+'</td>'+
                                '<td><a href="#" class="btn btn-danger btn-sm" onclick="hapus(\''+item.id+'\')"><i class="fa fa-trash"/></a></td>'+ 
                                '<td>';
                            card+='</td>'+
                            '</tr>';
                            page+=1;

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
        let jurusan   = $("#jurusan").val();
        if(nama===""){$("#err-nama").css("display", "block");$("#err-nama").html("Kategori   produk tidak boleh kosong.")}
        if(jurusan===""){$("#jurusan-nis").css("display", "block");$("#jurusan-nis").html("Gambar tidak boleh kosong.")}

        var fd =  new FormData();
        fd.append( 'nama', nama);
        fd.append( 'id_jurusan', jurusan);

        
        if(nama!=="" &&  jurusan!==""){
            console.log("oke")
            $.ajax({
                        url:  "<?=urls('contactAction')?>?aksi=create",
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

    function update(id){
        // $('.modal-body').html(id)
        $.ajax({
            url:  "<?=urls('contactAction')?>?aksi=detail&id="+id,
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
                    $('#jurusan option[value='+res.id_jurusan+']').attr('selected','selected');

                    $("#btn_simpan").text("Update")

                    // $(".modal-body").html(data);
                }else{
                    $('#form-user').modal('hide');
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

        let id = $("#idItem").val();
        let nama = $("#nama").val();
        let jurusan   = $("#jurusan").val();
        if(nama===""){$("#err-nama").css("display", "block");$("#err-nama").html("Kategori   produk tidak boleh kosong.")}
        if(jurusan===""){$("#jurusan-nis").css("display", "block");$("#jurusan-nis").html("Gambar tidak boleh kosong.")}

        var fd =  new FormData();
        fd.append( 'id', id);
        fd.append( 'nama', nama);
        fd.append( 'id_jurusan', jurusan);

        
        if(nama!=="" &&  jurusan!==""){

            $.ajax({
                url:  "<?=urls('contactAction')?>?aksi=update",
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
            url: "<?=urls('contactAction')?>?aksi=approval",
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
                url: "<?=urls('contactAction')?>?aksi=delete",
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

    function loadCategory(){
        $('#jurusan').empty().append('<option value="0">Pilih jurusan</option>');
        $('#jurusanfilter').empty().append('<option value="0">Semua</option>');
        $.ajax({
                url: "<?=urls('jurusanAction')?>?aksi=get", 
                dataType: 'json',
                type: 'GET',
                success: function(response) {
                var array = response.data;
                    if (array != ''){
                        for (i in array) {
                            $("#jurusan").append("<option value="+array[i].id+">"+array[i].title+"</option>");
                            $("#jurusanfilter").append("<option value="+array[i].id+">"+array[i].title+"</option>");
                        }

                    }

                },
                error: function(x, e) {

                }

        });
    }

    function getval(sel){
        // alert(sel.value);
        get(1,null,sel.value)
    }

</script>
