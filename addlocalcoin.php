<?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='http://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"http://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
