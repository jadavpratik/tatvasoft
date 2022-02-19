if(isset($body->$key)){
				$value = $body->$key;
				switch($i){
					case 'optional'        :
						self::$error[$temp++] = 'Field is Required!';
						break;
					case 'required'        :
						self::$error[$temp++] = 'Field is Required!';
						break;
					case 'string'          :
						self::$error[$temp++] = 'Field value should be a type of string!';
						break;
					case 'array'           :
						self::$error[$temp++] = 'Field value should be a type of an array!';
						break;
					case 'object'          :
						self::$error[$temp++] = 'Field value should be a type of an object!';
						break;
					case 'number'          :	
						self::$error[$temp++] = 'Field value should be a type of number!';
						break;
					case 'integer'         :	
						self::$error[$temp++] = 'Field value should be a type of integer!';
						break;
					case 'min'             :
						self::$error[$temp++] = 'Field have minimum 3 character required!';
						break;
					case 'max'             :
						self::$error[$temp++] = 'Field have maximum 3 character required!';
						break;
					case 'length'          :					
						self::$error[$temp++] = 'Field length should be a 10!';
						break;
					case 'email'           :
						self::$error[$temp++] = 'Email Address not in valid format!';
						break;
					case 'password'        :
						self::$error[$temp++] = 'Password not in valid format!';
						break;
					case 'confirm-password':
						self::$error[$temp++] = 'Password & Confirm Password not matched!';
						break;
					case 'phone'           :
						self::$error[$temp++] = 'Phone Number not in valid format!';
						break;
					case 'text'            :
						self::$error[$temp++] = 'Only Text are allowed!';
						break;
					case 'postal-code'     : 
						self::$error[$temp++] = 'Postal Code not in valid format';
						break;
				}// END SWITCH
			}
			else{
				self::$error[$temp++] = 'Field is required!';
			}

