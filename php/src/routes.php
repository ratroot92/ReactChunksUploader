<?php


$app->get(
	'/',
	'App\Controllers\BaseController:index'
	);



$app->post(
	'/api/videos/uploadChunks',
	'App\Controllers\VideoController:uploadChunks'
	);




$app->post(
	'/api/videos/processVideo',
	'App\Controllers\VideoController:processVideoChunks'
	);



