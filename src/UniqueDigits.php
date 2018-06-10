<?php

namespace UniqueDigits;

class UniqueDigits {

  // четырехзначный код для скрытия настоящего ID (>1000)
  private $pin = 1111;


  public function Unique ($id = null, $text = null, $time = null, $len = null) {

    //проверка на наличие нужных данных
    if(!isset($id) || !isset($text)) {
      return 'Error. Empty data';
    }

    //проверка ID на число
    if(!is_int($id)) {
      return 'Error. The ID must be a integer';
    }

    //проверка длины на число
    if(isset($len) && !is_int($len)) {
      return 'Error. The LEN must be a integer';
    }

    // len 1
    $len_id = strlen($id);
    if($len_id > 9) {
      return 'Error. Very big ID';
    }

    // len 2
    $len_text = strlen($text);
    if($len_text > 99) {
      return 'Error. Very long text';
    }
    if($len_text < 10){
      $len_text = '0'. $len_text;
    }

    // разбиваем и прячем ID
    // len = $len_new_id
    $xxxx = $id;
    $yyyy = ($xxxx + $this->pin);
    $len_new_id = strlen($yyyy);
    $yy = substr($yyyy, 0, 2);
    $yy_last = substr($yyyy, 2);


    // по умолчанию 17 знаков
    if(!$len || $len > 80){
      $len = 17;
    }
    $all_len = strlen($len_id) + strlen($len_text) + $len_new_id;
    if($all_len + 3 > $len) {
      $min_len = $all_len + 3;
      return 'LEN must be greater than '. $min_len;
    }

    if(!isset($time)){
      $time = (int)floor(microtime(true));
    }

    $len_mtime = $all_len - $len;
    // микровремя умножаем на 2, чтоб не было сильно заметно что это микровремя
    $mtime = $time * $len_text;
    // удлиняем значение, чтоб было что резать на больших размерах
    $mtime = $mtime.$mtime.$mtime.$mtime.$mtime.$mtime.$mtime;

    // обрезаем лишнее
    $mtime = substr($mtime, $len_mtime);


    // формируем число
    // $uniq_number = X . XX . $yy_last . $mtime . XX;
    $uniq_number = $len_id . $yy_last . $len_text . $mtime . $yy;

    // если длинна больше 19 символов - оставляем строковый параметр
    if($len < 20) {
      $uniq_number = (int)($uniq_number);
    }


    return $uniq_number;

  }

  public function UniqueCheck ($number = null, $id = null) {

    $check = false;

    if(!$number) {
      return 'Error. Empty check number';
    }

    // $number
    $len_id = substr($number, 0, 1);
    $yy_last_len = $len_id - 2;

    $yy = $len_id = substr($number, -2);
    $yy_last = substr($number, 1, $yy_last_len);
    $cryptid = (int)($yy . $yy_last);
    $check_id = $cryptid - $this->pin;

    if($id) {
      if($check_id == $id) {
        $check =  true;
      }
    } else {
      $check = $check_id;
    }

    return $check;
  }

}
