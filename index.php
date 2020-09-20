<?php
ini_set('display_errors', '0');

function get_header($url,$header) {
    $my_ch = curl_init();
    curl_setopt($my_ch, CURLOPT_URL,$url);
    curl_setopt($my_ch, CURLOPT_HTTPHEADER,$header);
    curl_setopt($my_ch, CURLOPT_HEADER, true);
    curl_setopt($my_ch, CURLOPT_NOBODY, true);
    curl_setopt($my_ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($my_ch, CURLOPT_TIMEOUT, 10);
    return curl_exec($my_ch);
}

$data_file = "https://anime.bartixxx.workers.dev/Ogladam/Love%20Comedy/Yahari%20Ore%20no%20Seishun%20Love%20Comedy%20wa%20Machigatteiru%20OVA.mp4";
$filename = 'file.mp4';

if(isset($_SERVER['HTTP_RANGE']) || isset($HTTP_SERVER_VARS['HTTP_RANGE'])) {

    $my_header = getallheaders();

    $i = 0;
    foreach($my_header as $key => $value)
        $header_curl[$i++]= $key.': '.$value;

    $header_read = null;
    foreach($my_header as $key => $value)
        $header_read .= $key.': '.$value."\r\n";

    $recieved_header = get_header($data_file,$header_curl);

    $recieved_header = explode("\r\n", $recieved_header);
    foreach($recieved_header as $value)
        header($value);

    while (!(connection_aborted() || connection_status() == 1)) {
        $ctx = stream_context_create(
                                    array(
                                        'http'=> $header_read
                                    )
                );

        readfile($data_file, false, $ctx);
    }
}
else{
    header('Accept-Ranges: bytes');
    header("Content-Description: File Transfer");
    header("Content-Type: application/otect-stream");
    header('Content-Disposition: attachment; filename="'.$filename.'"');

    $my_header = getallheaders();

    $header_read = null;
    foreach($my_header as $key => $value)
        $header_read .= $key.': '.$value."\r\n";

    $i = 0;
    foreach($my_header as $key => $value)
        $header_curl[$i++]= $key.': '.$value;

    $recieved_header = get_header($data_file,$header_curl);

    $recieved_header = explode("\r\n", $recieved_header);
    foreach($recieved_header as $value)
        header($value);

    while (!(connection_aborted() || connection_status() == 1)) {
        $ctx = stream_context_create(
                                    array(
                                        'http'=> $header_read
                                    )
                );
        readfile($data_file, false, $ctx);
    }
}

exit;
