<?php
set_time_limit(0);

if (empty($_GET)) {
    die("No url providen");
}

$url = $_GET['url'];
$file = basename($url);

$fp = fopen($file, 'w');

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_NOPROGRESS, false);
curl_setopt($ch, CURLOPT_PROGRESSFUNCTION, 'callback');
curl_setopt($ch, CURLOPT_BUFFERSIZE, 128);


$data = curl_exec($ch);

curl_close($ch);

 function callback($download_size, $downloaded, $upload_size, $uploaded)
{
    $percent=$downloaded/$download_size;
  // Do something with $percent
  echo "$percent";      
}



fclose($fp);

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename='.basename($file));
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($file));
ob_clean();
flush();
readfile($file);
exit;
?>
