<?

function randomText($length) {
    $pattern = "1234567890";

    for($i=0;$i<$length;$i++) {
      $key .= $pattern{mt_rand(0,9)};
    }
    return $key;
}

      session_start();
      $_SESSION['secCode'] = randomText(8);
      $captcha = imagecreatefromgif("fondo_capcha.gif");
      $colText = imagecolorallocate($captcha, 255, 255, 255);
      $fuente = imageloadfont("dreamofme.gdf");
      imagestring($captcha, $fuente, 16, 7, $_SESSION['secCode'], $colText);
      header("Content-type: image/gif");
      imagegif($captcha);

?>