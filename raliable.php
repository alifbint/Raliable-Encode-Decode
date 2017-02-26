<?php
	error_reporting(0);
	$OS = php_uname('s');
	if(strpos($OS, 'Linux') !== false){
		system('clear');
		$c_title = "|\t     \033[0;36mRALIABLE TOOLS ENDE v.0.1\033[0m\t\t|\n";
		$c_url = "| \033[1;33mhttps:\\\\raliable.web.id \033[0m\t\t\t|\n";
	}
	else{
		$c_title = "|\t     RALIABLE TOOLS ENDE v.0.1\t\t|\n";
		$c_url = "| https:\\\\raliable.web.id \t\t\t|\n";
	}

	class cipher{
		function char_to_dec($str){
			$ret = ''; 
			for ($i=0; $i < strlen($str); $i++) {
				$ret .= str_pad(ord(substr($str,$i,1)),3,'0', STR_PAD_LEFT); 
			}
			$ret = chunk_split($ret, 3, ' ');
			return $ret;
		}

		function dec_to_char($dec){
			$dec = str_replace(" ", "", $dec);
			$ret = '';
			$padLen = ceil(strlen($dec)/3)*3;
			$pad = str_pad($dec,$padLen,'0',STR_PAD_LEFT);
			for ($i=0; $i < (strlen($pad)/3); $i++) {
				$ret .= chr(substr(strval($pad), $i*3, 3));
			}
			return $ret;
		}

		function bin2text($str){
			$str = str_replace(" ", "", $str);
			$text_str = '';
			$chars = explode("\n", chunk_split(str_replace("\n", '', $str), 8));
			$n = count($chars);
			for($i = 0; $i < $n; $text_str .= chr(bindec($chars[$i])), $i++);
			return $text_str;
		}

		function text2bin($txt_str){
			$len = strlen($txt_str);
			$bin = '';
			for($i = 0; $i < $len; $i++){
				$bin .= strlen(decbin(ord($txt_str[$i]))) < 8 ? str_pad(decbin(ord($txt_str[$i])), 8, 0, STR_PAD_LEFT) : decbin(ord($txt_str[$i]));
			}
			return $bin;
		}

		function caesar_cipher($ch, $key){
			if (!ctype_alpha($ch))
				return $ch;

			$offset = ord(ctype_upper($ch) ? 'A' : 'a');
			return chr(fmod(((ord($ch) + $key) - $offset), 26) + $offset);
		}

		function caesar_encipher($input, $key)
		{
			$output = "";

			$inputArr = str_split($input);
			foreach ($inputArr as $ch)
				$output .= $this->caesar_cipher($ch, $key);

			return $output;
		}

		function caesar_decipher($input, $key)
		{
			return $this->caesar_encipher($input, 26 - $key);
		}

		function vigenere_enc($plaintext, $key) { 
	        $ketemu = '';
	        for ($i=0, $j=0, $n=strlen($key); $i < strlen($plaintext); $i++) {
		        $key_n = $j % $n;
		        if (ord($plaintext[$i]) >= 65 && ord($plaintext[$i]) <= 90) {
		            $steb_1 = ord(strtolower($key[$key_n])) - 97;
		            $steb_2 = (ord($plaintext[$i]) - 65 + $steb_1) % 26;
		            $ketemu .= chr($steb_2 + 65);
		            $j++;
		        }
		        elseif (ord($plaintext[$i]) >= 97 && ord($plaintext[$i]) <= 122) {
		            $steb_1 = ord(strtolower($key[$key_n])) - 97;
		            $steb_2 = (ord($plaintext[$i]) - 97 + $steb_1) % 26;
		            $ketemu .= chr($steb_2 + 97);
		            $j++;
		        }
		        else {
		            $ketemu .= $plaintext[$i];
		        }
	        }
	    	return $ketemu;    
		} 

	    function vigenere_dec($ciphertext, $key) {
			$ketemu = '';
			for ($i=0, $j=0, $n=strlen($key); $i < strlen($ciphertext); $i++) {
				$key_n = $j % $n;
				if (ord($ciphertext[$i]) >= 65 && ord($ciphertext[$i]) <= 90) {
					$steb_1 = ord(strtolower($key[$key_n])) - 97;
					$steb_2 = (ord($ciphertext[$i]) - 65 - $steb_1) % 26;
					$steb_3 = (($steb_2 < 0) ? 26+$steb_2 : $steb_2) % 26;
					$ketemu .= chr($steb_3 + 65);
					$j++;
				}
				elseif (ord($ciphertext[$i]) >= 97 && ord($ciphertext) <= 122) {
					$steb_1 = ord(strtolower($key[$key_n])) - 97;
					$steb_2 = (ord($ciphertext[$i]) - 97 - $steb_1);
					$steb_3 = (($steb_2 < 0) ? 26+$steb_2 : $steb_2) % 26;
					$ketemu .= chr($steb_3 + 97);
					$j++;
				}
				else {
					$ketemu .= $ciphertext[$i];
				}
			}
			return $ketemu;
	    }

	    function sms_decode($message) { 
			$final = ""; 
			$text = array( 
				"2"=>"a", "22"=>"b", 
				"222"=>"c", "3"=>"d", 
				"33"=>"e", "333"=>"f", 
				"4"=>"g", "44"=>"h", 
				"444"=>"i", "5"=>"j", 
				"55"=>"k", "555"=>"l", 
				"6"=>"m", "66"=>"n", 
				"666"=>"o", "7"=>"p", 
				"77"=>"q", "777"=>"r", 
				"7777"=>"s", "8"=>"t", 
				"88"=>"u", "888"=>"v", 
				"9"=>"w", "99"=>"x", "999"=>"y", 
				"9999"=>"z" 
				);   
			$message = explode(" ",$message); 
			for($i=0;$i<count($message);$i++) { 
				$final .= $text[$message[$i]];
			}
			return $final;
		}

		function sms_encode($masukan) {
			$text = array_flip(array( 
				"2"=>"a", "22"=>"b", 
				"222"=>"c", "3"=>"d", 
				"33"=>"e", "333"=>"f", 
				"4"=>"g", "44"=>"h", 
				"444"=>"i", "5"=>"j", 
				"55"=>"k", "555"=>"l", 
				"6"=>"m", "66"=>"n", 
				"666"=>"o", "7"=>"p", 
				"77"=>"q", "777"=>"r", 
				"7777"=>"s", "8"=>"t", 
				"88"=>"u", "888"=>"v", 
				"9"=>"w", "99"=>"x", "999"=>"y", 
				"9999"=>"z" 
				)); 
			$letters=array();
			$masukan = strtolower($masukan);
			$line = "";
			for ($i = 0; $i < strlen($masukan); $i++) {
				$letter = substr($masukan,$i,1);
				if ($text[$letter] == "") continue;
				$line .= ($text[$letter]." ");
			}
			return trim($line); 
		}

		function string_to_octal($str){
			$chars = str_split($str);
			$rtn = "";

			foreach ($chars as $c) { 
				$rtn .= str_pad(base_convert(ord($c), 10, 8), 3, 0, STR_PAD_LEFT)." "; 
			}
			return trim($rtn);
		}

		function octal_to_string($masukan){
			$masukan = explode(" ",$masukan);
			$hasil = "";
			for($i=0;$i<count($masukan);$i++) { 
				$hasil .= chr(octdec($masukan[$i]));
			}
			return $hasil;
		}

		function morse_enc($masukan){
			$morse=array("a"=>".-","b"=>"-...","c"=>"-.-.","d"=>"-..","e"=>".","f"=>"..-.","g"=>"--.","h"=>"....","i"=>"..","j"=>".---","k"=>"-.-","l"=>".-..","m"=>"--","n"=>"-.","o"=>"---","p"=>".--.","q"=>"--.-","r"=>".-.","s"=>"...","t"=>"-","u"=>"..-","v"=>"...-","w"=>".--","x"=>"-..-","y"=>"-.--","z"=>"--..","1"=>".----","2"=>"..---","3"=>"...--","4"=>"....-","5"=>".....","6"=>"-....","7"=>"--...","8"=>"---..","9"=>"----.","0"=>"-----"," "=>"   ","."=>".-.-.-",","=>"--..--","?"=>"..--..","!"=>"..--.",":"=>"---...","'"=>".----.","\""=>".-..-.","="=>"-...-","EOM"=>".-.-.");
			$letters=array();
			$masukan = strtolower($masukan);
			$line = "";
			for ($i = 0; $i < strlen($masukan); $i++) {
				$letter = substr($masukan,$i,1);
				if ($morse[$letter] == "") continue;
				$line .= ($morse[$letter]." ");
			}
			return trim($line); 
		}

		function morse_dec($masukan){
			$morse=array("a"=>".-","b"=>"-...","c"=>"-.-.","d"=>"-..","e"=>".","f"=>"..-.","g"=>"--.","h"=>"....","i"=>"..","j"=>".---","k"=>"-.-","l"=>".-..","m"=>"--","n"=>"-.","o"=>"---","p"=>".--.","q"=>"--.-","r"=>".-.","s"=>"...","t"=>"-","u"=>"..-","v"=>"...-","w"=>".--","x"=>"-..-","y"=>"-.--","z"=>"--..","1"=>".----","2"=>"..---","3"=>"...--","4"=>"....-","5"=>".....","6"=>"-....","7"=>"--...","8"=>"---..","9"=>"----.","0"=>"-----"," "=>"   ","."=>".-.-.-",","=>"--..--","?"=>"..--..","!"=>"..--.",":"=>"---...","'"=>".----.","\""=>".-..-.","="=>"-...-","EOM"=>".-.-.");
			$letters=array();    
			$masukan = strtolower($masukan);
			reset($morse);
			while (list($letter,$code) = each($morse)) {
				$letters[$code] = $letter;
			}
			$line = "";
			$words = array();
			$chars = array();
			$words = preg_split("/".$morse[" "]."/", $masukan, -1, PREG_SPLIT_NO_EMPTY);
			foreach ($words as $word) {
				$chars = array_merge($chars, preg_split("/ /", $word, -1, PREG_SPLIT_NO_EMPTY));
				$chars[] = '';
			}
			$chars[count($chars)-1] = $morse["EOM"];
			foreach ($chars as $char) {
				if ($char == "") {
					$line .= " ";
				}
				if ($char == $morse["EOM"]) {
					break;
				}
				if ($letters[$char] == "") {
					continue;
				}
				$line .= $letters[$char];
			}
			return trim($line);

		}

		function bacon_en($str, $key = ''){
			$hasil = '';
			$key = strtoupper($key);
			$str = strtoupper($str);
			if($key == "I=J" || $key == "U=V" || $key == "I=J and U=V"){
				$bacon = array("A" => "AAAAA", "B" => "AAAAB", "C" => "AAABA", "D" => "AAABB", "E" => "AABAA", "F" => "AABAB", "G" => "AABBA", "H" => "AABBB", "I" => "ABAAA", "J" => "ABAAA", "K" => "ABAAB", "L" => "ABABA", "M" => "ABABB", "N" => "ABBAA", "O" => "ABBAB", "P" => "ABBBA", "Q" => "ABBBB", "R" => "BAAAA", "S" => "BAAAB", "T" => "BAABA", "U" => "BAABB", "V" => "BAABB", "W" => "BABAA", "X" => "BABAB", "Y" => "BABBA", "Z" => "BABBB");
			}
			else{
				$bacon = array("A" => "AAAAA", "B" => "AAAAB", "C" => "AAABA", "D" => "AAABB", "E" => "AABAA", "F" => "AABAB", "G" => "AABBA", "H" => "AABBB", "I" => "ABAAA", "J" => "ABAAB", "K" => "ABABA", "L" => "ABABB", "M" => "ABBAA", "N" => "ABBAB", "O" => "ABBBA", "P" => "ABBBB", "Q" => "BAAAA", "R" => "BAAAB", "S" => "BAABA", "T" => "BAABB", "U" => "BABAA", "V" => "BABAB", "W" => "BABBA", "X" => "BABBB", "Y" => "BBAAA", "Z" => "BBAAB");
			}
			$str_arr = str_split($str);
			foreach($str_arr as $anu){
				if($anu == ' '){
					$hasil .= ' ';
				}
				else{
					$hasil .= $bacon[$anu];
				}
			}
			return $hasil;
		}

		function bacon_de($str, $key = ''){
			$hasil = '';
			$key = strtoupper($key);
			$str = strtoupper($str);
			if($key == "I=J" || $key == "U=V" || $key == "I=J and U=V"){
				$bacon = array_flip(array("A" => "AAAAA", "B" => "AAAAB", "C" => "AAABA", "D" => "AAABB", "E" => "AABAA", "F" => "AABAB", "G" => "AABBA", "H" => "AABBB", "I" => "ABAAA", "K" => "ABAAB", "L" => "ABABA", "M" => "ABABB", "N" => "ABBAA", "O" => "ABBAB", "P" => "ABBBA", "Q" => "ABBBB", "R" => "BAAAA", "S" => "BAAAB", "T" => "BAABA", "U" => "BAABB", "W" => "BABAA", "X" => "BABAB", "Y" => "BABBA", "Z" => "BABBB"));
			}
			else{
				$bacon = array_flip(array("A" => "AAAAA", "B" => "AAAAB", "C" => "AAABA", "D" => "AAABB", "E" => "AABAA", "F" => "AABAB", "G" => "AABBA", "H" => "AABBB", "I" => "ABAAA", "J" => "ABAAB", "K" => "ABABA", "L" => "ABABB", "M" => "ABBAA", "N" => "ABBAB", "O" => "ABBBA", "P" => "ABBBB", "Q" => "BAAAA", "R" => "BAAAB", "S" => "BAABA", "T" => "BAABB", "U" => "BABAA", "V" => "BABAB", "W" => "BABBA", "X" => "BABBB", "Y" => "BBAAA", "Z" => "BBAAB"));
			}
			$str = str_replace(" ", "XXXXX", $str);
			$str = explode(" ", chunk_split($str, 5, ' '));
			foreach($str as $anu){
				if($anu == 'XXXXX'){
					$hasil .= ' ';
				}
				else{
					$hasil .= $bacon[$anu];
				}
			}
			return $hasil;
		}

		function atbash_en($str){
			$hasil = '';
			$arr = array("a" => "z", "b" => "y", "c" => "x", "d" => "w", "e" => "v", "f" => "u", "g" => "t", "h" => "s", "i" => "r", "j" => "q", "k" => "p", "l" => "o", "m" => "n", "n" => "m", "o" => "l", "p" => "k", "q" => "j", "r" => "i", "s" => "h", "t" => "g", "u" => "f", "v" => "e", "w" => "d", "x" => "c", "y" => "b", "z" => "a", "A" => "Z", "B" => "Y", "C" => "X", "D" => "W", "E" => "V", "F" => "U", "G" => "T", "H" => "S", "I" => "R", "J" => "Q", "K" => "P", "L" => "O", "M" => "N", "N" => "M", "O" => "L", "P" => "K", "Q" => "J", "R" => "I", "S" => "H", "T" => "G", "U" => "F", "V" => "E", "W" => "D", "X" => "C", "Y" => "B", "Z" => "A");
			$str = str_split($str);
			foreach($str as $anu){
				if($anu == ' '){
					$hasil .= ' ';
				}
				else{
					$hasil .= $arr[$anu];
				}
			}
			return $hasil;
		}

		function atbash_de($str){
			$hasil = '';
			$arr = array_flip(array("a" => "z", "b" => "y", "c" => "x", "d" => "w", "e" => "v", "f" => "u", "g" => "t", "h" => "s", "i" => "r", "j" => "q", "k" => "p", "l" => "o", "m" => "n", "n" => "m", "o" => "l", "p" => "k", "q" => "j", "r" => "i", "s" => "h", "t" => "g", "u" => "f", "v" => "e", "w" => "d", "x" => "c", "y" => "b", "z" => "a", "A" => "Z", "B" => "Y", "C" => "X", "D" => "W", "E" => "V", "F" => "U", "G" => "T", "H" => "S", "I" => "R", "J" => "Q", "K" => "P", "L" => "O", "M" => "N", "N" => "M", "O" => "L", "P" => "K", "Q" => "J", "R" => "I", "S" => "H", "T" => "G", "U" => "F", "V" => "E", "W" => "D", "X" => "C", "Y" => "B", "Z" => "A"));
			$str = str_split($str);
			foreach($str as $anu){
				if($anu == ' '){
					$hasil .= ' ';
				}
				else{
					$hasil .= $arr[$anu];
				}
			}
			return $hasil;
		}
	}
	$anu = "-------------------------------------------------\n";
	$anu .= $c_title;
	$anu .= "-------------------------------------------------\n";
	$anu .= $c_url;
	$anu .= "| Info : " . $_SERVER['PHP_SELF'] . " --help \t\t\t|\n";
	$anu .= "-------------------------------------------------\n";
	echo $anu;

	$ARG = array();
	$tipe = '';
	foreach ($argv as $arg) {
		if (ereg('--([^=]+)',$arg,$reg)) {
			switch($reg[1]){
				case 'list':
					echo "List cipher : \n";
					echo "\t 1. Hex \t\t[-t=hex]\n";
					echo "\t 2. Base64 \t\t[-t=base64]\n";
					echo "\t 3. ROT13 \t\t[-t=rot13]\n";
					echo "\t 4. Decimal \t\t[-t=dec]\n";
					echo "\t 5. Binary \t\t[-t=bin]\n";
					echo "\t 6. Caesar Cipher \t[-t=caesar]\n";
					echo "\t 7. Vigenere Cipher \t[-t=vigenere]\n";
					echo "\t 8. SMS Cipher \t\t[-t=sms]\n";
					echo "\t 9. Octal \t\t[-t=octal]\n";
					echo "\t 10. Morse \t\t[-t=morse]\n";
					echo "\t 11. URL \t\t[-t=url]\n";
					echo "\t 12. Baconian Cipher \t[-t=bacon]\n";
					echo "\t 13. Atbash Cipher \t[-t=atbash]\n";
					exit(0);
				break;

				case 'help':
					echo "Help : \n";
					echo "\t--encode \tEncrypt text\n";
					echo "\t--decode \tDecrypt text\n";
					echo "\t--reverse \tReverse Text\n";
					echo "\t--list \t\tList existing cipher text\n";
					echo "\t-t \t\tType for cipher (ex : -t=hex)\n";
					echo "\t-a \t\tcipher text or Plaint Text (ex : -a=\"TEXT\")\n";
					echo "\t-r \t\tRead From File (ex : -t=\"text.txt\")\n";
					echo "\t-k \t\tKEY of cipher Text (ex : -k=\"KEY\")\n";
					echo "\t-o \t\tOutput as a text file (ex : -o=\"filename\")\n";
					exit(0);
				break;

				case 'encode':
					$tipe = 'encode';
				break;

				case 'decode':
					$tipe = 'decode';
				break;

				case 'reverse':
					$tipe = 'reverse';
				break;

				default:
					echo "\nError : " . $reg[0] . " Command not found (--help for more information)\n";
					exit(0);
				break;
			}
		} elseif(ereg('-([^=]+)=(.*)',$arg,$reg)) {
			$ARG[$reg[1]] = $reg[2];
		}
	}

	if(!empty($ARG)){
		if(!empty($tipe)){
			$cipher = new cipher();
			$result = '';
			$key = '';

			if(array_key_exists('a', $ARG)){
				$str = (string) $ARG['a'];
				if(empty($str)){
					echo "\nError : Strings null detected!\n";
					exit(0);
				}
			}

			if(array_key_exists('r', $ARG)){
				$str = trim(file_get_contents($ARG['r']));
				if(empty($ARG['r'])){
					echo "\nError : Strings null detected!\n";
					exit(0);
				}
			}

			if(array_key_exists('k', $ARG)){
				$key = (string) $ARG['k'];
				if(empty($key)){
					echo "\nError : Key null detected!\n";
					exit(0);
				}
			}

			switch($tipe){
				case 'encode':
					switch($ARG['t']){
						case 'hex':
							$result = bin2hex($str);
							$result = chunk_split($result, 2, ' ');
						break;

						case 'base64':
							$result = base64_encode($str);
						break;

						case 'rot13':
							$result = str_rot13($str);
						break;

						case 'dec':
							$result = $cipher->char_to_dec($str);
						break;

						case 'bin':
							$result = $cipher->text2bin($str);
							$result = chunk_split($result, 8, ' ');
						break;

						case 'caesar':
							$result = $cipher->caesar_encipher($str, $key);
						break;

						case 'vigenere':
							$result = $cipher->vigenere_enc($str, $key);
						break;

						case 'sms':
							$result = $cipher->sms_encode($str);
						break;

						case 'octal':
							$result = $cipher->string_to_octal($str);
						break;

						case 'morse':
							$result = $cipher->morse_enc($str);
						break;

						case 'url':
							$result = urlencode($str);
						break;

						case 'bacon':
							$result = $cipher->bacon_en($str, $key);
						break;

						case 'atbash':
							$result = $cipher->atbash_en($str);
						break;

						default:
							echo "\nError : cipher not exists!\n";
							exit(0);
						break;
					}

					echo "\n-----------------------------------------\n";
					echo "|\t\t RESULT \t\t|\n";
					echo "-----------------------------------------\n";
					if(!empty($key))
					echo "KEY \t\t: $key\n";
					echo "Plaint Text \t: $str\n";
					echo "Result \t\t: $result\n"; 
				break;

				case 'decode':
					switch($ARG['t']){
						case 'hex':
							$str = str_replace(" ", "", $str);
							$result = hex2bin($str);
							$str = chunk_split($str, 2, ' ');
						break;

						case 'base64':
							$result = base64_decode($str);
						break;

						case 'rot13':
							$result = str_rot13($str);
						break;

						case 'dec':
							$result = $cipher->dec_to_char($str);
						break;

						case 'bin':
							$result = $cipher->bin2text($str);
						break;

						case 'caesar':
							$result = $cipher->caesar_decipher($str, $key);
						break;

						case 'vigenere':
							$result = $cipher->vigenere_dec($str, $key);
						break;

						case 'sms':
							$result = $cipher->sms_decode($str);
						break;

						case 'octal':
							$result = $cipher->octal_to_string($str);
						break;

						case 'morse':
							$result = $cipher->morse_dec($str);
						break;

						case 'url':
							$result = urldecode($str);
						break;

						case 'bacon':
							$result = $cipher->bacon_de($str, $key);
						break;

						case 'atbash':
							$result = $cipher->atbash_de($str);
						break;

						default:
							echo "\nError : cipher not exists!\n";
							exit(0);
						break;
					}

					echo "\n-----------------------------------------\n";
					echo "|\t\t RESULT \t\t|\n";
					echo "-----------------------------------------\n";
					if(!empty($key))
					echo "KEY \t\t: $key\n";
					echo "cipher Text \t: $str\n";
					echo "Result \t\t: $result\n"; 
				break;

				case 'reverse':
					$str_arr = str_split($str);
					$len = strlen($str) - 1;
					for($i = $len; $i >= 0; $i--){
						$result .= $str_arr[$i];
					}
					echo "Text \t\t: $str\n";
					echo "Reverse Text \t: $result\n";
				break;
			}
		}

		if(array_key_exists('o', $ARG)){
			$fp = fopen($ARG['o'],"w");
			if(fwrite($fp,$result)){
				echo "FILE " . $ARG['o'] . " CREATED!\n\n";
			}
			fclose($fp);
		}
	}

?>