<?php
    $domain = "";
    $road = isset($_GET["road"]) ? $_GET["road"] : "m3u8";
    $data =  [];
    if (file_exists("./resource/index.txt")) {
        $data = explode("\r\n", file_get_contents("./resource/index.txt"));
    }
    $defaultCover = sprintf("%s/none.png", $domain);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Index</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcdn.net/ajax/libs/html5shiv/3.7.0/html5shiv.min.js"></script>
    <script src="https://cdn.bootcdn.net/ajax/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.1.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
    <style>
        div.caption > p {
            text-align: center;
            margin: 0;
            height: 20px;
            overflow: hidden;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar-collapse">
                <span class="sr-only">切换导航</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="" class="navbar-brand">电影·专题</a>
        </div>
        <div class="collapse navbar-collapse" id="example-navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="">首页</a>
                </li>
                <li class="">
                    <a href="">专题</a>
                </li>
                <li class="">
                    <a href="">关于</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="jumbotron">
        <h1>欢迎访问</h1>
        <p>空间超大、给你不一样的超豪华体验，有它还要什么汉兰达？</p>
        <p><a class="btn btn-primary btn-lg" role="button" href="">了解更多</a></p>
    </div>

    <div class="row">
        <?php foreach ($data as $value): ?>
        <?php
            $value = trim($value);
            if ($value == "") {
                continue;
            }
            $index = mb_strpos($value, " ");
            if ($index === false) {
                continue;
            }
            $sn = mb_substr($value, 0, $index);
            $name = mb_substr($value, $index+1);
            if ($road == "m3u8") {
                $url = sprintf("%s/play/?url=%s/resource/m3u8/%s/index.m3u8&title=%s", $domain, $domain, $sn, $name);
            } else {
                $url = sprintf("%s/play/?url=%s/resource/mp4/%s.mp4&title=%s", $domain, $domain, $sn, $name);
            }
            $cover = sprintf("%s/resource/m3u8/%s/cover.jpg", $domain, $sn);
        ?>
        <a class="col-xs-6 col-sm-6 col-md-3 col-lg-3" href="<?php echo $url; ?>" target="_blank">
            <div class="thumbnail">
                <img src="<?php echo $cover; ?>" onerror="this.src='<?php echo $defaultCover; ?>';this.onerror=null;" alt="<?php echo $name; ?>" title="<?php echo $name; ?>">
                <div class="caption">
                    <p><?php echo $name; ?></p>
                </div>
            </div>
        </a>
        <?php endforeach; ?>
    </div>
</div>

<footer style="width: 100%;height: 60px;background-color: #f5f5f5;">
    <div class="container">
        <p class="pull-right" style="margin: 20px 0;">
            <a href="javascript:;" onclick="document.body.scrollTop = document.documentElement.scrollTop = 0">
                Back to top
            </a>
        </p>
        <p class="text-muted" style="margin: 20px 0;">
            &copy; 2020 (使用Ctrl+F搜索)
        </p>
    </div>
</footer>
</body>
</html>
