<?php

class utilityFunctions {
    function __construct() {
    $f = fopen('php://stderr', 'w');
    fputs($f, '***---*** utiltyFunctions --contructor ***---***');
    }
 //* Helpers Functions */
 public function printCli($message){
    $f = fopen('php://stderr', 'w');
    fputs($f, '***---***');
    fputs($f, $message);
    fputs($f, '***---***');
}
}