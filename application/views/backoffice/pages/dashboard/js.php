<script>
    $(document).ready(function(){
        get();
        getberita();
        getlowongan();
        getGallery();
        getPartnership();
    })

    function get(){
        $.ajax({
            url: "<?=urls('home')?>",
            beforeSend: function(result){
                NProgress.start();HoldOn.open(optionsLoader);
            },
            success: function(data){
                NProgress.done();HoldOn.close();
                const res = JSON.parse(data);
                 Morris.Bar({
                    element: 'morris-pengunjung',
                    behaveLikeLine: true,
                    data: res.chart,
                    barColors: function (row, series, type) {
                        if (row.label == 'SENIN') {
                            return 'yellow';
                        }
                        if (row.label == 'SELASA') {
                            return 'green';
                        }
                        if (row.label == 'RABU') {
                            return '#ea65a2';
                        }
                        if (row.label == 'KAMIS') {
                            return '#fcb03b';
                        }
                        if (row.label == 'JUMAT') {
                            return 'red';
                        }
                        if (row.label == 'SABTU') {
                            return '#566FC9';
                        }
                        if (row.label == 'MINGGU') {
                            return 'blue';
                        }
                    },
                    xkey: 'x',
                    ykeys: ['y'],
                    labels: ['Kunjungan']
                });
                Morris.Donut({
                    element: 'donut-morris-chart',
                    data: res.donut,
                    colors: [
                        '#fcb03b',
                        '#ea65a2',
                        '#566FC9'
                    ],
                    resize: true,
                    labelColor: '#2f2c2c',
                    formatter: function (x) { return x + "%"}
                });
                // id(result.)
            }
        });
    }

    function getberita(page=1){
        $.ajax({
            // pages+search+category,
            url: "<?=urls('beritaAction')?>?aksi=get&type=1&page="+page,
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
                    let no=1;
                    $.each(result.data,function(key,item){
                        card+='<tr>'+
                                '<td>'+no+'</td>'+
                                '<td><img src="'+item.image+'" width="50px"/></td>'+
                                '<td>'+item.title+'</td>'+
                                '<td>'+item.nama+'</td>'+
                                '<td>'+item.content.replace(/<[^>]*>?/gm, '').slice(0,80)+'</td>'+
                                '<td>'+(item.status==0?'<a class="label label-danger"  style="font-weight:600">Tidak Aktif</a>':'<a class="label label-success" style="font-weight:600">Aktif</a>')+'</td>'+
                                '<td>'+item.created_at+'</td>'+
                            '</tr>';
                        no+=1;
                    })
                    $("#berita").html(card);
                }else{
                    $("#berita").html('<div style="text-align:center">Tidak ada data.</div>');
                }
                // id(result.)
            }
        });
    }

    function getlowongan(page=1){
        $.ajax({
            // pages+search+category,
            url: "<?=urls('beritaAction')?>?aksi=get&type=2&page="+page,
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
                    let no=1;
                    $.each(result.data,function(key,item){
                        card+='<tr>'+
                                '<td>'+no+'</td>'+
                                '<td><img src="'+item.image+'" width="50px"/></td>'+
                                '<td>'+item.title+'</td>'+
                                '<td>'+item.nama+'</td>'+
                                '<td>'+item.content.replace(/<[^>]*>?/gm, '').slice(0,80)+'</td>'+
                                '<td>'+(item.status==0?'<a class="label label-danger"  style="font-weight:600">Tidak Aktif</a>':'<a class="label label-success" style="font-weight:600">Aktif</a>')+'</td>'+
                                '<td>'+item.created_at+'</td>'+
                            '</tr>';
                        no+=1;
                    })
                    $("#lowongan").html(card);
                }else{
                    $("#lowongan").html('<div style="text-align:center">Tidak ada data.</div>');
                }
                // id(result.)
            }
        });
    }

    function getGallery(page=1,q=null,kelas=0){

        $.ajax({
            url: "<?=urls('galleryAction')?>?aksi=get&page="+page+"&type="+kelas,
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
                            card+='<tr>'+
                                    '<td><img src="'+item.image+'" width="100px"/></td>'+
                                    '<td>'+item.title+'</td>'+
                                    '<td>'+(item.status==0?'<a class="label label-danger"  style="font-weight:600">Tidak Aktif</a>':'<a class="label label-success" style="font-weight:600">Aktif</a>')+'</td>'+
                                    '<td>'+item.created_at+'</td>'+
                                '</tr>'

                        })
                    $("#gallery").html(card);
                }else{
                    $("#gallery").html("<div class='col-md-12'><div class='text-center'>Tidak ada data.</div></div>");

                }
                // id(result.)
            }
        });
    }

    function getPartnership(page=1,q=null,kelas=0){

        $.ajax({
            url: "<?=urls('galleryAction')?>?aksi=get&page="+page+"&type=9",
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
                            card+='<tr>'+
                                    '<td><img src="'+item.image+'" width="100px"/></td>'+
                                    '<td>'+item.title+'</td>'+
                                    '<td>'+(item.status==0?'<a class="label label-danger"  style="font-weight:600">Tidak Aktif</a>':'<a class="label label-success" style="font-weight:600">Aktif</a>')+'</td>'+
                                    '<td>'+item.created_at+'</td>'+
                                '</tr>'

                        })
                    $("#partnership").html(card);
                }else{
                    $("#partnership").html("<div class='col-md-12'><div class='text-center'>Tidak ada data.</div></div>");

                }
                // id(result.)
            }
        });
    }
</script>