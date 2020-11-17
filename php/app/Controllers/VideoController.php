<?php
namespace App\Controllers;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\UploadedFile;
use Exception;
class VideoController {
    private $uploadDirectory = "/var/www/html/react/php/files/uploads";
    private $conversionDirectory = "/var/www/html/react/php/files/conversion";
    private $videoDirectory = "/var/www/html/react/php/files/videos";
    private $logDirectory = "/var/www/html/react/php/files/logs";
    private $BASEDIR = "/var/www/html";
    /**
     * Moves the uploaded file to the upload directory and assigns it a unique name
     * to avoid overwriting an existing uploaded file.
     *
     * @param string $directory directory to which the file is moved
     * @param UploadedFile $uploadedFile file uploaded file to move
     * @return string filename of moved file
     */
    /**
     * CONVERSION HELPERS FUNCTIONS START
     *
     */
    // ==================================================== //
    public function getVideoResolutionByDimensions($width, $height) {
        if ($width == 352 && $height == 240) {
            return "240p";
        }  if ($width == 480 && $height == 360) {
            return "360p";
        }  if ($width == 858 && $height == 480) {
            return "480p";
        }  if ($width == 1280 && $height == 720) {
            return "720p";
        }
        if ($width == 1920 && $height == 1080) {
            return "1080p";
        }
        if ($width == 2560 && $height == 1440) {
            return "1440p";
        }
        if ($width == 3840 && $height == 2160) {
            return "2160p";
        }
        return "";
    }
    // ==================================================== //
    // ==================================================== //
    public function getFfmpegCommandsByResolutionName($res, $targetFilePath, $outputPath, $extension, $uniqueIdentifier) {
        


        if ($res == "2160p") {
            // we will convert video into following resolutions
            //[1080p,720p,480p,360p,240p]
            $commandList = array(
            "nohup ffmpeg -i ${targetFilePath} -vf scale=352:240  ${outputPath}/{$uniqueIdentifier}-240p.${extension} > /dev/null &", //240p
            "nohup ffmpeg -i ${targetFilePath} -vf scale=480:360  ${outputPath}/{$uniqueIdentifier}-360p.${extension} > /dev/null &", //360p
            "nohup ffmpeg -i ${targetFilePath} -vf scale=858:480  ${outputPath}/{$uniqueIdentifier}-480p.${extension} > /dev/null &", //480p
            "nohup ffmpeg -i ${targetFilePath} -vf scale=1280:720 ${outputPath}/{$uniqueIdentifier}-720p.${extension} > /dev/null &", //720p
            "nohup ffmpeg -i ${targetFilePath} -vf scale=1920:1080 ${outputPath}/{$uniqueIdentifier}-1080p.${extension} > /dev/null &", //1080p
            "nohup ffmpeg -i ${targetFilePath} -vf scale=2560:1440 ${outputPath}/{$uniqueIdentifier}-1440p.${extension} > /dev/null &", //1440p
            "nohup ffmpeg -i ${targetFilePath} -vf scale=3840:2160 ${outputPath}/{$uniqueIdentifier}-2160p.${extension} > /dev/null &", //2160p
            );
            return $commandList;
        }
        
        if ($res == "1440p") {
            // we will convert video into following resolutions
            //[1080p,720p,480p,360p,240p]
            $commandList = array(
            "nohup ffmpeg -i ${targetFilePath} -vf scale=352:240  ${outputPath}/{$uniqueIdentifier}-240p.${extension} > /dev/null &", //240p
            "nohup ffmpeg -i ${targetFilePath} -vf scale=480:360  ${outputPath}/{$uniqueIdentifier}-360p.${extension} > /dev/null &", //360p
            "nohup ffmpeg -i ${targetFilePath} -vf scale=858:480  ${outputPath}/{$uniqueIdentifier}-480p.${extension} > /dev/null &", //480p
            "nohup ffmpeg -i ${targetFilePath} -vf scale=1280:720 ${outputPath}/{$uniqueIdentifier}-720p.${extension} > /dev/null &", //720p
            "nohup ffmpeg -i ${targetFilePath} -vf scale=1920:1080 ${outputPath}/{$uniqueIdentifier}-1080p.${extension} > /dev/null &", //1080p
            "nohup ffmpeg -i ${targetFilePath} -vf scale=2560:1440 ${outputPath}/{$uniqueIdentifier}-1440p.${extension} > /dev/null &", //1440p
            );
            return $commandList;
        }

        if ($res == "1080p") {
            // we will convert video into following resolutions
            //[1080p,720p,480p,360p,240p]
            $commandList = array(
            "nohup ffmpeg -i ${targetFilePath} -vf scale=352:240  ${outputPath}/{$uniqueIdentifier}-240p.${extension} > /dev/null &", //240p
            "nohup ffmpeg -i ${targetFilePath} -vf scale=480:360  ${outputPath}/{$uniqueIdentifier}-360p.${extension} > /dev/null &", //360p
            "nohup ffmpeg -i ${targetFilePath} -vf scale=858:480  ${outputPath}/{$uniqueIdentifier}-480p.${extension} > /dev/null &", //480p
            "nohup ffmpeg -i ${targetFilePath} -vf scale=1280:720 ${outputPath}/{$uniqueIdentifier}-720p.${extension} > /dev/null &", //720p
            "nohup ffmpeg -i ${targetFilePath} -vf scale=1920:1080 ${outputPath}/{$uniqueIdentifier}-1080p.${extension} > /dev/null &", //1080p
            );
            return $commandList;
        }
       
       
        if ($res == "720p") {
            // we will convert video into following resolutions
            //[720p,480p,360p,240p]
            $commandList = array(
            "nohup ffmpeg -i ${targetFilePath} -vf scale=352:240  ${outputPath}/{$uniqueIdentifier}-240p.${extension} > /dev/null &", //240p
            "nohup ffmpeg -i ${targetFilePath} -vf scale=480:360  ${outputPath}/{$uniqueIdentifier}-360p.${extension} > /dev/null &", //360p
            "nohup ffmpeg -i ${targetFilePath} -vf scale=858:480  ${outputPath}/{$uniqueIdentifier}-480p.${extension} > /dev/null &", //480p
            "nohup ffmpeg -i ${targetFilePath} -vf scale=1280:720 ${outputPath}/{$uniqueIdentifier}-720p.${extension} > /dev/null &", //720p
            );
            return $commandList;
        }  if ($res == "480p") {
            // we will convert video into following resolutions
            //[720p,480p,360p,240p]
            $commandList = array(
            "nohup ffmpeg -i ${targetFilePath} -vf scale=352:240  ${outputPath}/{$uniqueIdentifier}-240p.${extension} > /dev/null &", //240p
            "nohup ffmpeg -i ${targetFilePath} -vf scale=480:360  ${outputPath}/{$uniqueIdentifier}-360p.${extension} > /dev/null &", //360p
            "nohup ffmpeg -i ${targetFilePath} -vf scale=858:480  ${outputPath}/{$uniqueIdentifier}-480p.${extension} > /dev/null &", //480p
            );
            return $commandList;
        }  if ($res == "360") {
            // we will convert video into following resolutions
            //[720p,480p,360p,240p]
            $commandList = array(
            "nohup ffmpeg -i ${targetFilePath} -vf scale=352:240  ${outputPath}/{$uniqueIdentifier}-240p.${extension} > /dev/null &", //240p
            "nohup ffmpeg -i ${targetFilePath} -vf scale=480:360  ${outputPath}/{$uniqueIdentifier}-360p.${extension} > /dev/null &", //360p
            );
            return $commandList;
        } else {
            return array();
        }
    }
    // ==================================================== //
    // ==================================================== //
    
