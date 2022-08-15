<?php
    $domain = "";
    $road = isset($_GET["road"]) ? $_GET["road"] : "m3u8";
    $data = json_decode(file_get_contents("./resource/index.json"), true);
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index</title>
    <style>
        body {max-width: 740px;margin: 0 auto;padding: 30px;}
        a {text-decoration: none;}
        a:hover {text-decoration: underline;}
    </style>
</head>
<body>
<ol>
    <?php
        foreach ($data as $value) {
            if ($road == "m3u8") {
                $url = sprintf("%s/play/?url=%s/resource/m3u8/%s/index.m3u8&title=%s", $domain, $domain, $value["sn"], $value["name"]);
            } else {
                $url = sprintf("%s/play/?url=%s/resource/mp4/%s.mp4&title=%s", $domain, $domain, $value["sn"], $value["name"]);
            }
            printf("<li><a href=\"%s\">%s</a></li>\n\t", $url, $value["name"]);
        }
    ?>
</ol>
</body>
</html>
