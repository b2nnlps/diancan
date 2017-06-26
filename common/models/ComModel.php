<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\models;

/**
 * Description of ComModel
 *
 * @author Administrator
 */
class ComModel {
   /**
    * 只保留字符串首尾字符，隐藏中间用*代替（两个字符时只显示第一个）
    * @param string $user_name 姓名
    * @return string 格式化后的姓名
    */
   public static function substr_cut($user_name){
       $strlen= mb_strlen($user_name, 'utf-8');
       $firstStr= mb_substr($user_name, 0, 1, 'utf-8');
       $lastStr= mb_substr($user_name, -1, 1, 'utf-8');
       return $strlen==2?$firstStr.str_repeat('*',mb_strlen($user_name, 'utf-8') - 1):$firstStr.str_repeat("*",$strlen-2).$lastStr;
   }
   
     /**
    * PHP简单的文章标题字符限制，一个汉字2个字符
    * @param type $str
    * @param type $len
    * @param type $suffix
    * @return string
    */
    public static function cut_str($str,$len,$suffix="..."){
        // 此处设定从0开始截取，取N个追加...，使用utf8编码
        // 注意追加的...也会被计算到长度之内 
        if(function_exists('mb_strimwidth')){
            if(mb_strwidth($str,'utf8')>$len){
                $str=mb_strimwidth($str,0,$len,$suffix,'utf8');
            }
            return $str;
        }else{
            if(mb_strwidth($str,'utf8')>$len){
                  $str=mb_strimwidth($str,0,$len,$suffix,'utf8');
            }
            return $str;
        }         
    }    
//   /**
//    * PHP简单的文章标题字符限制
//    * 注：汉字一个字符长度为：3
//    * @param type $str
//    * @param type $len
//    * @param type $suffix
//    * @return string
//    */
//    public static function cut_str($str,$len,$suffix="..."){
//        if(function_exists('mb_substr')){
//            if(strlen($str) > $len){
//                $str= mb_substr($str,0,$len).$suffix;
//            }
//            return $str;
//        }else{
//            if(strlen($str) > $len){
//                $str= substr($str,0,$len).$suffix;
//            }
//            return $str;
//        }         
//    }
  public static function hidtel($phone){
        $IsWhat = preg_match('/(0[0-9]{2,3}[-]?[2-9][0-9]{6,7}[-]?[0-9]?)/i',$phone); //固定电话
        if($IsWhat == 1){
            return preg_replace('/(0[0-9]{2,3}[-]?[2-9])[0-9]{3,4}([0-9]{3}[-]?[0-9]?)/i','$1****$2',$phone);
        }else{
            return  preg_replace('/(1[358]{1}[0-9])[0-9]{4}([0-9]{4})/i','$1****$2',$phone);
        }
    }
}
