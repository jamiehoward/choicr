<?php
/**
 * Download Encryption
 *
 * Download Encryption for CodeIgniter
 *
 * @version 1.0
 */
class Encryption
{
	private $encryption_key;
	private $iv;
	
	function __construct()
	{
		$this->encryption_key = 'my_custom_encryption_key';
		$this->iv = 'ipw86fmdj94kbdj7';
	}

    /*
     * Encode string to base64 and replace special characters with  url supported characters
	 * @param string
	 * @return string
	 * */
	private function urlsafe_b64encode($string) {
 
        $data = base64_encode($string);
		//echo $data;
        $data = str_replace(array('+','/','='),array('-','_',''),$data);
		
        return $data;
    }

    /*
     * Decode string to base64 and replace url supported characters with special characters those we replaced during encryption
	 * @param string
	 * @return string
	 * */
	private function urlsafe_b64decode($string) {
        $data = str_replace(array('-','_'),array('+','/'),$string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }

    /*
     * Encrypt string
     * First we encode base64
     * Then encode with mcrypt_encrypt in CBC mode
     * @param string
     * @return encoded string*/
    public  function encrypt($value){ 
	    if(!$value){return false;}
        $text = $value;
        $iv = $this->iv;
        $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $this->encryption_key, $text, MCRYPT_MODE_CBC, $iv);
        return trim($this->urlsafe_b64encode($crypttext)); 
    }

    /*
     * Decrypt string
     * First decode with mcrypt_decrypt in CBC mode
     * Then we decode base64
     * @param string
     * @return encoded string*/
    public function decrypt($value){
        if(!$value){return false;}
        $crypttext = $this->urlsafe_b64decode($value); 
        $iv = $this->iv;
        $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $this->encryption_key, $crypttext, MCRYPT_MODE_CBC, $iv);
        return trim($decrypttext);
    }
}
?>