<?php

namespace App\Http\Controllers;

use App\Utils\Uploader;


class FilesController extends Controller
{
    public function upload()
    {
        //上传配置
        $config = array(
            "savePath" => "uploads/",             //存储文件夹
            "maxSize" => 1000,                   //允许的文件最大尺寸，单位KB
            "allowFiles" => array(".gif", ".png", ".jpg", ".jpeg", ".bmp")  //允许的文件格式
        );
        //上传文件目录
        $Path = "uploads/";

        //背景保存在临时目录中
        $config["savePath"] = $Path;
        $up = new Uploader("upfile", $config);

        $info = $up->getFileInfo();

        return json_encode($info);
    }

    public function show()
    {

    }
}
