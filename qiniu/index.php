<?php
// require_once("qiniu/http.php");
// require_once('qiniu/auth_digest.php');
// require_once('qiniu/rs.php');

// $accessKey = 'QqX1uY0DSDKGh8dm-llqgBS3L_288463_AwEaI5H';
// $secretKey = 'kd-Kfly7qwDAx0HzsCZ6OKXPPMyUVh088ZU3_S9B';

// require_once('qiniu/io.php');

require_once('simplehtmldom_1_5/simple_html_dom.php'); 
$html = file_get_html('http://liangyou.nissigz.com/');
// find all td tags with attribite align=center
foreach($html->find('tr') as $tr){
    $key =  $tr->find('td[align="left"]',0)->innertext;
    if(!$key) continue;
    $key = iconv('GB2312', 'UTF-8', $key);
    foreach($tr->find('a[target="_blank"]') as $td){
      $url[$td->href] = $key; 
    } //url.asp?id=79567

}
////$url=>
  // array(231) {
  //   ["url.asp?id=79703"]=>
  //   string(16) "i-Radio爱广播"
  //   ["url.asp?id=79665"]=>
  //   string(16) "i-Radio爱广播"
  //   ["url.asp?id=79630"]=>
  //   string(16) "i-Radio爱广播"
  //   ["url.asp?id=79593"]=>
  //   string(16) "i-Radio爱广播"
  //   ["url.asp?id=79561"]=>
  //   string(16) "i-Radio爱广播"
  //   ["url.asp?id=79530"]=>
  //   string(16) "i-Radio爱广播"
  //   ["url.asp?id=79498"]=>
  //   string(16) "i-Radio爱广播"
  //   ["url.asp?id=79698"]=>
  //   string(15) "恩典与真理"
  //   ["url.asp?id=79660"]=>
  //   string(15) "恩典与真理"
  //   ["url.asp?id=79625"]=>
$file = json_encode($url);
$file_path = 'program/lists/';
$file_key = $file_path . date('Ymd') . 'txt';
shell_exec("mkdir $file_path -p");
file_put_contents( $file_key , $bash ) ;
/////write to local or s3   /liangyou/program/list/20141212.txt

//create sqs & then delete $file_key;
echo '<pre>123';
// var_dump($url);

if(count($url))
  foreach ($url as $key => $value) {
    $link = 'http://liangyou.nissigz.com/'.$key;
    echo $link;
    $html = file_get_html("$link");
    $urls[] = str_replace('1; url=','',array_shift($html->find('meta[http-equiv="refresh"]'))->content);
    break;
  }

echo '<pre>';
var_dump($urls);

// $bucket = 'yongbuzhixi';
// // $url = 'http://111.206.10.20/1Q2W3E4R5T6Y7U8I9O0P1Z2X3C4V5B/liangyou2.nissigz.com:15200/yu/yu141127.mp3';
// // $url = 'http://www.cloud-audio.com/get_stream/6ae132-22eb36';
// //http://liangyou2.nissigz.com:15200/rt/rt141129.mp3
// // 空中辅导-20141201
// // $file = file_get_contents($data['url']);
// // $saveas="/var/www/myvno.com/public_html/crm/sites/default/files/";
// //  $endl = "a/kzfd.mp3";
// // file_put_contents( $saveas . $endl , $file ) ;
// // echo 'file_put_contents<br/>';

// // $url = "http://blog.yongbuzhixi.com/test.html";
// $bash = "#!/bin/bash";

// foreach ($radios as $key => $radio) {
// //$radio['url'] $radio['title']
//   $url = $radio['url'];
//   $html = file_get_html($url);
//   $url = $html->find('#div_playlist li', 0);
//   $title = $html->find('#div_playlist li .mp3_title', 0)->plaintext;
//   // $mp3_description = $html->find('#div_playlist li .mp3_description', 0)->plaintext;
//   $titles = explode('-', $title);
//   $month = substr($titles[1], 4, 2);
//   $path = '/var/www/html/liangyou/audio/'.$titles[0] . '/'  . date('Y') . '/' . $month;
//   $filepath = $path. '/' .$title. '.mp3';
//   $filename = $title. '.mp3';
//   $url   =  $url->attr['data-stream'];
//   $bash .= " 
//           mkdir $path -p
//           wget -O $filepath $url
//           echo $title dowloaded
//           ";
//           // break;
//   }
//   $bath_name = "/var/www/html/liangyou/sh/".date("Ymd").".sh";
//   file_put_contents( $bath_name , $bash ) ;
//   $output = file_get_contents($bath_name);
//   echo "<pre>$output</pre>";


// $html = file_get_html($url);
// $url = $html->find('#div_playlist li', 0);
// $title = $html->find('#div_playlist li .mp3_title', 0)->plaintext;
// $mp3_description = $html->find('#div_playlist li .mp3_description', 0)->plaintext;
// $data = array(
//  'url'   =>  $url->attr['data-stream'],
//  'title' => $title,
//  'desc'  => $mp3_description,
//  );

// $titles = explode('-', $data['title']);

// $month = substr($titles[1], 4, 2);
// $path = '/liangyou/'.$titles[0] . '/'  . date('Y') . '/' . $month;
// $filepath = $path. '/' .$title. '.mp3';
// $filename = $title. '.mp3';
// echo '<pre>';
// echo $path;
// echo '<br/>';
// echo $filepath;
// echo '<br/>';
// // // $path = utf8_encode($path);
// // // $path = iconv('UTF-8', 'GBK', $path);
// // $output = shell_exec("mkdir $path -p");
// // echo "<pre>$output</pre>";
// $url = $data['url'];
// // $output = shell_exec("cd  $path && wget -O $filename $url");
// // echo "<pre>$output</pre>";

// $bash = "#!/bin/bash          
//           echo Hello World  
//           mkdir $path -p
//           wget -O $filepath $url
//           ";


// file_put_contents( "/liangyou/1.sh" , $bash ) ;
// $output = shell_exec("dos2unix 1.sh && sudo chmod +x 1.sh");
// $output = file_get_contents("/liangyou/1.sh");
// echo "<pre>$output</pre>";
// // $file = file_get_contents($data['url']);
// // file_put_contents( $filename , $file ) ;

// var_dump($data);


// $output = shell_exec("ls /liangyou/");
// echo "<pre>$output</pre>";
// Qiniu_SetKeys($accessKey, $secretKey);
// $putPolicy = new Qiniu_RS_PutPolicy($bucket);
// $upToken = $putPolicy->Token(null);
// $putExtra = new Qiniu_PutExtra();
//  // $putExtra->MimeType = 'image/jpg';
//  // $putExtra->CheckCrc = 1;
//  // $putExtra->Crc32 = 1;
//  // public $Params = null;
//  // public $MimeType = null;
//  // public $Crc32 = 0;
//  // public $CheckCrc = 0;
// $putExtra->Params = array('x:test'=>$data['desc']);

// $saveas="/var/www/html/blog/qiniu/liangyou/";

// list($ret, $err) = Qiniu_Put($upToken, $path, $file, $putExtra);
// echo "<pre>====> file sent to : \n";
// if ($err !== null) {
//     var_dump($err);
// } else {
//     var_dump($ret);
// }
