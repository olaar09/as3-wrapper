<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AS3
 *
 * @author olaar
 */
require 'aws/aws-autoloader.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

class AS3 {

    private $s3 = null;

    const CLASS_NOT_INSTAIATED_ERR = "Call constructor with appropraite parameters";

    public function __construct() {

        $this->s3 = new S3Client([
            'version' => 'latest',
            'region' => 'us-east-1',
            'credentials' => [
                'key' => 'my-access-key-id',
                'secret' => 'my-secret-access-key',
            ],
        ]);
    }

    public function createBucket($bucketName) { // throws exception
        $result = null;

        if ($this->s3 !== null) {
            try {
                $result = $this->s3->createBucket([
                    'Bucket' => $bucketName,
                ]);
            } catch (S3Exception $exc) {
                $result = $exc->getMessage();
            }
        } else {
            throw new Exception(self::CLASS_NOT_INSTAIATED_ERR);
        }

        return $result;
    }

    public function deleteBucket($param) { //todo
        $result = null;

        if ($this->s3 !== null) {
            try {
                $result = $this->deleteBucket([
                ]);
            } catch (S3Exception $exc) {
                $result = $exc->getMessage();
            }
        } else {
            throw new Exception(self::CLASS_NOT_INSTAIATED_ERR);
        }

        return $result;
    }

    public function putObject($bucket, $newFileKey, $pathToSourceFile) { // todo
        $result = null;

        if ($this->s3 !== null) {
            try {
                $result = $this->s3->putObject([
                    'Bucket' => $bucket,
                    'Key' => $newFileKey,
                    'SourceFile' => $pathToSourceFile,
                ]);
            } catch (S3Exception $exc) {
                $result = $exc->getMessage();
            }
        } else {
            throw new Exception(self::CLASS_NOT_INSTAIATED_ERR);
        }

        return $result;
    }

    public function getObject(array $args) {
        $result = null;

        if ($this->s3 !== null) {
            try {
                $result = $this->s3->getObject([
                ]);
            } catch (S3Exception $exc) {
                $result = $exc->getMessage();
            }
        } else {
            throw new Exception(self::CLASS_NOT_INSTAIATED_ERR);
        }

        return $result;
    }

    public function getObjectUrl($bucket, $key) {
        $result = null;

        if ($this->s3 !== null) {
            try {
                $result = $this->s3->getObjectUrl($bucket, $key);
            } catch (S3Exception $exc) {
                $result = $exc->getMessage();
            }
        } else {
            throw new Exception(self::CLASS_NOT_INSTAIATED_ERR);
        }

        return $result;
    }

    public function deleteObject(array $args) {
        $result = null;

        if ($this->s3 !== null) {
            try {
                $result = $this->s3->deleteObject([
                ]);
            } catch (S3Exception $exc) {
                $result = $exc->getMessage();
            }
        } else {
            throw new Exception(self::CLASS_NOT_INSTAIATED_ERR);
        }

        return $result;
    }

}


$test = new AS3();
print_r($test->createBucket("epubuploads"));
print_r($test->putObject("epubuploads", "test-as3-upload-1", "/Users/olaar/as3/pin.jpg"));