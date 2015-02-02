<pre><?php
//////////////////////////////////////////////////////////////////
require 'vendor/autoload.php';
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
$s3 = S3Client::factory(array(
                'key'    => 'AKIAJZSII3KHTLKFGB5A',
                'secret' => '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',
            ));
$bucket = 'ybzx';

$response = $s3->if_object_exists($bucket, array('key'=>'test1.txt'));
 
// Success? (Boolean, not a CFResponse object)
var_dump($response);
// // Use the high-level iterators (returns ALL of your objects).
// $objects = $s3->getIterator('ListObjects', array('Bucket' => $bucket));

// echo "Keys retrieved!\n";
// foreach ($objects as $object) {
//     echo 'https://s3.amazonaws.com/ybzx/'.$object['Key'] . "\n";
// }

// // Use the plain API (returns ONLY up to 1000 of your objects).
// $result = $s3->listObjects(array('Bucket' => $bucket));

// echo "Keys retrieved!\n";
// foreach ($result['Contents'] as $object) {
//     // echo $object['Key'] . "\n";
// }