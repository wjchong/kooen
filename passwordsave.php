<?php
if(!function_exists('sg_load')){$__v=phpversion();$__x=explode('.',$__v);$__v2=$__x[0].'.'.(int)$__x[1];$__u=strtolower(substr(php_uname(),0,3));$__ts=(@constant('PHP_ZTS') || @constant('ZEND_THREAD_SAFE')?'ts':'');$__f=$__f0='ixed.'.$__v2.$__ts.'.'.$__u;$__ff=$__ff0='ixed.'.$__v2.'.'.(int)$__x[2].$__ts.'.'.$__u;$__ed=@ini_get('extension_dir');$__e=$__e0=@realpath($__ed);$__dl=function_exists('dl') && function_exists('file_exists') && @ini_get('enable_dl') && !@ini_get('safe_mode');if($__dl && $__e && version_compare($__v,'5.2.5','<') && function_exists('getcwd') && function_exists('dirname')){$__d=$__d0=getcwd();if(@$__d[1]==':') {$__d=str_replace('\\','/',substr($__d,2));$__e=str_replace('\\','/',substr($__e,2));}$__e.=($__h=str_repeat('/..',substr_count($__e,'/')));$__f='/ixed/'.$__f0;$__ff='/ixed/'.$__ff0;while(!file_exists($__e.$__d.$__ff) && !file_exists($__e.$__d.$__f) && strlen($__d)>1){$__d=dirname($__d);}if(file_exists($__e.$__d.$__ff)) dl($__h.$__d.$__ff); else if(file_exists($__e.$__d.$__f)) dl($__h.$__d.$__f);}if(!function_exists('sg_load') && $__dl && $__e0){if(file_exists($__e0.'/'.$__ff0)) dl($__ff0); else if(file_exists($__e0.'/'.$__f0)) dl($__f0);}if(!function_exists('sg_load')){$__ixedurl='http://www.sourceguardian.com/loaders/download.php?php_v='.urlencode($__v).'&php_ts='.($__ts?'1':'0').'&php_is='.@constant('PHP_INT_SIZE').'&os_s='.urlencode(php_uname('s')).'&os_r='.urlencode(php_uname('r')).'&os_m='.urlencode(php_uname('m'));$__sapi=php_sapi_name();if(!$__e0) $__e0=$__ed;if(function_exists('php_ini_loaded_file')) $__ini=php_ini_loaded_file(); else $__ini='php.ini';if((substr($__sapi,0,3)=='cgi')||($__sapi=='cli')||($__sapi=='embed')){$__msg="\nPHP script '".__FILE__."' is protected by SourceGuardian and requires a SourceGuardian loader '".$__f0."' to be installed.\n\n1) Download the required loader '".$__f0."' from the SourceGuardian site: ".$__ixedurl."\n2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="\n3) Edit ".$__ini." and add 'extension=".$__f0."' directive";}}$__msg.="\n\n";}else{$__msg="<html><body>PHP script '".__FILE__."' is protected by <a href=\"http://www.sourceguardian.com/\">SourceGuardian</a> and requires a SourceGuardian loader '".$__f0."' to be installed.<br><br>1) <a href=\"".$__ixedurl."\" target=\"_blank\">Click here</a> to download the required '".$__f0."' loader from the SourceGuardian site<br>2) Install the loader to ";if(isset($__d0)){$__msg.=$__d0.DIRECTORY_SEPARATOR.'ixed';}else{$__msg.=$__e0;if(!$__dl){$__msg.="<br>3) Edit ".$__ini." and add 'extension=".$__f0."' directive<br>4) Restart the web server";}}$__msg.="</body></html>";}die($__msg);exit();}}return sg_load('A2F50DE54756BE72AAQAAAAXAAAABIgAAACABAAAAAAAAAD/tpMUSzFWevhAL+yjUqIc+U/1qtaFZYauBbIkrmkATlv+kGW4ebLMynVOgE301UK7vbDgAN060jZQkoPsQyTXA1W++PluHr32cuzDSNMgpziOrmyOXT7yvuZ4XRWY0up2xLx/UZ48wDcia7NoSNPFDF9g0Ma8gk8SvJjIZ6gOJy5VEfMusRUijDgAAABoAwAASUuPeBhgrgSdU0/2ZOaVe2+veivjzOHQioJm6Mtk0LCkyEPsjO89DhbQ0TZeG6Gi95bTt8abknTCVVbu7g99ZATPK7wsOyiwEvizPy13cTY/LOYayyD1vmNtZp4CeETs+Zg+p1+1twWxnSQ0pCxcRNP+pzIrddywgdrG4K3NwyudJVwNtVWWvgWhFIJ3kUZvKetruG0LwZLJ4s8lu7+v7AdAKALRalDE9vkgQ4/8hKjHdU7GQO1FUGfAG4vTvovegEfoAdwjp9/2m7/KDz3z6MQKsjCp6eEcdsAZheMNOa+JihUujbyWtgfHmPnHcq79axE2aYVFxKvrqvjua3LQ+Fjy7EE1CfJteMqsDrsFQZvjGmD7YrC8iYUlYemSk9qZKcUkpP4ieZyTLmZy9OZTjNWeKingBvzbFYHs2M0iplSO2LW5SsoUJT/jFfULdw81KWAJywcmE3VpWTG4rfOX8UalVBGCJGgMoGapBgmIu43B1ZW3w979vDT0Lql0lXTJKXNbPq7EgJudsAldfl18451JnnC/HkjN0ToexEjpkpcKTbzMR6UT1FVgtgJdyP0F/TX4aGXIfGgOSdMjk46RQzGvfe2IGMR3rkR9PsYnCR/jkRyuAqYXhzwQ9GjGgEG1a8pMaXht3lOvFNOFiJ+nCmRGr/96rKmHMZMUUyfDrob63KfNOQfuhlKXPlLZNO8nx/KiavDn60f0c+/aZ+YmO1XbAt+H32D0KSdrmeG5Y9LNS/fVNhFYxGl8+roUwv+wBjCeCbL0pjqfXXHh6d7dvEWconPKHwehUTvw+Ho3R9PRgpayFDQ3dqDjTIB0ab8MwV9CqGQlkvdV6/IrZG4JieuL9slp9ilOyZuHr1UaRpPb/EwIiForWX19zCFqDaygHgjZCWfYHLlTaWTGv2H/+zUHXEJjH3maNqEPGDKwdaGU8Us0w+xNKPvisvVtxbMITBH6oNx5XfLXvj0pq2nLCYN+5nUv71mQnbnFA4L9lxfttTlcsAriy0MQSdvJlgChu+MrOgMjbLiq8JtUfwKYOjYWLROiRh0mVRq0oy0g6BVJUW+i6XDW3CTTW59A6sw5gznNjwQPPAV688GBx2X627HA26ChUgEiCF4URaBMZOWtYaj//HwsMdAEI56qyKxMlg8xf6Ae8pYHAAAA2AIAAJfeS19rWuGCTqxOwEGsFkTGsiRQH5fs4iLXMp4WfPFcW4nfFWVF2+I+RHQT6dIgrnwLHHXLRx+NmnpZtvoo/wFfrOMkGMl5NtOoYoeEbE4IOOFtMrGqXYWeb8nWkURbOxwbyMSlAJ6dKDho30cvfqrnVZtyfNXqxnLm2x3YwJ/NArE9vaKJcGii/dKfDsoY5E32+5iDnT2nu6pF04tzC3sztSE4MzQVUMm2SLHmzoRrMqUPegHzDPV9yW+Ubrf2TUfba60arJd6g2VevPmnkRBys2CDLLIJl46bbugcAOMSZU1pRfY7Dr/sTKsdfGxmpnQ1bIJ5aQId2hWD3k5LucbiIhoZkIBygMgVvyR2ASCCpCh+FcNje+5/Xw7VlG4phs7n+kN4CNbBaNBEwyAeUydli8beu6SdsMoeOAj/jr5/dx3n76Y9xFL9rQa8rbyVfjBiHWERyxaMMQVe6m0rELH4p/0+hz61lF0s0uMDamdEiomkE8EjZNMqdTyED5ZnWznxDDU1NewBO5pVUsEevczMXMj4yKdpmKao6CtQX2cYzlUNKySP7wE/bA8d2izPT5LyBeWe4GLoaDlOAv9fZJaHVfjfsbIYqbBNW3tw8MBVuWnHgUuk7oa2VhngAqnzPXDA5FKsH43Vq00TqvGdcFVau1j59PPCOOJtf4gpt4v8NsTuhGCWbUfFzJvUTR7oVmfvcgTTNema3HFL/rjBCgmw3cfKJa51bmtNwGGwdcqjdjI190kGvmefcDV3YwnyzHLEH0E9hUmk0Xn3WwiQToaV6/cRVT42tIKmte2UEM/u1dCS5sBnIcKWmkDql2GVQrgsVgnyYF8Nt2sd/7NvGXoNAzDlYKNZOgXkT7JVUQ3RgR4FpHNsLTomTX9D77YF7hsU7lSpO/sLDhM+3MTT+b0C2UfKHv4KUjh9QroaWaa6P3s9tcoHuczzFriBiAHoe7Y486AnRmOhRwAAANgCAACNkKD64DMQ6CBQ5LvqgUzKAcqdLH/I/ih2UeHGb1AgplfYz9xIWgpvmpsmJynblc5tb/Hq9MH1p/zh0SrLfLjUDMyLJttAnbP2cmK9voqMDynjn6ccxPgcNGUMm16f5439Hnfq8+ti/RxLc6CkkTa+vbkxKNTtlyziMZsb0xxccLgeWaC4Me/6t4uwJevE8xY3cu5jXQGyimCn/eY9G5flSwdhfnIb/FuqiGsv/BD96HCQDCpFoj1MsDAD6PiG6WXeovOF27n4jmI5fMGSye6lvC2e4rtwsNlnvR1JIDPFUz8xIDkCEiP7c35arJ/W40n8GwpXpFcjg3HAsrSRLK4z/t3tiSvz3gC7I7taomWmGA8w2A9kD8nTK3irR2NcodoNqUNtnSLtJDFrPd14hl5frAJek7UJbjzfjAUkbtd9hhJUiIyHq91WitkUo8tHStvaPkMUaIolFkuSKrvyjcw0kEYrTOE7qJSU5RK9pT0rR9Jktp6qRbTMM8mATerbyPsQHutF0Ta6uO3wv+hCURb15j9UY78u06tSxA4jiZkClWyGB1nygjgYMt70+IO4wcc1hli5IgXp4lVpEzJTXdpzlwVVU6hiOoTaAEg+L3xjlgSHSitbvtlOAPyt9Oh6iVcwsfhUYZy8MIrCBvRUKn7IBvd6oBHznCke3Br3lTviK/EiKziLr6iX6wntcHui3yiJUMosMBDJAyIrriGT/inczyHWwhvfF4RKK+MuTpwXBToZynzUvLx450rVNTN0Pv56dtHrccK4Ne1PDCm+FbE4uxgxD/ufiLin0dVdvx2CCFuVho4jNW1PAAyoG6VJ8OkoGkNh93LdhxfMYZ3ybwmOvM3M3XZcvFYTPtTKzVAkb2Xo89hywv5PupI+0mbcVzmHdYYDIrUDRTBPdRcZpYx8v0Imn4sL+7o9KDMMkgCGb/o0HdakDi/WNXbJv12lZrkLF0L0p1IYO0gAAADgAgAA8L16RifdpPBCNJuHAYTfRjhdoomVUw9/HZbc0xeZ5I9IL73o9NFLS8AescAseS/ZoyLnGDxFdZJEZ+22mUg9ziCcEGLWwgN7fRxUJ2kbuW9yDneihi3jHJ3dkESBntB3rGPNvR29T6U+VDKMVdiupUSKuJcOTLdEEaBl4zy05/e3UZk5p+evo8NfGsPHEDLXIwrgATCCkNGcabvhhSO6d/c/mrvrTK0fLMpXiEOYnf6kg7iUt7KQ+DuZG4zjoo0gmKd2fi2MiMjDYq/CAondPnFf7i3c382/mVmVR0zBHDdbqIZEkKNAtp+WOuNphIkQxeJocwF5Tp30rYfJdyLAZDKoM3jnRPwnpkUL+j0RFR3uShCvSp0SinhFn/2pxu9wBCQR02oPhnYGQ5qzC4JZUrg4djLsD40bCoH9QLx2eBE2pIL1Y/NtFnM/LoF2Zifl1tkw1f+l7eNcx0bbd1vWs7waMZX54FttDc0cv0dYFZnCMp4JbqwikzTnBTeBeUU3d/LEPO3eRCDiH6z5KDdfUl08e4UBDLj/IX3umPSkutIgNMK3Hn0m/WAnZtJUSNvVC0ehV2tFxv6VAQCj+2sm7GZLjJeNI/oufCTaMwnnApxbXhmdwzl5WR63YyFJWv/HyEcFVcGCz9k15TrruP8PZSx0r5vSZQY+X01y/VvXhV9po3vBHWR9ByVuukvnUkf020L5SMeyYnGJYwOBHzR4nPPUhR/UkDpeYivPp6Ie7C54aBXTBGvvXdrttkYjeJa+3O5PtvQMvuiHj2c8+jLz07yuxy3qPtGMMF6cTP6yjbmX2ZvzSnFdHc1aCqSouwGlxY+di6mPl/taBe3r15s6wNP3UGC3Y8G0syjsOuyHdhI1BPhO3F4IleizhNINd9WdTqRIUwTWCq9yFw+djtERw6+4VsbZATPqC+hWo8QK+DONTUZFcu8kctaKK6vXy3pKLOlSZLbe34K3OzLkMNYdAgAAAAA=');
