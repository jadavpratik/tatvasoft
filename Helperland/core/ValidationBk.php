<?php

namespace core;


class ValidationBk{

	// REGEX...
	const TextRegEx = '/^[A-Za-z]/';
	const EmailRegEx = '/^[a-zA-Z0-9.]+@[a-zA-Z0-9]+(\.[a-zA-Z]{2,})+$/';
	const PhoneRegEx = '/^[0-9]{10}$/';
	const PasswordRegEx = '/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/';
	const PostalCodeRegEx = '/^[0-9]{5,10}$/';

	// PASSWORD...
	private static $password = '';
	// ERROR ARRAY...
	private static $error = [];


	public static function check($body, $fields){

		// LOOP FOR ALL KEY VALUES...
		foreach($fields as $key => $validation_arr){

			if(isset($body->$key)){
				// STORE VALUE IN VARIABLE...
				$field_value = $body->$key;
				// LOOP FOR INDIVIDUAL KEY VALUES & CHECK ALL PARAMETERS...
				foreach($validation_arr as $validation){
					if($key=='string' && !is_string($field_value)){
						self::$error[$key] = 'Field type must be a string!';
						break;
						
					}
				}
			}
			else{
				self::$error[$key] = 'Field is required!';
				break;
			}

		}// END LOOP


		// PASS RESPONSE ACCORDING TO VALIDATION...
		if(count(self::$error)>0){
			return self::$error;
		}
		else{
			return true;
		}

	}


}