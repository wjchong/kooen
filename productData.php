<?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='http://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"http://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('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');
