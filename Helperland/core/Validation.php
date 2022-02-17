<?php

namespace core;


class Validation{

	const TextRegEx = '/^[A-Za-z]/';
	const EmailRegEx = '/^[a-zA-Z0-9.]+@[a-zA-Z0-9]+(\.[a-zA-Z]{2,})+$/';
	const PhoneRegEx = '/^[0-9]{10}$/';
	const PasswordRegEx = '/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/';
	const PostalCodeRegEx = '/^[0-9]{5,10}$/';

	private static $password = '';

	public static function check($body, $validationArr){

		$error = array();

		foreach($validationArr as $key => $validation){
			$temp = 0;
			$error_messages = array();

			foreach($validation as $i){
				if($i=='optional'){
					break;
				}
				else{
					// IF VALUE EXIST THEN DO OTHER VALIDATON...
					if(isset($body->$key)){

						// IS TYPE OF ARRAY
						if($i=='array'){
							if(!is_array($body->$key)){
								// gettype($body->$key)!='array'
								$error_messages[$temp++] = 'The field should be a type of an array!';
							}
						}

						// IS TYPE OF ARRAY
						if($i=='string'){
							if(!is_string($body->$key)){
								// gettype($body->$key)!='array'
								$error_messages[$temp++] = 'The field should be a type of an string!';
							}
						}

						// IS TYPE OF OBJECT
						if($i=='object'){
							if(!is_object($body->$key)){
								// gettype($body->$key)!='object'
								$error_messages[$temp++] = 'The field should be a type of an object!';
							}
						}

						// NUMBER OR INTERGER VALIDATION...
						if($i=='number' || $i=='integer' || $i=='int'){
							if(!is_int($body->$key) || !is_integer($body->$key)){
								$error_messages[$temp++] = 'Only Number allowed (Integer)';
							}
						}
	
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
	
						// POSTAL CODE VALIDATION...
						if($i=='postal-code'){
							if(!preg_match(Validation::PostalCodeRegEx, $body->$key)){
								$error_messages[$temp++] = 'Postal Code Should be a Min:5 or Max:10 Digits Only !';
							}
						}

					}
					else{
						// EMPTY VALIDATION
						$error_messages[$temp++] = 'This Field is required';
						break;
					}
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