<?php

	# Includes the autoloader for libraries installed with composer
	require __DIR__ . '/vendor/autoload.php';

	# Imports the Google Cloud client library
	use Google\Cloud\Storage\StorageClient;

	class storage {

		private $projectId;
		private $storage;

		public function __construct(){
				putenv("GOOGLE_APPLICATION_CREDENTIALS=D:\\13 Item\\My First Project-0558b98ee5a7.json");
		
		$this->projectId ='festive-flame-291413';

		# Instantiates a client
		$this->storage = new StorageClient([
		    'projectId' => $this->projectId
		]);

		}

		public function createBucket($bucketName){

		# Creates the new bucket
		$buckets = $this->storage->createBucket($bucketName);

		echo 'Bucket ' . $bucket->name() . ' created.';
		}

		public function listBuckets(){
			$buckets = $this->storage ->buckets();
			foreach ($buckets as $bucket)  {
				# code...
				echo $bucket ->name().PHP_EOL;
			}
		}


		function uploadObject($bucketName, $objectName, $source)
		{
		    $storage = new StorageClient();
		    $file = fopen($source, 'r');
		    $bucket = $storage->bucket($bucketName);
		    $object = $bucket->upload($file, [
		        'name' => $objectName
		    ]);
		    printf('Uploaded %s to gs://%s/%s' . PHP_EOL, basename($source), $bucketName, $objectName);
		}

		

	}

	
?>