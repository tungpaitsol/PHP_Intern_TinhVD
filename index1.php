<?php
session_start();
/*--------------------------------------------*/
if(isset($_GET["lang"])){
  $_SESSION["language"]=$_GET["lang"];
}
/*--------------------------------------------*/
class Language
{
  private $_code;
  private $_valueCode;
  function __construct($code, $valueCode){
    $this->_code=$code;
    $this->_valueCode=$valueCode;
  }
  function getCode(){
    return $this->_code;
  }
  function getValueCode(){
    return $this->_valueCode;
  }
}
$arrayLangs=[];
foreach (TextLang::getLanguageText("lang") as $key => $value) {
  array_push($arrayLangs, new Language($key, $value));
}
foreach ($arrayLangs as  $value) {
  $code=$value->getCode();
  $valueCode=$value->getValueCode();
  echo "<a href='./check.php?lang=$code'>$valueCode</a>";
}
class TextLang{
  function getLanguageText($data){
    $keys=[];
    $values=[];
    $myfile = fopen($data.".txt", "r");
    while(!feof($myfile)) {
      $readLine= fgets($myfile);
      $strPos=strpos($readLine, "=");
      $key=substr( $readLine,  0, $strPos);
      $value=substr( $readLine,  $strPos+1, strlen($readLine));
      $value=str_replace(['"',"\n"], "", $value);
      array_push($keys, $key);
      array_push($values, $value);
    }
    fclose($myfile);
    return  array_combine($keys, $values);
  }
}
class Locale
{
  public static function  getLanguage($fields,$language="en"){
    if(isset($_SESSION["language"])){
      $language=$_SESSION["language"];
    }
    $listLanguage=TextLang::getLanguageText($language);
    if(isset($listLanguage[$fields])){
      return $listLanguage[$fields];
    }
    return $fields;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container">
    <h2>OOP bài 2</h2>
    <form action="">
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" placeholder="<?php echo Locale::getLanguage("account");?>" name="email">
      </div>
      <div class="form-group">
        <label for="pwd">Password:</label>
        <input type="password" class="form-control" id="pwd" placeholder="<?php echo Locale::getLanguage("pass");?>" name="pwd">
      </div>
      <div class="checkbox">
        <label><input type="checkbox" name="remember"><?php echo Locale::getLanguage("rm");?></label>
      </div>
      <button type="submit" class="btn btn-default"><?php echo Locale::getLanguage("title");?></button>
    </form>
  </div>
</body>
</html>
