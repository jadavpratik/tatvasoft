<?php

namespace core;


class Validation{

	const TextRegEx = '/^[A-Za-z]/';
	const EmailRegEx = '/^[a-zA-Z0-9.]+@[a-zA-Z0-9]+(\.[a-zA-Z]{2,})+$/';
	const PhoneRegEx = '/^[0-9]{10}$/';
	const PasswordRegEx = '/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/';

	private static $password = '';


	public static function check($body, $validationArr){

		$error = array();

		foreach($validationArr as $key => $validation){

			$temp = 0;
			$error_messages = array();

			foreach($validation as $i){

				// EMPTY VALIDATION
				if(isset($body->$key)){

					// IF VALUE EXIST THEN DO OTHER VALIDATON...

					// MINIMUM VALIDATION
					if(str_contains($i, 'min:')){
						$min = (int) str_replace('min:', '', $i);
						if(strlen($body->$key) < $min){
							$error_messages[$temp++] = 'Field Required minimum '.$min.' characters';
						}
					}

					// MAXIMUM VALIDATION
					if(str_contains($i, 'max:')){
						$max = (int) str_replace('max:', '', $i);
						if(strlen($body->$key) > $max){
							$error_messages[$temp++] = 'Field Required maximum '.$max.' characters';
						}
					}

					// MINIMUM VALIDATION
					if(str_contains($i, 'length:')){
						$length = (int) str_replace('length:', '', $i);
						if(strlen($body->$key) != $length){
							$error_messages[$temp++] = 'Field Value length is '.$length.' character only';
						}
					}


					// EMAIL VALIDATION
					if($i=='email'){
						if(!preg_match(Validation::EmailRegEx, $body->$key)){
							$error_messages[$temp++] = 'Email Address is Invalid';
						}
					}

					// PHONE VALIDATION
					if($i=='phone'){
						if(!preg_match(Validation::PhoneRegEx, $body->$key)){
							$error_messages[$temp++] = 'Phone Number is Invalid';
						}
					}

					// TEXT 0R STRING VALIDATION
					if($i=='text'){
						if(!preg_match(Validation::TextRegEx, $body->$key)){
							$error_messages[$temp++] = 'Only Text Allowed';
						}
					}

					// PASSWORD VALIDATION
					if($i=='password'){
						if(!preg_match(Validation::PasswordRegEx, $body->$key)){
							$error_messages[$temp++] = 'Make Sure your password is a combination of one special character, one number & one capital character';
						}
						self::$password = $body->$key;
					}

					// CONFIRM PASSWORD VALIDATION
					if($i=='confirm-password'){
						if(!preg_match(Validation::PasswordRegEx, $body->$key)){
							$error_messages[$temp++] = 'Make Sure your password is a combination of one special character, one number & one capital character';
						}
						if(self::$password != $body->$key){
							$error_messages[$temp++] = 'Password & Confirm Password Not Same';
						}
					}
				}
				else{
					// EMPTY VALIDATION
					$error_messages[$temp++] = 'This Field is required';
					break;
				}

			}
			if(count($error_messages)>0){
				$error[$key] = $error_messages;
			}

		}

		// RETURN ERROR OR TRUE...
		if(count($error)>0){
			return $error;
		}
		else{
			return true;
		}

	}

}