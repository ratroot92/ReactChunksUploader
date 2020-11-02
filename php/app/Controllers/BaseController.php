<?php
/**
 * ClipBucket API (https://clipbucket.com)
 *
 * @link      http://work.iu.com.pk/svn/cb-corporate/
 * @copyright Copyright (c) 2007 - 2018 by Arslan Hassan
 * @license   http://work.iu.com.pk/svn/cb-corporate/trunk/upload/LICENSE 
 * (ATTRIBUTION ASSURANCE LICENSE)
*/

namespace App\Controllers;

class BaseController
{
    public function index($request,$response,$args){
       
        return $response->write("/home/maliksblr92/Desktop/development/clipbucket/php/uploads/");
    }
}