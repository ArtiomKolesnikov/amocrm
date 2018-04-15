<?php
# An array of parameters that must be passed by the POST method to the API
$user = array(
	'USER_LOGIN' => '77777green77777@gmail.com', # Your login (email)
	'USER_HASH'  => '2f32094ab12bf629125dbfa0a70875c9' # Hash to access the API (see profile)
);

$subdomain = 'new5ad1c284945dd'; # Our account (subdomain)
$link='https://'.$subdomain.'.amocrm.ru/private/api/auth.php?type=json';
$curl = curl_init(); # Save the cURL session handle

# Set the necessary options for cURL session
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-API-client/1.0');
curl_setopt($curl, CURLOPT_URL, $link);
curl_setopt($curl, CURLOPT_POST, TRUE);
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($user));
curl_setopt($curl, CURLOPT_HEADER, FALSE);
curl_setopt($curl, CURLOPT_COOKIEFILE, dirname(__FILE__) . '/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
curl_setopt($curl, CURLOPT_COOKIEJAR, dirname(__FILE__) . '/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);

$out = curl_exec($curl); # Initiate a request to the API and stores the response variable
$code = curl_getinfo($curl, CURLINFO_HTTP_CODE); # Obtain the HTTP-server response code
curl_close($curl); # Close cURL session

/**
 * Obtain data in JSON-format, therefore, to obtain the data being read,
 * we have to translate the answer into a format understood by PHP
 */
$Response = json_decode($out, TRUE);
$Response = $Response['response'];
if (isset($Response['auth'])) # Flag of authorization is available in the property "auth"
	return 'Authorization successful';
return 'Authorization failed';
?>