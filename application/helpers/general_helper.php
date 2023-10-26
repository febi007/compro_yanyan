<?php

function assets($path){
    return base_url().'assets/'.$path;
}

function dd($arr){
    var_dump($arr);die();
}

function urls($path){
    return base_url().'site/'.$path;
}

function getImage($filename){
    return base_url().'upload/'.$filename;
}

function getFile($filename){
    return base_url().'files/'.$filename;
}

function _uploadImage($image='image'){
    $dis = & get_instance();
    $config['upload_path']          = './upload/';
    $config['allowed_types']        = 'gif|jpg|png';
    $config['file_name']            = time();
    $config['overwrite']			= true;
    $config['max_size']             = 3064; // 3MB
    // $config['max_width']            = 1024;
    // $config['max_height']           = 768;

    $dis->load->library('upload', $config);

    if ($dis->upload->do_upload($image)) {
        return $dis->upload->data("file_name");
    }else{
        $error = array('error' => $dis->upload->display_errors());
    }

    return "default.jpg";
}

function _uploadFiles(){
    $dis = & get_instance();
    $config['upload_path'] = './files/'; //path folder
    $config['allowed_types'] = 'pdf|ppt|pptx|xlsx|xls|doc|docx|ppt|pptx|zip'; //type yang dapat diakses bisa anda sesuaikan
    // $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
    $raw_name = explode('.',$_FILES['fileupload']['name']);
    // dd($raw_name);
    $nameoffile=url_title($raw_name[0], 'dash', true);
    $config['file_name'] = $nameoffile.'_'.time();

    // $dis->upload->initialize($config);
    $dis->load->library('upload', $config);

    if(!empty($_FILES['fileupload']['name']))
    {
        if ($dis->upload->do_upload('fileupload'))
        {
            $gbr = $dis->upload->data();
            $file=$gbr['file_name'];
            return $file;
        }else{
            return false;
        }

    }else{
        return false;
    }

}
