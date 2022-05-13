<?php
function outhtml($return){
?>
<!DOCTYPE html>
<html>
    <head>
        <title>验证码</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <style>
            .input-text {
                width: 256px;
                outline: none;
                border:1px solid #eee;
                padding: 10px;
                border-radius: 4px;
                font-size: 14px;
                transition: 0.3s all;
                text-align: center;
            }
            .input-text:focus {
                border: 1px solid #aaa;
                background: #fff;
            }
        </style>
    </head>
    <body>
        <div style="max-width: 360px;margin: auto;text-align: center;"><br/><h3>输入验证码</h3>
            <form method="post">
                <img src="index.php?code=get" width="128px"><br/>
                <input name="code" placeholder="验证码" class="input-text" style="width: 160px;"><br/><br/>
                <input type="submit" value="提交" class="input-text" style="background-color: #448EF6;color: #fff;" onclick="postcode()"><br/><br/>
                <span id="return"><?php echo $return;?></span>
            </form>
            <a href="https://github.com/WOLF4096" target="_blank" style="font-size:14px;text-decoration:none;color:#777;">Github</a>
        </div>
    </body>
</html>
<?php
}
$code = $_POST["code"];
$codd = $_GET["code"];
$user = $_SERVER['HTTP_USER_AGENT'];
if ($code <> ""){
    $cook = $_COOKIE["key"];
    $key = hash("sha3-256",$code.$user."WOLF4096");
    if ($cook == $key){
        outhtml("正确");
    }else{
        setcookie("key", "", time()-3600);
        outhtml("错误");
    }
}else if($codd == "get"){
    $font = 'Res.ttf';
    $intg = rand(1111,9999);
    $key = hash("sha3-256",$intg.$user."WOLF4096");
    $expire = time() + 300;
    setcookie("key", $key, $expire);
    
    $s1 = substr($intg, 0, 1);
    $s2 = substr($intg, 1, 1);
    $s3 = substr($intg, 2, 1);
    $s4 = substr($intg, 3, 1);
    
    $im = imagecreate(128,64);
    $bg = imagecolorallocate($im, 255, 255, 255);
    
    $b1 = imagecolorallocate($im, rand(0,224), rand(0,224), rand(0,224));
    $b2 = imagecolorallocate($im, rand(0,224), rand(0,224), rand(0,224));
    $b3 = imagecolorallocate($im, rand(0,224), rand(0,224), rand(0,224));
    $b4 = imagecolorallocate($im, rand(0,224), rand(0,224), rand(0,224));
    
    imagettftext($im, 27, rand(-30,30), 07, rand(30,50), $b1, $font, $s1);
    imagettftext($im, 27, rand(-30,30), 37, rand(30,50), $b2, $font, $s2);
    imagettftext($im, 27, rand(-30,30), 67, rand(30,50), $b3, $font, $s3);
    imagettftext($im, 27, rand(-30,30), 97, rand(30,50), $b4, $font, $s4);
    
    imageline($im, 0, rand(0,64), 128, rand(0,64), $b1);
    imageline($im, 0, rand(0,64), 128, rand(0,64), $b2);
    imageline($im, 0, rand(0,64), 128, rand(0,64), $b3);
    imageline($im, 0, rand(0,64), 128, rand(0,64), $b4);
    
    header('Content-type: image/png');
    imagepng($im);
}else{
    outhtml("");
}
?>
