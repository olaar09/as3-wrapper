<?php

/**
 * Description of AS3:
 * AS3 Component for yii 1.1 
 * can create bucket, delete bucket, create object, get object url, get object and delete object.
 *
 * @author olaar
 * agboolar09@gmail.com
 */
require 'aws/aws-autoloader.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

class AS3 {

    private $s3 = null;
    private static $region = null;

    const CLASS_NOT_INSTAIATED_ERR = "Call constructor with appropraite parameters";
    const REGION_NOT_SET_ERR = "Please set the bucket region to use a bucket";

    public static function setRegion($region) {
        self::$region = $region;
        return new AS3();
    }

    public function load($version = '2006-03-01') {

        if (self::$region == null) {
            throw new Exception(self::REGION_NOT_SET_ERR);
        }

        $credentials = array(// todo, get credentials from .env
            'key' => "AKIAILIIRAFOLPMDGCZQ",
            'secret' => "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"
        );

        $this->s3 = S3Client::factory(array(
                    'version' => $version,
                    'region' => self::$region,
                    'credentials' => $credentials
        ));

        return $this;
    }

    private function doChecks() {
        if ($this->s3 == null) {
            throw new Exception(self::CLASS_NOT_INSTAIATED_ERR);
        }

        if (self::$region == null) {
            throw new Exception(self::REGION_NOT_SET_ERR);
        }
    }

    public function createBucket($bucketName) { //returns array
        $this->doChecks();

        try {
            $result = $this->s3->createBucket([
                'Bucket' => $bucketName,
            ]);
        } catch (S3Exception $exc) {
            $err = $exc->getMessage();
        }

        return (isset($err)) ? $err : $result;
    }

    public function deleteBucket($bucket) { //todo
        $this->doChecks();

        try {
            $result = $this->deleteBucket([
                'Bucket' => $bucket
            ]);
        } catch (S3Exception $exc) {
            $err = $exc->getMessage();
        }

        return (isset($err)) ? $err : json_encode($result);
    }

    public function putObject($bucket, $newFileKey, $pathToSourceFile) { // returns json
        $this->doChecks();

        try {
            $result = $this->s3->putObject([
                'Bucket' => $bucket,
                'Key' => $newFileKey,
                'SourceFile' => $pathToSourceFile,
            ]);
        } catch (S3Exception $exc) {
            $err = $exc->getMessage();
        }

        return (isset($err)) ? $err : $result;
    }

    public function getObject($bucket, $key) { //todo
        $this->doChecks();

        try {
            $result = $this->s3->getObject([
                'Bucket' => $bucket,
                'Key' => $key
            ]);
        } catch (S3Exception $exc) {
            $err = $exc->getMessage();
        }

        return (isset($err)) ? $err : $result;
    }

    public function getObjectUrl($bucket, $key) { //returns string
        $this->doChecks();

        try {
            $result = $this->s3->getObjectUrl($bucket, $key);
        } catch (S3Exception $exc) {
            $err = $exc->getMessage();
        }

        return (isset($err)) ? $err : $result;
    }

    public function deleteObject($bucket, $key) {
        $this->doChecks();

        try {
            $result = $this->s3->deleteObject([
                'Bucket' => $bucket,
                'Key' => $key
            ]);
        } catch (S3Exception $exc) {
            $err = $exc->getMessage();
        }


        return (isset($err)) ? $err : $result;
    }

}

$test = AS3::setRegion("us-west-2")->load();
print_r($test->putObject("okada-production-assets", "this-is-a-test2", "/Users/olaar/as3/pin.jpg"));
