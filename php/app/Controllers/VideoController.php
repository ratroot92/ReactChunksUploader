<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\UploadedFile;

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

    public function moveUploadedFile($directory, UploadedFile $uploadedFile, $randomFileName)
    {
        $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
        $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
        $fileCounter = $this->countFilesInDirectory($directory) + 1;
        $basename = $randomFileName . "_" . $fileCounter;
        $upload= $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $basename);
        return $upload;
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
        $files = scandir($path);
        return $num_files = count($files) - 2;

    }

    public function createRandomFileName()
    {
        $date = date('m-d-Y');
        $removeDashes = str_replace('-', '', $date);
        return $removeDashes;
    }

    public function uploadChunks(Request $request, Response $response,$args)
    {
        $randomFileName=$_REQUEST['name'];

      

        $uploadedFiles = $request->getUploadedFiles();
        $uploadedFile = $uploadedFiles['qqfile'];
        // Directory check
        // Create Date  Directory
        $year = date("Y");
        $month = date("m");
        $day = date("d");
        // $randomFileName = $this->createRandomFileName();

        $uploadDirectory = "$this->uploadDirectory/$year/$month/$day/$randomFileName/";

        if (!file_exists($this->uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);
            $this->printCli("Directory does not exist -- created ");
        } else {
            $this->printCli("Directory already exist  ");
        }
        if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
            $filename = $this->moveUploadedFile($uploadDirectory, $uploadedFile, $randomFileName);
            $this->printCli("Done");
        } else {
            $this->printCli("Error");
        }
        return $response->withJson(['success' => true,
            'fileName' =>'name']);

    }

    public function processVideoChunks(Request $request, Response $response)
    {
        $directory = $this->uploadDirectory;
        $filecount = 0;
        $files = glob($directory . "*");
        if ($files) {
            $filecount = count($files);

        }

        return $response->withJson(['success' => true,
        'fileNames' =>$_REQUEST['fileName']]);

    }

}
