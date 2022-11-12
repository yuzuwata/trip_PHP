<?php
    function makeTrip($key){
		// check
		preg_match('|^#(.*)$|', $key, $keys);
		if(empty($keys[1])) return false;
		$key = $keys[1];

		// start
		if(strlen($key) >= 12){
			 // digit 12
			$mark = substr($key, 0, 1);
			if($mark == '#' || $mark == '$'){
				if(preg_match('|^#([[:xdigit:]]{16})([./0-9A-Za-z]{0,2})$|', $key, $str)){
					$trip = substr(crypt(pack('H*', $str[1]), "$str[2].."), -10);
				}else{
					// ext
					$trip = '???';
				}
			}else{
				$trip = substr(base64_encode(sha1($key, TRUE)), 0, 12);
				$trip = str_replace('+', '.', $trip);
			}
		$trip = '◆'.$trip;
		return $trip;
	    }
    }
    if(isset($_POST['tripseiki'])){
        $seiki = "/" . $_POST['tripseiki'] . "/";
        $str = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz0123456789./"), 0, 12);
        $str .= "#";
        $tr = makeTrip($str);
        $ans = preg_match();
    }
?>
<html>
<head>
    <title>トリップメーカー</title>
</head>
<body>
    <form>
        <label for="trip">ほしい12桁トリップを正規表現ハッシュ付きで入力してください:</label>
        <input type="text" id="tripseiki" name="tripseiki">
        <input type="submit" name="start" value="開始">
    </form>
</body>
</html>