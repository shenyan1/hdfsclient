<?php
$path=$_GET['path'];
$curl1 = curl_init(); 
 $addr = 'http://166.111.69.224:50070/webhdfs/v1';
	$ptr =$addr.'/'.$_GET['path'].'?op=OPEN';
	//$ptr = 'http://hadoop2:50075/webhdfs/v1/user/root/Test2?op=OPEN&offset=0';
	curl_setopt($curl1, CURLOPT_URL, $ptr);
	curl_setopt($curl1, CURLOPT_HEADER, false);
    curl_setopt($curl1,CURLOPT_FOLLOWLOCATION,1);
// 设置cURL 参数，要求结果保存到字符串中还是输出到屏幕上。
    curl_setopt($curl1, CURLOPT_RETURNTRANSFER, 1);
// 运行cURL，data1 is the file content
    $data1 = curl_exec($curl1);
    $filename=$_GET['filename'];
	$f = fopen($filename,'w');
	fwrite($f,$data1);
	fclose($f);
	curl_close($curl1);
	 header('Content-type: application/octet-stream'); 
//下载显示的名字 
     header('Content-Disposition: attachment; filename='.$filename); 
	 readfile($filename); 
	 
?>
