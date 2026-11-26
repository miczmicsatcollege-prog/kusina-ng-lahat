<?php
declare(strict_types=1);
function seedState():array{
$menu=json_decode(file_get_contents(__DIR__.'/menu-seed.json'),true,512,JSON_THROW_ON_ERROR);
$users=[];foreach([['Admin','admin@kusina.test','DemoAdmin!2026'],['Staff','staff@kusina.test','DemoStaff!2026']] as $i=>[$role,$email,$pass]){$env=getenv('KUSINA_'.strtoupper($role).'_PASSWORD');$users[]=['id'=>$i+1,'name'=>'Demo '.$role,'email'=>$email,'phone'=>'09123456789','role'=>$role,'active'=>true,'password_hash'=>password_hash($env?:$pass,PASSWORD_BCRYPT)];}return ['menu'=>$menu,'users'=>$users,'orders'=>[],'reservations'=>[],'inquiries'=>[]];}
function withStore(callable $fn,bool $write):array{
if(getenv('KUSINA_DSN')){require_once __DIR__.'/mysql_store.php';return mysqlStore($fn,$write);}
$path=getenv('KUSINA_DATA_FILE')?:__DIR__.'/data.json';$lock=fopen($path.'.lock','c');if(!$lock||!flock($lock,LOCK_EX))throw new RuntimeException('Storage lock failed');try{$new=!is_file($path);$s=$new?seedState():json_decode(file_get_contents($path),true,512,JSON_THROW_ON_ERROR);if(!is_array($s))throw new RuntimeException('Invalid data');$result=$fn($s);if($write||$new){$tmp=tempnam(dirname($path),'kusina-');if(file_put_contents($tmp,json_encode($s,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_THROW_ON_ERROR))===false||!rename($tmp,$path))throw new RuntimeException('Unable to save data');chmod($path,0600);}return $result;}finally{flock($lock,LOCK_UN);fclose($lock);}}
