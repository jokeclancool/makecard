<?php
session_start(); 
header('Content-type: image/jpeg');
 
function getQrcode($uid) {
    return file_get_contents('https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . $uid);
}

 
 $name = @$_GET["name"];
 $uid = @$_GET["uid"];
 $mobile_id = @$_GET["mobile_id"];

if(empty($name) || empty($uid) || empty($mobile_id)){
   $result = array(
        "status"=>404,
       "message"=>"Not found",
   );
   echo json_encode($result);exit();
}


  $fullPathBg =  'images/bg.jpg';
  $fullPath =  'images/';

  $jpg_image = imagecreatefromjpeg($fullPathBg);//bg
  $im2 = imagecreatefromstring(getQrcode($mobile_id));
  $im3 = imagecreatefromstring(getQrcode($uid));

   // Allocate A Color For The Text
  $white = imagecolorallocate($jpg_image, 0, 0, 0);

  // Set Path to Font File
  $font_path = "./css/THSarabunNew.ttf";

  // Print Text On Image
  imagettftext($jpg_image, 40, 0, 300, 200, $white, $font_path, $name);
  $random = md5(rand(106, 10000));
   
  imagecopymerge($jpg_image, $im2, 217, 302, 0, 0, 180, 180, 100);
  imagecopymerge($jpg_image, $im3, 613, 302, 0, 0, 180, 180, 100);

  $output = $fullPath . '/' . $random . "nut.jpg";
  if(!imagejpeg($jpg_image, $output)){
     $result = array(
              "status"=>404,
              "message"=>"Not found",
            );
    echo json_encode($result);exit();
  }
  imagedestroy($jpg_image);
   $arr = array(
      "name"=>$name,
      "uid"=>$uid,
      "mobile_id"=>$mobile_id,
      "pathUrl"=>"https://makecard-ckd.herokuapp.com/output.php",
      "image"=>"images/".$random . "nut.jpg"
    );
  $_SESSION["qrcodes"] = $arr;
  header("Location: output.php");
?>