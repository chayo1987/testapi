<?php
/**
* SUPREME COMPONENTS INTERNATIONAL TECHNICAL TEST
* @author Cahyono <chayo_eno@yahoo.com
*/
function CallAPI($url, $data = false)
{
    $curl = curl_init();
    $username = 'supremecomponents';
    $password = '07b23129ead7328ca4f14a9c08fa89f333e30d08042a5ec4d211e7b66851825d';

    $values['request'] = array(
        'login' => $username,
        'apikey' => $password,
        'remoteIp' => get_client_ip(),
        'useExact' => true,
        'parts' => $data
    );
    $params = json_encode($values);
    if ($data)
        $url = sprintf("%s?req=%s", $url, ($params));
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);
    if(!$result){ die("Connection Failure"); }
    curl_close($curl);
    return $result;
}

function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
?>