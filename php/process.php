<?php

	if ($_SERVER['REQUEST_METHOD'] === 'POST' 
		&& isset($_POST['test_django']) 
		&& $_POST['test_django']!=""
		&& isset($_POST['res_var']) 
		&& $_POST['res_var']!=""
	) {
	    $value = $_POST['test_django'];   
		$resVar = $_POST['res_var'];
		$jsonData = json_encode(['value' => $value]);
		
		$curl = curl_init();
		
		$url = 'http://localhost:8000/upit?key=' . $resVar;			
		$headers = [
			'Content-Type: application/json',
			'Content-Length: ' . strlen($jsonData),
		];

		
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonData);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		
		$response = curl_exec($curl);				
		
		if (curl_errno($curl)) {
			$error = curl_error($curl);			
			echo "cURL Error: " . $error;
		} else {										
			echo $response;
		}

		curl_close($curl);    
	}	  	  	
?>