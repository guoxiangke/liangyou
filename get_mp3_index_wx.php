<?php
//check if get already? cron once a day!
$file_path = dirname(__FILE__).'/cron/nzzlist/';
$file_key = $file_path . date('Ymd') . '.json';
// $file_store_key = $file_path .'/store/'. date('Ymd') . '.txt';
if(file_exists($file_key))  {
    header('location:cron/nzzlist/'. date('Ymd') . '.json');
	// echo 'Warning: File ' . $file_key . ' exists! Exit!!!';
	return;
}
//////////////////////////////////////////////////////////////////

require 'vendor/autoload.php';
// aws/aws-sdk-php
//https://github.com/aws/aws-sdk-php
require_once('vendor/mgargano/simplehtmldom/src/simple_html_dom.php');
// use simple_html_dom as shd;
// require_once('simplehtmldom_1_5/simple_html_dom.php'); 


$html = SimpleHtmlDom\file_get_html('http://liangyou.nissigz.com/');
// find all td tags with attribite align=center
foreach($html->find('tr') as $tr){
    $key =  $tr->find('td[align="left"]',0);
    if(!$key) continue;
    $key = iconv('GB2312', 'UTF-8//IGNORE', $key->innertext);
    foreach($tr->find('a[target="_blank"]') as $td){
    	$id = str_replace('url.asp?id=','',$td->href);
      $url[$id] = $key;
    } //url.asp?id=79567

}
// var_dump($url);
$url = array_reverse($url,true);
// var_dump($url);
$url = array_flip($url);
// var_dump($url);
$url = array_flip($url);
// var_dump($url);
// array(49) {
//   [79713]=>
//   string(58) "良友圣经学院（本科文凭课程）-青少年事工"

foreach ($url as $id => $value) {
    if(strstr($value,'良友圣经学院')) {
        // continue;
        $titles = explode('-', $value);
        $value = $titles[1];
    }
    // $value = preg_replace('（([^（）]+)）','', $value);
    //生命的四季（星期一至五为直播，节目会於直播完毕后上载）
    if(strstr($value,'生命的四季')) $value = '生命的四季';
    if(strstr($value,'天路导向（')) continue; 
    //$value = '天路导向1';
    if(strstr($value,'关怀心磁场')) $value = '关怀心磁场';
	$urls["url.asp?id=".$id]['title'] = $value;
}
// file_put_contents( $file_store_key, print_r($urls, true)) ;
// var_dump($urls);
$file = json_encode($urls);

// // shell_exec("mkdir $file_path -p");
file_put_contents( $file_key , $file ) ;
// // echo 'Sucess! Write File :' $file_key;