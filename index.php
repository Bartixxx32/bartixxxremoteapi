<html>
<p style="width: 70%;margin: auto;margin-top: 5%;font-size:larger;text-align:center">
Download Any Files From Any URL</p>
<form method="post" style="width: 70%;margin: auto;margin-top: 10%;">
<input name="url" size="50" placeholder="Please Enter Valid URL>>>" style="width: 100%;height: 10%;font-size: 1.5em;padding:10px" required>
<input name="submit" type="submit" value="Start Download" style="width: 30%;height: 10%;margin: 5% auto; display: block;">
<p style="width: 70%;margin: auto;margin-top: 10%;font-size:larger;text-align:center">
Your File Downloaded To <?php echo getcwd(); ?> Server</p>
<p style="width: 70%;margin: auto;font-size: smaller;text-align: center;position: fixed;bottom: 0;background: #fff;">
Powered by: <a href="#" target="_blank" style="color:#f60;text-decoration:none;">Developers</a></p>
</form>
<?php
    // maximum execution time in seconds
    // set_time_limit (24 * 60 * 60);
    if (!isset($_POST['submit'])) die();
    // folder to save downloaded files to. must end with slash
    $destination_folder = '';
    $url = $_POST['url'];
    $newfname = $destination_folder . basename($url);
    /*  // old script
    $file = fopen ($url, "rb");
    if ($file) { $newf = fopen ($newfname, "wb");
      if ($newf)
      while(!feof($file)) { fwrite($newf, fread($file, 1024 * 8 ), 1024 * 8 ); }
    }
    if ($file) { fclose($file); }
    if ($newf) { fclose($newf); }
    */
    file_put_contents( $newfname, fopen($url, 'r'));
?>
</html>