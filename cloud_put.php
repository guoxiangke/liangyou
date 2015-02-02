<pre><?php
//check if get already? cron once a day!
$file_path = dirname(__FILE__).'/cron/cloud/';
$file_key = $file_path . date('Ymd') . '.json';
if(!file_exists($file_key))  {
	echo 'Warning: File ' . $file_key . 'Not exists! Exit!!!';
	return;
}
chmod($file_key, 0777); 
$file = file_get_contents($file_key);
$urls = json_decode($file,TRUE);
//////////////////////////////////////////////////////////////////
require 'vendor/autoload.php';
// aws/aws-sdk-php
//https://github.com/aws/aws-sdk-php
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
$logfile = $file_path.'logs.txt';
foreach ($urls as $url => $value) {
	if($value['date'] != date('Ymd') ) continue;
	if(!isset($value['s3'])){
        $mp3_link = $value['url'];
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
            $my_obj = 'liangyou/cloud/'.date('Y').'/'.$value['title'].'/'.date('m').'/'.date('Ymd') .'.mp3';
            try {
                $result = $s3->putObject(array(
                    'Bucket' => 'ybzx',
                    'Key'    => $my_obj,
                    'Body'   => fopen($tempfile, 'r'),
                    'ACL'    => 'public-read',
                    'Metadata'	 => array(
							        'title' =>	$value['title'],
							        'desc' =>	$value['desc'],
							        'date' =>	$value['date'],
								    )
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
                $urls[$url]['s3'] = $result['ObjectURL'];
            } catch (S3Exception $e) {
                var_dump($e->getMessage());
            }
        }
		$urls = json_encode($urls);
		file_put_contents( $file_key , $urls);
    break;
	}
}