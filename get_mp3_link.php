<pre>
<?php
require 'vendor/autoload.php';
require_once('vendor/mgargano/simplehtmldom/src/simple_html_dom.php');

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;


$file_path = dirname(__FILE__).'/cron/nzzlist/';
$file_key = $file_path . date('Ymd') . '.md3';
$file_store_key = $file_path .'/store/'. date('Ymd') . '.txt';
chmod($file_store_key, 0777); 
chmod($file_key, 0777); 
$file = file_get_contents($file_key);
$urls = json_decode($file,TRUE);

$logfile = $file_path.'logs.txt';
foreach ($urls as $url => $value) {

	if(!isset($value['mp3_link'])){
		$link = 'http://liangyou.nissigz.com/'.$url;
        $html = SimpleHtmlDom\file_get_html("$link");
        $meta = $html->find('meta[http-equiv="refresh"]');
        $meta = array_shift($meta)->content;
        $mp3_link = str_replace('1; url=','',$meta);
        $urls[$url]['mp3_link'] = $mp3_link;
        // echo $value['title'].'Link is ： ' . $mp3_link;
        // then download & s3
        $file = file_get_contents($mp3_link);
        $tempfile = $file_path.'temp.mp3';
        file_put_contents($tempfile, $file);
        if(file_exists($tempfile)) {
            // Instantiate an S3 client
            $s3 = S3Client::factory(array(
                'key'    => 'AKIAJZSII3KHTLKFGB5A',
                'secret' => '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',
            ));
            echo 'downloaded!!!';
            $my_obj = 'liangyou/audio/'.date('Y').'/'.$value['title'].'/'.date('m').'/'.date('Ymd') .'.mp3';
            try {
                $result = $s3->putObject(array(
                    'Bucket' => 'ybzx',
                    'Key'    => $my_obj,
                    'Body'   => fopen($tempfile, 'r'),
                    'ACL'    => 'public-read',
                ));
                // Access parts of the result object
                echo $result['Expiration'] . "\n";
                echo $result['ServerSideEncryption'] . "\n";
                echo $result['ETag'] . "\n";
                echo $result['VersionId'] . "\n";
                echo $result['RequestId'] . "\n";

                // Get the URL the object can be downloaded from
                echo $result['ObjectURL'] . "\n";

                unlink($tempfile);               
                file_put_contents($logfile, $my_obj."\n",FILE_APPEND);                

            } catch (S3Exception $e) {
                var_dump($e->getMessage());
            }

        }    
    file_put_contents( $file_store_key, print_r($urls, true)) ;
	$urls = json_encode($urls);
	file_put_contents( $file_key , $urls);
    break;
	}
}
