<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/1/26
 * Time: 9:35
 */

namespace common\components\functional;


class ImageUtility
{

    public static function  thumbs($FileName,$SaveTo,$SetW,$SetH)
    {
//        $FileName = 'E:\MyStudio\PHP\xampp\htdocs\demo\hello\frontend\web\make.jpg';
//        $SaveTo = 'E:\MyStudio\PHP\xampp\htdocs\demo\hello\frontend\web\make_thumb.jpg';
//        $SetW = 400;
//        $SetH = 225;
        $IMGInfo = getimagesize($FileName);
        if (!$IMGInfo) return false;

        if ($IMGInfo['mime'] == "image/pjpeg" || $IMGInfo['mime'] == "image/jpeg") {
            $ThisPhoto = imagecreatefromjpeg($FileName);
        } elseif ($IMGInfo['mime'] == "image/x-png" || $IMGInfo['mime'] == "image/png") {
            $ThisPhoto = imagecreatefrompng($FileName);
        } elseif ($IMGInfo['mime'] == "image/gif") {
            $ThisPhoto = imagecreatefromgif($FileName);
        }

        $width = $IMGInfo[0];
        $height = $IMGInfo[1];

        if ($SetW != null && $SetH != null) {
            if($SetW>$width||$SetH>$height)
            {
                $scalc=1;
            }
            else{
                $scalc = max($width / $SetW, $height / $SetH);
            }

        } elseif ($SetW != null && $SetH == null) {
            if($SetW>$width)
            {
                $scalc = 1;
            }
            else{
                $scalc = $width / $SetW;
            }


        } elseif ($SetW == null && $SetH != null) {


            if($SetH>$height)
            {
                $scalc = 1;
            }
            else{
                $scalc = $height / $SetH;
            }
        }

        $nw = intval($width / $scalc);
        $nh = intval($height / $scalc);

        if ($SetW != null && $SetH != null) {
            //补宽
            if ($SetW - $nw > 0) {
                $nh = $nh + (($nh / $nw) * ($SetW - $nw));
               // echo "*需补宽" . ($SetW - $nw) . ",陪补高" . (($nh / $nw) * ($SetW - $nw)) . "  <br />";
                $nw = $SetW;
            }
            //补高
            if ($SetH - $nh > 0) {
                $nw = $nw + (($nw / $nh) * ($SetH - $nh));
              //  echo "*需补高" . ($SetH - $nh) . ",陪补宽" . (($nw / $nh) * ($SetH - $nh)) . "<br />";
                $nh = $SetH;
            }

            $nw = intval($nw);
            $nh = intval($nh);

            $px = ($SetW - $nw) / 2;
            $py = ($SetH - $nh) / 2;

            $NewPhoto = imagecreatetruecolor($SetW, $SetH);
            imageCopyreSampled($NewPhoto, $ThisPhoto, $px, $py, 0, 0, $nw, $nh, $width, $height);

            if ($IMGInfo['mime'] == "image/pjpeg" || $IMGInfo['mime'] == "image/jpeg") {
                imagejpeg($NewPhoto, $SaveTo, 99);
            } elseif ($IMGInfo['mime'] == "image/x-png" || $IMGInfo['mime'] == "image/png") {
                ImageUtility::pngthumb($FileName,$SaveTo,$nw,$nh);
            } elseif ($IMGInfo['mime'] == "image/gif") {
                imagegif($NewPhoto, $SaveTo, 99);
            }
        } else {
            $px = 0;
            $py = 0;

            $NewPhoto = imagecreatetruecolor($nw, $nh);
            imageCopyreSampled($NewPhoto, $ThisPhoto, $px, $py, 0, 0, $nw, $nh, $width, $height);

            if ($IMGInfo['mime'] == "image/pjpeg" || $IMGInfo['mime'] == "image/jpeg") {
                imagejpeg($NewPhoto, $SaveTo, 99);
            } elseif ($IMGInfo['mime'] == "image/x-png" || $IMGInfo['mime'] == "image/png") {
                ImageUtility::pngthumb($FileName,$SaveTo,$nw,$nh);
            } elseif ($IMGInfo['mime'] == "image/gif") {
                imagegif($NewPhoto, $SaveTo, 99);
            }
        }
    }
    /*
 *$sourePic:原图路径
 * $smallFileName:小图名称
 * $width:小图宽
 * $heigh:小图高*/
    public static   function pngthumb($sourePic,$smallFileName,$width,$heigh){
        $image=imagecreatefrompng($sourePic);//PNG
        imagesavealpha($image,true);//这里很重要 意思是不要丢了$sourePic图像的透明色;
        $BigWidth=imagesx($image);//大图宽度
        $BigHeigh=imagesy($image);//大图高度
        $thumb = imagecreatetruecolor($width,$heigh);
        imagealphablending($thumb,false);//这里很重要,意思是不合并颜色,直接用$img图像颜色替换,包括透明色;
        imagesavealpha($thumb,true);//这里很重要,意思是不要丢了$thumb图像的透明色;
        if(imagecopyresampled($thumb,$image,0,0,0,0,$width,$heigh,$BigWidth,$BigHeigh)){
            imagepng($thumb,$smallFileName);}
        return $smallFileName;//返回小图路径 转载注明 www.chhua.com
    }

    public static function put_file_from_url_content($url, $saveName, $path) {
        // 设置运行时间为无限制
        set_time_limit ( 0 );

        $url = trim ( $url );
        $curl = curl_init ();
        // 设置你需要抓取的URL
        curl_setopt ( $curl, CURLOPT_URL, $url );
        // 设置header
        curl_setopt ( $curl, CURLOPT_HEADER, 0 );
        // 设置cURL 参数，要求结果保存到字符串中还是输出到屏幕上。
        curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, 1 );
        // 运行cURL，请求网页
        $file = curl_exec ( $curl );
        // 关闭URL请求
        curl_close ( $curl );
        // 将文件写入获得的数据
        $filename = $path . $saveName;
        $write = @fopen ( $filename, "w" );
        if ($write == false) {
            return false;
        }
        if (fwrite ( $write, $file ) == false) {
            return false;
        }
        if (fclose ( $write ) == false) {
            return false;
        }
    }
}