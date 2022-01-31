<?php

namespace core;


class File{

	public static function upload($file, $path){
		$uploadPath = ASSETS.'/'.$path;
		$fileName = basename($file['name']);	
		if(!file_exists($uploadPath)){
			mkdir($uploadPath, 0777, true);
		}
		$source = $file['tmp_name'];
		$destination = $uploadPath.$fileName;
		if(move_uploaded_file($source, $destination)){
			return $destination;
		}
	}
	// header pass in ajax,
	// how to auto create dir in php


}