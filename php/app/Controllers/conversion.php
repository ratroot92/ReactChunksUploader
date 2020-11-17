<?php


 function getVideoResolutionByDimensions($width,$height){
    if($width==352 && $height == 240){
        return "240p";
    }
    else if($width==480 && $height == 360){
        return "360p";
    }
    else if ($width == 858 && $height== 480 ){
        return "480p";
    }
    else if ($width == 1280 && $height ==720  ){
        return "720p";
    }

   
    return "";
}

function getFfmpegCommandsByResolutionName ($res,$targetFilePath,$outputPath,$extension){
    if($res == "720p"){
        // we will convert video into following resolutions 
        //[720p,480p,360p,240p]
        $commandList=array(
            "ffmpeg -i ${targetFilePath} -vf scale=352:240  ${outputPath}240p.${extension}",//240p
            "ffmpeg -i ${targetFilePath} -vf scale=480:360  ${outputPath}360p.${extension}",//360p
            "ffmpeg -i ${targetFilePath} -vf scale=858:480  ${outputPath}480p.${extension}",//480p
            "ffmpeg -i ${targetFilePath} -vf scale=1280:720 ${outputPath}720p.${extension}",//720p
        );
            return $commandList;
    }
    else if($res == "480p"){
        // we will convert video into following resolutions 
        //[720p,480p,360p,240p]
        $commandList=array(
            "ffmpeg -i ${targetFilePath} -vf scale=352:240  ${outputPath}240p.${extension}",//240p
            "ffmpeg -i ${targetFilePath} -vf scale=480:360  ${outputPath}360p.${extension}",//360p
            "ffmpeg -i ${targetFilePath} -vf scale=858:480  ${outputPath}480p.${extension}",//480p

            
        );
            return $commandList;
    }


    else if($res == "360"){
        // we will convert video into following resolutions 
        //[720p,480p,360p,240p]
        $commandList=array(
            "ffmpeg -i ${targetFilePath} -vf scale=352:240  ${outputPath}240p.${extension}",//240p
            "ffmpeg -i ${targetFilePath} -vf scale=480:360  ${outputPath}360p.${extension}",//360p 
            
        );
            return $commandList;
    }


   else{
       return array();
    }
}

 $uploadDirectory                            ="/var/www/html/react/php/files/uploads";
 $conversionDirectory                        ="/var/www/html/react/php/files/conversion";
 $logDirectory                               ="/var/www/html/react/php/files/logs";
 $BASEDIR                                    ="/var/www/html";




$fileDirectory                                   ="/var/www/html/react/php/files/uploads/2020/11/13/e3aa8a55ccca4ad9931f84b66e271f0e";
$uniqueIdentifier                                ="e3aa8a55ccca4ad9931f84b66e271f0e";
$fileToConvert                                   ="e3aa8a55ccca4ad9931f84b66e271f0e.mp4";
$fileName                                        ="e3aa8a55ccca4ad9931f84b66e271f0e";
$targetFileName                                  ="e3aa8a55ccca4ad9931f84b66e271f0e.mp4";
//
$year                                            = date("Y");
$month                                           = date("m");
$day                                             = date("d");
//
$conversionDirName                               ="${conversionDirectory}/{$year}/{$month}/{$day}/{$uniqueIdentifier}";
$logFile                                         = $logDirectory.'/'.$uniqueIdentifier;
$logFileName                                     ="$uniqueIdentifier.log";
if (!file_exists($conversionDirName)){
    mkdir($conversionDirName,0777,true);
}
if (!file_exists($logFile)){
    mkdir($logFile,0777,true);
    fopen($logFileName, 'w');
}
      



$conversionPaths=array();



/*
FIND HEIGHT AND WIDTH OF UPLOADED VIDEO
*/
        $command="ffprobe -v error -show_entries stream=width,height -of default=noprint_wrappers=1 ${fileDirectory}/${fileToConvert}";
        exec( $command, $output, $return_var );
        $currentVideoWidth=(int)str_replace("width=","",$output[0]);
        $currentVideoHeight=(int)str_replace("height=","",$output[1]);
        $currentVideoResolution=getVideoResolutionByDimensions($currentVideoWidth,$currentVideoHeight);
/*
GET VIDEO RESOULTION FOR NAMING AND COMMAND GENERATIONS 
(getVideoResolutionByDimensions($currentVideoWidth,$currentVideoHeight))
*/
        if($currentVideoResolution != ''){
            $targetFilePath="${fileDirectory}/${fileToConvert}";
            $outputPath="${conversionDirName}/${uniqueIdentifier}";

/*
CONVERSION COMMANDS GENERATION  
(getFfmpegCommandsByResolutionName($currentVideoResolution,$targetFilePath,$outputPath))
*/
            $commandList=getFfmpegCommandsByResolutionName($currentVideoResolution,$targetFilePath,$outputPath,$extension);
            print_r($commandList);
/*
RUN EACH CONVERSION COMMAND 
*/
            foreach($commandList as $key=>$command){
            exec( $command, $output, $return_var );
            if($return_var == 0){
               //sucecssfull conversion 
               array_push($conversionPaths,);
            }
           }
           
        }
      //  print_r($return_var);




