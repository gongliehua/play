<?php

class Image
{
    private $file;                  //图片地址
    private $width;                 //图片长度
    private $height;                //图片长度
    private $type;                  //图片类型
    private $img;                   //原图的资源句柄
    private $new;                   //新图的资源句柄

    //构造方法，初始化
    public function __construct($_file)
    {
        $this->file = $_file;
        list($this->width, $this->height, $this->type) = getimagesize($this->file);
        $this->img = $this->getFromImg($this->file, $this->type);
    }

    public function thumb($new_width = 0, $new_height = 0)
    {
        if (empty($new_width) && empty($new_height)) {
            $new_width = $this->width;
            $new_height = $this->height;
        }

        if (!is_numeric($new_width) || !is_numeric($new_height)) {
            $new_width = $this->width;
            $new_height = $this->height;
        }

        //创建一个容器
        $_n_w = $new_width;
        $_n_h = $new_height;

        //创建裁剪点
        $_cut_width = 0;
        $_cut_height = 0;

        if ($this->width < $this->height) {
            $new_width = ($new_height / $this->height) * $this->width;
        } else {
            $new_height = ($new_width / $this->width) * $this->height;
        }

        if ($new_width < $_n_w) {
            $r = $_n_w / $new_width;
            $new_width *= $r;
            $new_height *= $r;
            $_cut_height = ($new_height - $_n_h) / 2;
        }

        if ($new_height < $_n_h) {
            $r = $_n_h / $new_height;
            $new_width *= $r;
            $new_height *= $r;
            $_cut_width = ($new_width - $_n_w) / 2;
        }

        $this->new = imagecreatetruecolor($_n_w, $_n_h);
        imagecopyresampled($this->new, $this->img, 0, 0, $_cut_width, $_cut_height, $new_width, $new_height, $this->width, $this->height);
        return $this;
    }

    //加载图片，各种类型，返回图片的资源句柄
    private function getFromImg($_file, $_type)
    {
        switch ($_type) {
            case 1 :
                $img = imagecreatefromgif($_file);
                break;
            case 2 :
                $img = imagecreatefromjpeg($_file);
                break;
            case 3 :
                $img = imagecreatefrompng($_file);
                break;
            default:
                exit('警告：此图片类型本系统不支持！');
        }
        return $img;
    }

    //图像输出
    public function out($file)
    {
        imagedestroy($this->img);
        imagepng($this->new, $file);
        imagedestroy($this->new);
    }
}


/*
if (PHP_SAPI !== "cli") {
	exit(0);
}

$dirs = scandir("./resource/m3u8");
foreach ($dirs as $dir) {
    if (in_array($dir, [".", ".."])) {
        continue;
    }
    $file = "./resource/m3u8/" . $dir . '/cover.jpg';
    if (file_exists($file)) {
        (new Image($file))->thumb(350, 490)->out($file);
    }
}
*/
