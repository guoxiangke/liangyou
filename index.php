<pre><?php
//check if get already? cron once a day!
$file_path = dirname(__FILE__).'/cron/nzzlist/';
$file_key = $file_path . date('Ymd') . '.md3';
if(!file_exists($file_key))  {
	echo 'Warning: File ' . $file_key . ' not exists! Exit!!!';
	return;
}
//////////////////////////////////////////////////////////////////
// aws/aws-sdk-php
//https://github.com/aws/aws-sdk-php
require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

// Instantiate an S3 client
$s3 = S3Client::factory(array(
    'key'    => 'AKIAJZSII3KHTLKFGB5A',
    'secret' => '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',
));


chmod($file_key, 0777); 
$file = file_get_contents($file_key);
$urls = json_decode($file,TRUE);
// var_dump($urls);
foreach ($urls as $url => $value) {
	if(!isset($value['mp3_download']) && isset($value['mp3_link'])){
		$mp3_link = $value['mp3_link'];
		echo $mp3_link;
		// Upload a publicly accessible file. The file size, file type, and MD5 hash
		// are automatically calculated by the SDK.
		//i-Radio爱广播/
		$my_obj = 'liangyou/audio/'.date('Y').'/'.$value['title'].'/'.date('m').'/'.date('Ymd') .'.mp3';
		try {
		    $s3->putObject(array(
		        'Bucket' => 'ybzx',
		        'Key'    => $my_obj,
		        'Body'   => fopen('ir141212.mp3', 'r'),
		        'ACL'    => 'public-read',
		    ));
				$urls[$url]['mp3_download'] = '1';
		} catch (S3Exception $e) {
		    echo "There was an error uploading the file.\n";
		    var_dump($e->getMessage());
		    unset($urls[$url]['mp3_download']);
		}

    // echo $value['title'].'Link is ： ' . $mp3_link;
    // var_dump($urls);
		$file = json_encode($urls);
		file_put_contents( $file_key , $file);
    break;
	}
}


