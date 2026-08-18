<?php
error_reporting(E_ALL ^ E_DEPRECATED);

function mail_attachment($filename, $path, $mailto, $from_mail, $from_name, $replyto, $subject, $message) {
   	$file = $path.$filename;
    $file_size = filesize($file);
    $handle = fopen($file, "r");
    $content = fread($handle, $file_size);
    fclose($handle);
    $content = chunk_split(base64_encode($content));
    $uid = md5(uniqid(time()));
    $name = basename($file);
    $header = "From: ".$from_name." <".$from_mail.">\r\n";
    $header .= "Reply-To: ".$replyto."\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
    $header .= "This is a multi-part message in MIME format.\r\n";
    $header .= "--".$uid."\r\n";
    $header .= "Content-type:text/html; charset=iso-8859-1\r\n";
    $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $header .= $message."\r\n\r\n";
    $header .= "--".$uid."\r\n";
    $header .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n"; // use diff. tyoes here
    $header .= "Content-Transfer-Encoding: base64\r\n";
    $header .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
    $header .= $content."\r\n\r\n";
    $header .= "--".$uid."--";
    if (mail($mailto, $subject, "", $header)) {
  echo  ""; // or use booleans here
    } else {
 echo  "Mail send ... ERROR!";
    }
}

$comccmail=$_POST['cc_email']; 
$subject=trim($_POST['subject']);
$content=nl2br($_POST['content']);

$headers.= "cc: $comccmail"."\r\n";
	
if(isset($_REQUEST['submit']))
{ 
$file=$_FILES['attachfile']['name'];

$image=$_FILES['attachfile']['name'];
$upload1="http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['REQUEST_URI'])."/attach/";
/* echo $upload1; */
$PATH=$upload1;
$path1=explode('/',$PATH);
//$upload=$path1[0]."/".$path1[1]."/".$path1[2]."/attach/";
$upload="attach/";
/* echo $upload;
die(); */
 if(!is_dir($upload))
{
mkdir($upload, 0777);
} 
$image=$_FILES['attachfile']['name'];
$trMonth=$_REQUEST['trans_month'];

if($image!="")
{
$ans=rand('1','99999');
$string = $image;
$string = ereg_replace(' ', '_', $string);
$pos=strrpos($string,'.');
$mainext=substr($string,($pos+1));
$car_cv='salaryslip_'.$ans.'.'.$mainext;
/* echo $car_cv;
die(); */
move_uploaded_file($_FILES['attachfile']['tmp_name'],$upload.$car_cv);
}


$MailTo=$_REQUEST['to_email'];
/* $email="info@successndt.com"; */
$email='jeyamravip@gmail.com';
$admin_mail=$MailTo;
//$my_file = $car_cv;
$my_file = $car_cv;
$my_path =$upload;
$my_name = "mysoftindia";
$my_mail = "jeyamravip@gmail.com";
$my_replyto = $email;
$my_subject = "New Enquiry has been posted!";
$my_message='<html>
<head>
  <title></title>
</head>
<body><div>'.$content.'</div></body>
</html>';


$okk=mail_attachment($my_file, $my_path, $admin_mail, $my_mail, $my_name, $my_replyto, $my_subject, $my_message);
		
if($okk){
 echo "<script>window.opener.document.getElementById('msgSHow').style.display='block'; window.close();</script>"; 
	  }
	  else
	  {
	echo "<script>window.opener.document.getElementById('msgSHow1').style.display='block'; window.close();</script>";
	  }
}

?>
