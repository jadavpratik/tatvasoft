<?php

	function title(){
		$title = 'Helperland';
		switch(page_url()){
			case '/' :
				$title = 'Home'; 
				break;
			case '/faqs' :
				$title = 'FAQs'; 
				break;
			case '/prices' :
				$title = 'Prices'; 
				break;
			case '/contact' :
				$title = 'Contact'; 
				break;
			case '/service-provider/signup' :
				$title = 'Service Provider Signup'; 
				break;
			case '/customer/signup' :
				$title = 'Customer Signup'; 
				break;
			case '/book-now' :
				$title = 'Book Now'; 
				break;
			case '/guarantee' :
				$title = 'Our Gurantee'; 
				break;
			case '/customer' :
				$title = 'Customer'; 
				break;
					}
		echo $title;
	}