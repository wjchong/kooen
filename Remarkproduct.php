<?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='http://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"http://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('A2F50DE54756BE72AAQAAAAXAAAABIgAAACABAAAAAAAAAD/tpMUSzFWevhAL+yjUqIc+U/1qtaFZYauBbIkrmkATlv+kGW4ebLMynVOgE301UK7vbDgAN060jZQkoPsQyTXA1W++PluHr32cuzDSNMgpziOrmyOXT7yvuZ4XRWY0up2xLx/UZ48wDcia7NoSNPFDF9g0Ma8gk8SvJjIZ6gOJy5VEfMusRUijDgAAABgBQAAyOJQgAgPECUWawnT/hOcpQWU5dWR+hEP18/+YoWO8NOmsMflk8vQEI9hGZVyfIdo2gsyCqKDmcEhDu3z62DLxPHjtG1ZPaMxHJRvOQYnKq5/tCSz2lO0Du2xqidals7crC7lzMl1uWIbu8X7ZYhgPmvEAOqQcuSdoeRw4iJNN1leLImuROrkqZbR31mKiv9A+HuAfxjFAWX/bRjubpm8JfgNIyXOdk2bqUKCu7rupf3D/vXuKDsCCWwROiPupABOu8CdQVWnQtL0k5te1cfu0tWdUEMCAhFV6k6b/l5cDiPBJt4DhZUBJoMKy9SqNK1qSQO4CPCrRFMsXArEcX9VmDPE3mSeEmQ6EIMtpHH6fozuKHWwRvipdRbJ16KJGJxtpjCqO7RwPL1vr4flr9Za6U8g/1VUE2OBZhJ3O7vc2X/Vr823a+s2k9NUlC+t8CxWAKNpsomehdAYYJMlhM/ZMaZuuyHD+PjW3AT1hRHdcYdUfgchlT4+4rax+X7YnOXqegkP9zpaMhMWJoMzIAZYPazaGnjHMiqI0Gi2xxszMtS6gvHWsYFihXuWzuUEbzwVUQ/Z9AQSJw8VtRWnhO7+dYMgl7wVZICzF3J1nCvmNn4ELju7LFBw6/iRWNHpmgVmpQNx61kvP58oW/U8Tgc7esLcTnVhCT32SR2roH27o5wI8wuF3dkKkA4RCVkoWaHQp9MHrzqRzngGqxn7mtW6axbpM2IydzSpg7TSET/lVMNoloS0lp1wHfXRsnWNMx/qLe9/VCxuHnW2PjItEG6gcedCdKl0wO2JVQU3jKZfPoBsFOvBbhSNimj6Y6qLcvmy9ht0lab0U3LExbBIDHYQNmBDPrTv4D2UesmjSzTrmacrpEpQPscym9tToShvRl5UnJTus7+OOZ6C2iXdjBd/vpDVwHYdc5mmUqXZAgs5TqgKXLCgkwOHeESUng/Pi9jSqcppcn3gUMyImDX0avx9pkGF4Yc/EEOPM5bRZQHxV3p//ny03fw372sste3IQYg0tJumi1gvcPCsA3rqByt4ePt6ZnpPSCH0+tzt0Ney8y6qYBOhN6JxZ1kM3qjczd+kJnslRTLRgfbI+TKyyl1rBI63AXrJTehRfWyfOZsMPluyhrXY1BMsb/NXO5bTIyX7Jh18vyIn2gCk5r94FQ8QsIhMPzeob8n8ti6tcGGhPNThChQyKT/vlPWARK/dgsgL35u32Sds0fch9s9zhfotW1f8pq0MByWBKRTa0ixeaHhKPueZcYiDthVFaI/J+aQcpWWaM9IDHGYw4ZzlCCLakbfRdZeiJPy/729K7WI6RViNCBF5Kdg8Wh1HWeybGMTwO8xLAcKIZv38o8q4xXpVRCc5HvM+vDcfH+o5fyYs2FFqFcsaI6WxVOtTsCv8BEVayZXsBu9Ue/uKWKIsZcLHFVMh5UFOwSVoZpyinXw9Rw3zNdMVdZ8hJ5NiAJBdWJJkCeAoHpeqjmtgVcHRqyn1yzUuytANuxxfoHoxJ2LyYypWb2lUMW/cGFT8WP9hYWwA7CJOYbeX4b4azzoX3m2QoXe/75Ug+BxZUCgsTGUV+shBpZzzher8ccqOU98a6xDq0V4TgylNmJAB5sKlbG/6nyX2Vysd+PJ16Ms75io38emtrFPplRIaELX9qZoK+qErSSSTohmvGZwkrD69XepIUhgDuC7qDuHykCMwpKIwLmT6OkfBq/+DRbAo3nrOvdV7N7QvuQMeOzGe+NWHf9JeQouAx+SRvw4pn0LShE7VyKCuHq89Jw9qWGQ6kb+zbp30a47n0nddRT5Gyy6QUJhUmNkhlkbUgutZd6xagMkk0zAHAAAAmAQAAFISo12D9YJOnq75ctHn8YZOjh1zmMRp1hSfIcFw+hkjfOEk1Ayu39CDWmjhVlMSjlu4aaxEE0biJgDzdeuWUHVO4db+WP5bUujwRZPGVj13XuVWbV8U3dL7m8FuoMc4vLx+yLunOF3SWYxkRmxLKkwO+OQ4l2LhXhlIqd8/62NPmzuZs9oIbG3bAYsKZ2jZ69b0B9EvFWwSOGZOAkU1g/11uY/xLQEQxkK0eTGn6VlEQERnPDazfz9kafNCj2HHGqRE+E7dkdurXPVO+Sy0iOMMEz62DOxbm5720er5cZ6iV3BBoF0Et17NqwGr5+g5GCWBdOyWM7rFoaYQxv2048XyM0n/OPizKMN6pme9ALAAGHJz2qVl1phnHvI2yDaRdzXc9y6QVFBv7TftABKzZLLktFOEq6iXcAMEDP/ZcgCxpFcSPfzvfASrx0f7dRNq5qcNnwJ4CguI7wWyJyDlkoAfgvUh+q31Bu4I57gY+iPkwjoW9vRELEjiIKuZwo626JBplOZ2nxJGUSD5lo2tbuBlXBWS4QsDssdpU1VH7UTX9nd4e4sotJMKr1RTflNIhmQp1iihYo91Fzr7PUSMs2BdUZlRHgzmMmfYb9nGtLOa7d64b6/Yb8tHrJkzNo/JdKrXd7uTWHiNvSw5C3HRiOOEzaE6m1ovM+DNPd7IP/Wm06/yFJz4myejX5Botjh6bfjA0IEGQYMzxpD7+u9gB4nd9UfKGQOqsjgPCUNy23w1eafX6xk3Qd59wrpnrABPzTJhD267nParEqUT2ghi7kGe1TFFCM1GhgH/FQGFtcUMOgFCA6nqYQDIiD+G/pq3Wx5C6HNhU8YmF7iKfndsWHhn/UCYvmM5o1zS6yfYIk6Sgei6ce7QmTVSyhWpZohcZhxjZgZ8I2m8HXzXxKXtHQQR/eSN1w39EiauVGhLApu99aq+ViduXcNsNxZpqnXk92VTxWq0CQ/5pca8Py64hWrUgU/jR70F2FOzQsn9jPp58o2HoBVZf4RziqwwgQBJVpd6uScWEE8UzwqPow7Te+YRIsFh/6lyExAatYQAca4kBBf1aq/ci4+WX1ttIaCrpbGlUMXKW1HthQn4tb+h0SSp0B70pMhbemSlBYIRVkC0HtkteaIp2PWfohcvx6RANAjDZUldOjcq4cLStwL2o4Kk+PHQFwU3vVDKGp+XSUnq/om5CorKv9CxML4Z9nw+oU1cwXh8TvFIE2zAhYl1W0LoKNxvYA5xQFn7Uj7zC+rWIkJS2Jcada3V0zcd4aLr5gt5mmNsnma8fRVbStFiWetPJa8tFT2LNWwrazI+XlGQxE7YreJ+XnmVvr+K2kifTi/JX/sHfcLkJgYh1Y3Olaj6o4FDSpMpSxQ8iYUsD90JbqXZLS1GFwTVBqBSpr+tPkYEELHaz4RRXIHXH5KwyY77HGs/fiPjduLVJAHANsWBgSYyyCvvAU12rASPkZfjlEICbMkFwukCkZHSCckEp80klPAvzkeotjAQD6B5uKv/ER8R+ITIwDXNouKU9kckHVHS5u+h5WnKxv8P9EUzpA/TPrxOrPHc+EcAAADABAAA0QYKJIwJVMMm/wht1XP3/pVwGekFd+j3eNzm1fK3LwGlnXmvtR5+O5c3dRLYXgPloipwfyM9x9vEwBlEucGQHxDoFNE4PRCylHTlUWWortniPp7H3y3vQKYB0ydgg4ZYlQPQOSFN8B8/FUTX4S1XTR1b0dQyjyzXeuP8Oecf4n+l/AiJzflXblwUT06IHJjqqMJFKk5iPzHqg54SixduT9y125w3Wru164YpL25yK9LRZ8EjVcjTnJKp0NzZDgxGd0u1iSNS96r6P2AFDcnIXzRcqUimkd7RFymvExvl/6EpEil5A12WkwqcBkg2xnCvy86Cv4UzBt/bCEnMGhSszySN82SHaWkhKl5IsYSpEejHGnVYEYlETcNwIZRIMHyoLD3A7UkjC1hNnIAJNinB0+J+sguEpXiKnZr0npRVDs9a2Ddz+LGPKnUb4juE/9KaNNTFE2jFAHCAKbt3bYycJHCNs1Nvyg6xISAMYZrvkI3kX4+KDfuQt+TZRnjC8gpPGi/eFivOaHAv0O8b6Nmn4wQrC8s6KQ1dTfWDHFi8fJXGNRSiohodTMMxNrPgPQosIHM14bR3hX6Js99Lm7Qr19Omzm+WaxGcpQrm6673u+RPw3xgMbGB7kh5yBK5uCR3fOcQnWWVv+7orQTbuw4NvvtRBUbxt02b3bhv6VIT9YYEgHOBKaRwcKPACqKdPpdKcsM1hC4ZyUg4+fgDgm7Mc7RfyByytOORS10YdLRzD2yOE30Ern2qF80UMlVaqoy4Cqzw/xhgKvfB/TdVcAZEE1SG2V05GodT3rkX4DCNBIn3+RQwu4qYOyam0MukGwYLjSQdV1qi4GkHBSm+5SbAoKv2AdBoAG3F/SaKqYDK+OZAwe5zUSFAkBx1fmRfo9lOXeXPQbnnNwp2Q54/8adEzy8ukr24OoWjy0bI4k3HXotdA01iLYxG6JqDGvbsgLRkVi7O3oHYbtyiUeGpaPjuDJBCzXHo+jotQfhk1UpWNPjkAcEUzVzOdK/eh/qXJ7SQz2L+icpp3fFTRhLG74ujMyyk1PG94MPtZwUQOF7yOAXS8D69m68zicdvhYckppAWDUSCAHy9KkhznA4nJWpRm09yLdTb8ypJjx0Lcxh1RVdUCkcu50DjYDvAhNCKC7cDLcJmvYko0urjjR6II55f10vWzU2xTZsoV8mddNIvK+QaZCPQaOE5kDlQVlkM/29uLfacU01ZrhPPKOqC974/liDdAtAT+fVy28TUFHr8TQ4wSCsQ3VjYkfcT0g0u581ZQEB0yFMYwI/hdWnYOS81vjBLMquMvjgYkDfx9bkTgsLm5xL+hKx32O3+cWhdHZCBxNkTV+md98PbkBi1M3WjmlOpBrmZvMiPb7O2nTbTHzauG1OmVZTcsb8vbyKf9iDsaZM8tJ9O+vvABA1PiCPt14ANli32RP1g3KqGea1ymC65Pej+uomOTSqptiPrUntBp4EIx4PMWOhLAvPtAjck7C7u3qhYdy3PrBQOgOtwAnXYx8elLvrBtlaITSwz4zuh/YmfNXCLjaGt9TxztGqB2CYBp4G9w7WcHTfdyEOBUIsLgCNwpNRYPVwWzf/utbr+mqQxXpVDhcnN8OE2SDTNyUgAAADABAAAyNzmB06oxJRZq3pFGyl5Px6sgmHevAdeO/WRSzYGSwZHHKl47EFKbFauY3X2b9+fsZyanrHoTz/DEdGhsQE0ZbdCu60/WpS9E86CJHdPYHgCvrlQ5Gu1WWiuFYRUruXCxxJZnKPg2ZV10yegTUKimM9liNrlhUOA6A3vYC2WoH08IdZzHyiXnmeFZDF5KMuGaqTiWbSgyMlrQUI/2oWr6j82k+wFdnaDd3MK0OiGAfIsXBI3Nb4hg93koHrZLxfgFgoaDMBQqXigW+g5tbjcVEtSUKRtmFh/EJ+ukR6JdcqVrHb3zVn8PeZagflCorL0sqDcFS0GWH7hon2mJOyxXcZviM/CkZW8rAELye7C/2V/ty4QSE/mjmppTsNzBRaPQfL30B9ojuA5MwUVa64xta2O16MsWuO3/pUvbTa2iB38b5uL5kPs4Y9pORrt9lLYCxjPfoLtjZcM1HNIkFTi9eIZHN1A47KoA9n/tgJMnb29AJLI6k/zBNa6CFHxIbXa5q3InhmU6h10+b18xXvGIeuzyucF0RB73DSUvAcZZY1k9RjZ3HVBloh6zxZqPZzPpvrejlqyYpGdyXQGRzQ4uWRYxq4zvHNT3LSIWHWq2Nhw5KnItCnM28uCE1K8K/PryirIWOGTMSpceXT+F6O6XhbcM7uptBNh65aRveESIG86ouUloCK/E3zll3di0syckgsQaBSrjd3qr1Tol8hE75oICdSFFNhgAdJ1jlTJhS+jFaeeE7WkSe1qKe8nsYdotqSabJjYFd7t7xZJyCymd0S60l1ap0vDkx8x+Qk6cOcQWNqs2SoVfz731ZIm7/6kbn1wEQF1F2GZ+C2nVizwpbIG4Lliv4S74xfosONeK7aNv2pT+H9t6skNuLesk72s4W4qG4+DiFLqvHBSLSN9Dtz6zu+r1Dm2F8kEmgB17DSc0EMfD1/kfneyDB9JgJNhCZQ3mCvWlHruPCrdaC8Oq5YP5xb6CqSHKRvUnixCTfRso65d+KAnEY+03hfqB2l3bSsjZ2yerGtygX4RVfWCUS2/RpZES6Fk6e/xcgJTRbEOl1zbeYF/G4YsApYx5ZtQMZT1rUHx3PBL7SC9sikUU9aHCSKPtbloWMokfchnPXNr5jEi1gT9JYit0jW3VjB0M0CsHWqpfZe/4LQkuZgkRQQhH0VnvDClg63JmwYHTQXC8sXrns7p43rf0piglMLkAZXCc4RBMWIAsFBIdb9TIbFLnhqbPJ0ffAJywCY7wMsOm6po/ySmytGopDgylllqN90jATpEEVXoLGvh8Ctmfzbaw7Wd75oRgYWPHbtBbnFv2RwgMwNpZnQciUw88vb8F4E4bFn2+Rs4jK3VCeAhauWNOn3yfEBA1KS/n2/A+eWIfEXnv8oInwk3Hrv5iOvDVAHdR794yeTVSSus65V1hiPiOkMf5ZkISaawKlloM0UBAX+cYrhY94X/fJ4G3kYficW3LHAEJ/C3xYwuYRNZBTuWF7dg0YYdaZrlU6jmKF6NLrE0Hohb9QSssJp2xl1BuvnZn6ijqK3gSEdA7EWERU6KbkwOQNkLHNer3lF5ChJlrZY6DkbhWXALFTYFRKAvbMd0emTcC+GxiLYBJeSPNwAAAAA=');
