<?php
$link = 'https://' . $subdomain . '.amocrm.ru/api/v2/leads';

$curl = curl_init(); # Save the cURL session handle
# Set the necessary options for cURL session
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-API-client/1.0');
curl_setopt($curl, CURLOPT_URL, $link);
curl_setopt($curl, CURLOPT_HEADER, FALSE);
curl_setopt($curl, CURLOPT_COOKIEFILE, dirname(__FILE__) . '/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
curl_setopt($curl, CURLOPT_COOKIEJAR, dirname(__FILE__) . '/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);

$out = curl_exec($curl); # Initiate a request to the API and stores the response variable
$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);
if ($out)
{
    $leads = json_decode($out,true)['_embedded']['items'];
    $leads_without_tasks = array_filter($leads, function ($var) {
        return ($var['closest_task_at'] === 0);
    });
}
?>