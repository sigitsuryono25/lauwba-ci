<?php
/**
 * x-api-key: lauwbamantab2023
*/
header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST');
class Baseapi extends CI_Controller
{
    public $email = "";
    public $affiliateCode = "";
    
    function __construct(){
        parent::__construct();
        $header = getallheaders();
        if(array_key_exists('x-api-key', $header)){
            if($header['x-api-key'] == null){
                $this->badRequest("Bad Request. API KEY invalid");
            }else{
                //do something if x-api-key found
                $this->load->helper('security');
            }
        }else{
             $this->badRequest("Bad Request. API KEY invalid");
        }
    }
    
    function addedDay($amount){
        return date('Y-m-d H:i:s', strtotime("+$amount year", strtotime($this->getDate())));
    }
    
    function checkAuthToken(){
        $header = getallheaders();
        if(array_key_exists('auth-token', $header)){
            if($header['auth-token'] == null){
                $this->badRequest("Bad Request. TOKEN invalid");
            }else{
                $where = ['token' => $header['auth-token']];
                $getUser = $this->db->select("email, nama, expired_token,affiliate_code")->from('akun_user')->where($where)->get()->row();
                if(empty($getUser)){
                    $this->badRequest('Bad Request. TOKEN Invalid');
                }else{
                    if($getUser->expired_token < $this->getDate()){
                        $this->badRequest("Bad request. TOKEN expired, please login again");
                    }
                    
                    $this->email = $getUser->email;
                    $this->affiliateCode = $getUser->affiliate_code;
                }
            }
        }else{
                $this->badRequest("Bad Request. TOKEN invalid");
        }
    }
    
	public function getDate($format = "Y-m-d H:i:s")
	{
		return date($format);
	}

	// put your code here
	public function setHeader($code, $message)
	{
		return header($_SERVER["SERVER_PROTOCOL"] . " $code $message");
	}

	function badRequest($message = "Bad Request")
	{
		$this->setHeader(400, $message);
		die(json_encode([
			'message' => $message,
			"code" => 400
		]));
	}

	function internalError($message = SERVER_ERROR)
	{
		$this->setHeader(500, "Internal Server Error");
		die(json_encode([
			'message' => $message,
			"code" => 500
		]));
	}

	function notFound($message = "Data tidak ditemukan")
	{
		$this->setHeader(404, NOT_FOUND);
		die(json_encode([
			'message' => $message,
			"code" => 404
		]));
	}

	function nothingChange($message = "Nothing Change")
	{
		$this->setHeader(200, "OK");
		die(json_encode([
			'message' => $message,
			"code" => 200
		]));
	}

	function success($message = "Tindakan berhasil dilakukan", $node = "data", $data = [])
	{
		$this->setHeader(200, "OK");
		echo json_encode([
			$node => $data,
			'message' => $message,
			"code" => 200
		]);
	}
	
	function notModified($message = "Tidak ada Perubahan data", $node = "data", $data = [])
	{
		$this->setHeader(304, "Not Modified");
		die(json_encode([
			$node => $data,
			'message' => $message,
			"code" => 304
		]));
	}
	
	function resetInput($message = "Can`t modified data", $node = "data", $data = []){
	    $this->setHeader(406, "Not Acceptable");
		die(json_encode([
			$node => $data,
			'message' => $message,
			"code" => 406
		]));
	}


	function contentType($type)
	{
		header("Content-Type: $type");
	}

	function getInputFromUser(){
	    return $this->security->xss_clean($this->input->raw_input_stream);
	}

	public function base64ToFile($stringBase64, $path)
	{
		if (!is_dir($path)) {
			mkdir($path, 0775, TRUE);
		}

		$image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $stringBase64));
		$name = md5(time()) . ".jpg";
		if (file_put_contents($path . $name, $image) !== FALSE) {
			return $name;
		}
		return null;
	}
	
	function generateRandomString($length = 5) {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}