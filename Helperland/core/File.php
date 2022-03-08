<?php

namespace core;


class File{

	public static function upload($file, $path){		

		$path = ltrim($path, '/');
		$path = rtrim($path, '/');
		$uploadPath = STORAGE_PATH.$path;
		$fileName = strtolower(date('Y_m_d').'_'.time().'_'.$file['name']);	

		if(!file_exists($uploadPath)){
			mkdir($uploadPath, 0777, true);
		}

		$source = $file['tmp_name'];
		$destination = $uploadPath.'/'.$fileName;

		if(move_uploaded_file($source, $destination)){
			return $path.'/'.$fileName;
		}

	}

}