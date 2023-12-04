<?php
function translate($en , $kh){
    if(app()->getlocale()== 'en')
        return $en;
    else
        return $kh;

}