<?php
namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\UploadedFile;
use Exception;
class VideoController
{

    private $uploadDirectory = "/var/www/html/react/php/uploads";
    /**
     * Moves the uploaded file to the upload directory and assigns it a unique name
     * to avoid overwriting an existing uploaded file.
     *
     * @param string $directory directory to which the file is moved
     * @param UploadedFile $uploadedFile file uploaded file to move
     * @return string filename of moved file
     */

    public function getExtUploadedFile($uploadedFile)
    {
        $extension = pathinfo($uploadedFile->getClientFilename() , PATHINFO_EXTENSION);
        return $extension;
    }

    
    public function moveUploadedChunk($directory, $uploadedFile, $chunkData, $uniqueIdentifier)
    {
        $extension = $this->getExtUploadedFile($uploadedFile);
        $fileCounter = $this->countFilesInDirectory($directory) + 1;
        $basename = $uniqueIdentifier . "_" . $fileCounter;
        if (!file_exists($directory))
        {
            mkdir($directory, 0777, true);
        }
        $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $basename);
        return $basename;
    }

    public function printCli($message)
    {
        $f = fopen('php://stderr', 'w');
        fputs($f, '***---***');
        fputs($f, $message);
        fputs($f, '***---***');
    }

    public function countFilesInDirectory($path)
    {
        $files = glob($path . '/*');
        return count($files);

    }

    public function createRandomFileName()
    {
        $date = date('m-d-Y');
        $removeDashes = str_replace('-', '', $date);
        return $removeDashes;
    }

    public function uploadChunks(Request $request, Response $response, $args)
    {
       
        $uniqueIdentifier = str_replace('-', '', $_POST['qquuid']);
        $uploadedFiles = $request->getUploadedFiles();
        $uploadedFile = $uploadedFiles['qqfile'];
        // Directory check
        // Create Date  Directory
        $year = date("Y");
        $month = date("m");
        $day = date("d");
      
        $uploadDirectory = "$this->uploadDirectory/$year/$month/$day/$uniqueIdentifier/";

        if (!file_exists($this->uploadDirectory))
        {
            mkdir($uploadDirectory, 0777, true);
        }
        
        if ($uploadedFile->getError() === UPLOAD_ERR_OK)
        {
            $file = $uploadedFile->file;
            $chunkName = $this->moveUploadedChunk($uploadDirectory, $uploadedFile, $_POST, $uniqueIdentifier);
            
        }
        return $response->withJson(['success' => true, 'fileName' => $uniqueIdentifier, 'chunkName' => $chunkName]);

    }

    public function processVideoChunks(Request $request, Response $response)
    {

        // $uniqueIdentifier=$_POST['qquuid'];
        $uniqueIdentifier = str_replace('-', '', $_POST['qquuid']);
        $year = date("Y");
        $month = date("m");
        $day = date("d");

        if ($uniqueIdentifier)
        {

            $returnResponse = function ($info = null, $filelink = null, $status = "error")
            {
                die(json_encode(array(
                    "status" => $status,
                    "info" => $info,
                    "file_link" => $filelink
                )));
            };
            // $dirName = $this->uploadDirectory.'/'.$uniqueIdentifier;
            $dirName = "$this->uploadDirectory/$year/$month/$day/$uniqueIdentifier";
            $totalChunks = $this->countFilesInDirectory($dirName);
            $chunksUploaded = glob($dirName . '/*');
            if (!file_exists($dirName) || empty($chunksUploaded))
            {
                throw new Exception("This file cannot be processed video chunks does not exist", 409);
            }
            $targetFile = "$this->uploadDirectory/$year/$month/$day/$uniqueIdentifier/$uniqueIdentifier";
            $fileInfo = pathinfo($targetFile);
            // $fileExtension = $fileInfo['extension'];
            $fileExtension = 'mp4';
            if (count($chunksUploaded) === $totalChunks)
            {
                for ($i = 1;$i <= $totalChunks;$i++)
                {
                    $file = fopen($targetFile . '_' . $i, 'rb');
                    $buff = fread($file, 2097152);
                    fclose($file);
                    // combining file and removing chunks
                    $final = fopen($targetFile . '.' . $fileExtension, 'ab');
                    $write = fwrite($final, $buff);
                    fclose($final);
                    unlink($targetFile . '_' . $i);
                }

            }
            return $response->withJson(['success' => true, 'targetFile' => $targetFile, 'chunksUploaded' => $chunksUploaded, 'totalChunks' => $totalChunks, 'dirName' => $dirName, ]);
        }
    }

}

