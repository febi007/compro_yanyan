
<script>
    var $pagination = $('.pagination');
    var defaultOpts = {
        totalPages: 20,
    };
    $(document).ready(function(){
        get();
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

    function get(){
        $.ajax({
            url: "<?=urls('settingAction')?>?aksi=detail",
            beforeSend: function(result){
                NProgress.start();
                //HoldOn.open(optionsLoader);
            },
            success: function(data){
                NProgress.done();HoldOn.close();
                const res = JSON.parse(data);
                console.log(res);
                if(res){
                    $("#site_title").val(res.site_title);
                    $("#email").val(res.email);
                    $("#telp").val(res.telp);
                    $("#fax").val(res.fax);
                    $("#alamat").val(res.address);
                    $("#facebook").val(res.facebook);
                    $("#twitter").val(res.twitter);
                    $("#instagram").val(res.instagram);
                    $("#video_footer").val(atob(res.video_footer));
                }else{
                   toastr["error"]("Gagal mengambil data.")

                }
            }
        });
    }

    function goUpdate(){
        var fd =  new FormData();
        fd.append( 'site_title',$("#site_title").val())
        fd.append( 'email',$("#email").val())
        fd.append( 'telp',$("#telp").val())
        fd.append( 'fax',$("#fax").val())
        fd.append( 'address', $("#alamat").val())
        fd.append( 'facebook',$("#facebook").val())
        fd.append( 'twitter', $("#twitter").val())
        fd.append( 'instagram',$("#instagram").val())
        fd.append( 'video_footer',btoa($("#video_footer").val()))
            $.ajax({
                url: "<?=urls('settingAction')?>?aksi=update", 
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
                        toastr["success"]("Berhasil memperbaharui data.")
                    }else{
                        toastr["error"]("Gagal memperbaharui data.")
                    }
                    get();

                    // id(result.)
                }
            });
    }
    
</script>