<?php

$fontSize = 40;

$text = filter_input(INPUT_GET, "text");
$fontSizeParam = filter_input(INPUT_GET, "fontSize");

if ($fontSizeParam) {
    $fontSize = $fontSizeParam;
}

if ($text) {
    header("Content-type: image/jpeg");

    function imagettfstroketext(&$image, $size, $angle, $x, $y, &$textcolor, &$strokecolor, $fontfile, $text, $px) {
        for($c1 = ($x-abs($px)); $c1 <= ($x+abs($px)); $c1++)
            for($c2 = ($y-abs($px)); $c2 <= ($y+abs($px)); $c2++)
                $bg = imagettftext($image, $size, $angle, $c1, $c2, $strokecolor, $fontfile, $text);
    return imagettftext($image, $size, $angle, $x, $y, $textcolor, $fontfile, $text);
    }

    function formatText($text) {
        $output = "";

        for ($i = 0; $i < strlen($text); $i++) {
            if ($i % 2 == 0) {
                $output .= strtoupper($text[$i]);
            }
            elseif ($text[$i] == "e" || $text[$i] == "E") {
                $output .= "3";
            }
            else {
                $output .= $text[$i];
            }
        }

        return $output;
    }

    $string = formatText($text);

    $imgPath = "meme.jpg";
    $image = imagecreatefromjpeg($imgPath);
    $color = imagecolorallocate($image, 255, 255, 255);

    $font = "impact.ttf";



    $lines = preg_split("/((\r?\n)|(\r\n?))/", $string);

    // print_r($lines);


    // imagestring($image, $fontSize, $x, $y, $string, $color);

    $white = ImageColorAllocate ($image, 255, 255, 255);
    $black = ImageColorAllocate ($image, 0, 0, 0);

    // print_r($lines);

    $i = count($lines) - 1;
    foreach ($lines as $line) {
        $tb = imagettfbbox($fontSize, 0, $font, $line);

        $x = ceil((502 - $tb[2]) / 2);
        $y = ceil((353 - $tb[6]) - (10 + ($i * ($fontSize + 10) )));

        imagettfstroketext($image, $fontSize, 0, $x, $y, $white, $black, $font, $line, 2);

        $i--;
    }


    imagejpeg($image);

    exit;
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <title>Sp0nG3BoB MeM3 GEnErAtOr</title>
        <link rel="icon" href="/icons/favicon.png" />
        <link rel="apple-touch-icon" href="/icons/app-icon.png" />  
        <link rel="manifest" href="manifest.json">      
        <link rel="stylesheet" href="https://lib.lgkonline.com/pill-menu/style.min.css">
        <link rel="stylesheet" href="https://lib.lgkonline.com/lgk-icons/style.min.css">
        <link rel="stylesheet" href="style.css">
	</head>

	<body>
    <div class="lgk-pill">
        <iframe class="lgk-pill-content" src=""></iframe>
    </div>
    <div class="lgk-pill-btn black">
        <span class="lgk-pill-icon"></span>
    </div>
    <div class="lgk-pill-wrapper"></div>

        <div id="app"></div>
        <script src="https://lib.lgkonline.com/pill-menu/script.min.js"></script>
        <script src="bundle.js"></script>
	</body>
</html>