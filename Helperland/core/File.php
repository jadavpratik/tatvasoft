<?php

namespace core;


class File{

	public static function upload($file, $path){
		$uploadPath = ASSETS.'/'.$path;
		$fileName = basename($file['name']);	
		if(!file_exists($uploadPath)){
			echo mkdir($uploadPath);
			// echo $uploadPath;
		}
		// echo move_uploaded_file($file['tmp_name'], $uploadPath);
	}


}