    /**
     * CONVERSION HELPERS FUNCTIONS  END
     *
     */
    public function getExtUploadedFile($uploadedFile) {
        $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
        return $extension;
    }
    public function moveUploadedChunk($directory, $uploadedFile, $chunkData, $uniqueIdentifier) {
        $extension = $this->getExtUploadedFile($uploadedFile);
        $fileCounter = $this->countFilesInDirectory($directory) + 1;
        $basename = $uniqueIdentifier . "_" . $fileCounter;
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }
        $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $basename);
        return $basename;
    }
    public function printCli($message) {
        $f = fopen('php://stderr', 'w');
        fputs($f, '***---***');
        fputs($f, $message);
        fputs($f, '***---***');
    }
    public function countFilesInDirectory($path) {
        $files = glob($path . '/*');
        return count($files);
    }
    public function createRandomFileName() {
        $date = date('m-d-Y');
        $removeDashes = str_replace('-', '', $date);
        return $removeDashes;
    }











    public function uploadChunks(Request $request, Response $response, $args) {
        $uniqueIdentifier = str_replace('-', '', $_POST['qquuid']);
        $uploadedFiles = $request->getUploadedFiles();
        $uploadedFile = $uploadedFiles['qqfile'];
        // Directory check
        // Create Date  Directory
        $year = date("Y");
        $month = date("m");
        $day = date("d");
        $uploadDirectory = "$this->uploadDirectory/$year/$month/$day/$uniqueIdentifier/";
        if (!file_exists($this->uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);
        }
        //
        //CREATE LOG FILE 
        // $logDir = "{$this->logDirectory}/{$year}/{$month}/{$day}/{$uniqueIdentifier}";
        // $logFileName = "{$uniqueIdentifier}.log";
        // $logFile=$logDir."/".$logFileName;
                    
        // if (!file_exists($logDir)) {
        //     mkdir($logDir, 0777, true);
        //     fopen($logDir."/".$logFileName."/".$logFileName, 'w');
        // }


   
        if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
            $file = $uploadedFile->file;
            $chunkName = $this->moveUploadedChunk($uploadDirectory, $uploadedFile, $_POST, $uniqueIdentifier);
        }
        return $response->withJson(['success' => true, 'fileName' => $uniqueIdentifier, 'chunkName' => $chunkName]);
    }




















    public function processVideoChunks(Request $request, Response $response) {
        $uniqueIdentifier = str_replace('-', '', $_POST['qquuid']);
        $year = date("Y");
        $month = date("m");
        $day = date("d");
        // $uniqueIdentifier=$_POST['qquuid'];
        // LOG START HERE  
        $logDir = "{$this->logDirectory}/{$year}/{$month}/{$day}/{$uniqueIdentifier}";
        $logFileName = "{$uniqueIdentifier}.log";
        $logFile=$logDir."/".$logFileName;
                    
        if (!file_exists($logDir)) {
            mkdir($logDir, 0777, true);
            fopen($logDir."/".$logFileName, 'w');
        }

        file_put_contents($logDir."/".$logFileName ,"***- STARTING PROCESS   -***\n", FILE_APPEND);
        //START END HERE  
      
        file_put_contents($logDir."/".$logFileName ,"UNIQUE IDIENTIFIER = {$uniqueIdentifier}\n", FILE_APPEND);
       
        if ($uniqueIdentifier) {
            $returnResponse = function ($info = null, $filelink = null, $status = "error") {
                die(json_encode(array("status" => $status, "info" => $info, "file_link" => $filelink)));
            };
            // $dirName = $this->uploadDirectory.'/'.$uniqueIdentifier;
            $dirName = "$this->uploadDirectory/$year/$month/$day/$uniqueIdentifier";
            file_put_contents($logDir."/".$logFileName ,"CHUNKS DIRECTORY = {$dirName}\n", FILE_APPEND);
            $totalChunks = $this->countFilesInDirectory($dirName);
            file_put_contents($logDir."/".$logFileName ,"TOTAL CHUNKS  = {$totalChunks}\n", FILE_APPEND);
            $chunksUploaded = glob($dirName . '/*');
            if (!file_exists($dirName) || empty($chunksUploaded)) {
                throw new Exception("This file cannot be processed video chunks does not exist", 409);
            }
            $targetFile = "$this->uploadDirectory/$year/$month/$day/$uniqueIdentifier/$uniqueIdentifier";
            file_put_contents($logDir."/".$logFileName ,"TARGET FILE DIRECTORY  = {$targetFile}\n", FILE_APPEND);
            $fileInfo = pathinfo($targetFile);
            // $fileExtension = $fileInfo['extension'];
            $fileExtension = 'mp4';
            if (count($chunksUploaded) === $totalChunks) {
                for ($i = 1;$i <= $totalChunks;$i++) {
                    $file = fopen($targetFile . '_' . $i, 'rb');
                    $buff = fread($file, 2097152);
                    fclose($file);
                    // combining file and removing chunks
                    $final = fopen($targetFile . '.' . $fileExtension, 'ab');
                    $write = fwrite($final, $buff);
                    fclose($final);
                   // unlink($targetFile . '_' . $i);
                    file_put_contents($logDir."/".$logFileName ,"CHUNK PROCESSED   = {$targetFile}.'-'.{$i}\n", FILE_APPEND);
                }
            }
            try{

            }
            catch(Exception $e){
                $this->printCli(""+$e);
            }
            file_put_contents($logDir."/".$logFileName ,"CHUNK MERGING    = SUCCESSFULL \n", FILE_APPEND);
            file_put_contents($logDir."/".$logFileName ,"***-  STARTING VIDEO CONVERSION -*** \n", FILE_APPEND);
            file_put_contents($logDir."/".$logFileName ,"PARAM [UNIQUE IDIENTIFIER ] = $uniqueIdentifier \n", FILE_APPEND);
            file_put_contents($logDir."/".$logFileName ,"PARAM [FILE EXTENSION  ] = $fileExtension \n", FILE_APPEND);
            file_put_contents($logDir."/".$logFileName ,"PARAM [TARGET FILE DIRECTORY  ] =$targetFile \n", FILE_APPEND);
            $this->printCli("this->convertVideo ");
            $status =$this->convertVideo($uniqueIdentifier, $fileExtension, $targetFile);
         
            return $response->withJson(['success' => true, 'targetFile' => $targetFile, 'chunksUploaded' => $chunksUploaded, 'totalChunks' => $totalChunks, 'dirName' => $dirName]);
        }
    }

    public function convertVideo($uniqueIdentifier, $extension, $targetFile) {
        try{
            $this->printCli("convertVideo ");
            //$uniqueIdentifier = str_replace('-', '', $_POST['qquuid']);
                // LOG START HERE  
                // $logDir = "{$this->logDirectory}/{$year}/{$month}/{$day}/{$uniqueIdentifier}";
                // $logFileName = "{$uniqueIdentifier}.log";
                // $logFile=$logDir."/".$logFileName;
                            
                // if (!file_exists($logDir)) {
                //     mkdir($logDir, 0777, true);
                //     fopen($logDir."/".$logFileName, 'w');
                // }
            // file_put_contents($logDir."/".$logFileName ,"INSIDE CONVERSION FUNCTION  \n", FILE_APPEND);
            $year = date("Y");
            $month = date("m");
            $day = date("d");
            $fileToConvert = "${uniqueIdentifier}.${extension}";
            $conversionPaths = array();
            $targetFilePath = "{$this->uploadDirectory}/{$year}/{$month}/{$day}/{$uniqueIdentifier}/${fileToConvert}";
            $outputPath = "{$this->videoDirectory}/{$year}/{$month}/{$day}/{$uniqueIdentifier}";
            $logFile = "{$this->logDirectory}/{$year}/{$month}/{$day}/{$uniqueIdentifier}";
            $logFileName = "{$uniqueIdentifier}.log";
            /*
            CHUNKED UPLOAD FILE EXIST
            @IF
            */
            
                // file_put_contents($logDir."/".$logFileName ,"CHECKING IF CONVERSION FILE EXIST   \n", FILE_APPEND);
            if (file_exists($targetFilePath)) {
                // file_put_contents($logDir."/".$logFileName ,"CONVERSION  FILE EXIST = TRUE  \n", FILE_APPEND);
               
                /*
               CREATE VIDEO FOLDERS
                */
                // file_put_contents($logDir."/".$logFileName ,"CONVERSION OUTPUT PATH  = {$outputPath}  \n", FILE_APPEND);

                

                 /*
               CREATE VIDEO FOLDERS
                */
                            
                if (!file_exists($outputPath)) {
                    mkdir($outputPath, 0777, true);
                   
                }

                // file_put_contents($logDir."/".$logFileName ,"VERIFYING HEIGHT AND WIDTH OF TARGET VIDEO     \n", FILE_APPEND);
                /*
                FIND HEIGHT AND WIDTH OF UPLOADED VIDEO
                */

                $command = "ffprobe -v error -show_entries stream=width,height -of default=noprint_wrappers=1 {$targetFilePath} ";
                exec($command, $output, $return_var);
                $this->printCli("ffprobe -v error -show_entries stream=width,height -of default=noprint_wrappers=1 ");
                    if ($return_var == 0) {
                      
                        $currentVideoWidth = (int)str_replace("width=", "", $output[0]);
                        $currentVideoHeight = (int)str_replace("height=", "", $output[1]);
                        // file_put_contents($logDir."/".$logFileName ,"HEIGHT =    {$currentVideoHeight}  \n", FILE_APPEND);
                        // file_put_contents($logDir."/".$logFileName ,"WIDTH  =    {$currentVideoHeight} \n", FILE_APPEND);
                        $currentVideoResolution = $this->getVideoResolutionByDimensions($currentVideoWidth, $currentVideoHeight);
                        // file_put_contents($logDir."/".$logFileName ,"CONVERSION VIDEO RESOLUTION  =    {$currentVideoResolution}  \n", FILE_APPEND);
                        $this->printCli($currentVideoResolution);
                    /*
                    GET VIDEO RESOULTION FOR NAMING AND COMMAND GENERATIONS
                    (getVideoResolutionByDimensions($currentVideoWidth,$currentVideoHeight))
                    */
                if ($currentVideoResolution != '') {
                    /*
                    CONVERSION COMMANDS GENERATION
                    (getFfmpegCommandsByResolutionName($currentVideoResolution,$targetFilePath,$outputPath))
                    */
                    // file_put_contents($logDir."/".$logFileName ,"GENERATING CONVERSION COMMANDS   \n", FILE_APPEND);
                    $commandList = $this->getFfmpegCommandsByResolutionName($currentVideoResolution, $targetFilePath, $outputPath, $extension, $uniqueIdentifier);
                   
                    /*
                    RUN EACH CONVERSION COMMAND
                    */
                    foreach ($commandList as $key => $command) {
                        // file_put_contents($logDir."/".$logFileName ,"COMMAND {$key}  =    {$command}  \n", FILE_APPEND);
                        exec($command, $output, $return_var);
                        if ($return_var == 0) {
                            //file_put_contents($logDir."/".$logFileName ,"CONVERSION SUCCESSFULL   \n", FILE_APPEND);
                            //sucecssfull conversion
                            //array_push($conversionPaths,);
                            
                        }
                        //
                        else{

                        }
                    }
                    //loop end 
                }
                //resolution function returns empty string
               else{

               }
            }
            //return variable return 1 exit code ==fail
                else{

                }
            
        }
            else{
                $this->printCli("Not Exist ");
            }


    }
            catch(Exception $e){
                $this->printCli(""+$e);
            }


        //
    }
        
            
}
