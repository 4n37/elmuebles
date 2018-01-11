<?php
class I18n{

  private static $content;

  static function init() {
    $fileContent = file_get_contents(__DIR__.'/i18n.json');
    self::$content = json_decode($fileContent);
    }

  static public function get($key) {
    //Default language is German
    if(isset($_SESSION['lang']) && $_SESSION['lang']==="en"){
      return I18n::$content->en->$key;
    } else {
      return I18n::$content->de->$key;
    }
  }
}
