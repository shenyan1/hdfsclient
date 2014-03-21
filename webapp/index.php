<?php
// 初始化一个 cURL 对象
$curl = curl_init(); 
$addr = 'http://166.111.69.224:50070/webhdfs/v1'; 
// 设置你需要抓取的URL"http://<HOST>:<PORT>/webhdfs/v1/<PATH>?op=LISTSTATUS"
if(isset($_GET['path'])==NULL){
curl_setopt($curl, CURLOPT_URL, 'http://166.111.69.224:50070/webhdfs/v1/?op=LISTSTATUS');

}

else{
$loc = $addr.'/'.$_GET['path'].'?op=LISTSTATUS';
curl_setopt($curl, CURLOPT_URL, $loc);
} 
// 设置header
curl_setopt($curl, CURLOPT_HEADER, false);
 
// 设置cURL 参数，要求结果保存到字符串中还是输出到屏幕上。
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
 
// 运行cURL，请求网页
$data = curl_exec($curl);
$jaray=json_decode($data,true); 
// 关闭URL请求
curl_close($curl);
// 显示获得的数据]
//var_dump($jaray);
foreach($jaray['FileStatuses']['FileStatus'] as $itr){
if(!isset($_GET['path']))
echo '<a href=test.php?path='.$itr['pathSuffix'].' target="_blank" >'.$itr['pathSuffix'].'</a><br>';
else{
if($itr['type']=='FILE'){
	echo '<a href=downloads/download.php?path='.$_GET['path'].'/'.$itr['pathSuffix'].'&filename='.$itr['pathSuffix'].' target="_blank" >'.$itr['pathSuffix'].'File type: File'.'</a><br>';
	}else
echo '<a href=test.php?path='.$_GET['path'].'/'.$itr['pathSuffix'].' target="_blank" >'.$itr['pathSuffix'].'File type:directory'.'</a><br>';
}
}
?>
