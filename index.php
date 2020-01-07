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
curl_setopt($ch, CURLOPT_PROGRESSFUNCTION, 'progress');
curl_setopt($ch, CURLOPT_NOPROGRESS, false); // needed to make progress function work

$data = curl_exec($ch);

curl_close($ch);

function progress($resource,$download_size, $downloaded, $upload_size, $uploaded)
{
    if($download_size > 0)
         echo $downloaded / $download_size  * 100;
    ob_flush();
    flush();
    sleep(1); // just to see effect
}

echo "Done";
ob_flush();
flush();


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
