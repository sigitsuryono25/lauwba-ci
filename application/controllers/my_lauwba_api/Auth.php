<?php
include_once(dirname(__FILE__) . "/Baseapi.php");

class Auth extends Baseapi{
    
    function index(){
        $stream_clean = $this->getInputFromUser();
        $request = json_decode($stream_clean);
        $email = $request->email;
        $password = $request->password;
        $encryptPassword = md5(sha1($password));
        $where = ['email' => $email, 'password' => $encryptPassword];
        $user = $this->db->select('email, nama, is_archieved')->from('akun_user')->where($where)->get()->row();
        if(!empty($user)){
            if($user->is_archieved == '0'){
                $lastLogin = $this->getDate();
                $token = sha1($email).".".sha1($lastLogin);
                $this->db->where($where)->update('akun_user', ['last_login' => $this->getDate(), 'token' => $token, 'expired_token' => $this->addedDay("3")]);
                $user = $this->db->select('email, nama, token, affiliate_code')->from('akun_user')->where($where)->get()->row();
                $this->success("data ditemukan", "user", $user);
            }else{
                $this->notFound("Akun di-nonaktifkan. Hubungi admin untuk mengaktifkan akun.");
            }
        }else{
            $this->notFound("User tidak ditemukan");
        }
    }
    
    function register(){
        $streamClean = $this->getInputFromUser();
        $request = json_decode($streamClean);
        $email = $request->email;
        $passwrd = $request->password;
        $fullName = $request->full_name;
        $where = ['email' => $email];
        $user = $this->db->select('*')->from('akun_user')->where($where)->get()->row();
        if(!empty($user)){
            $this->internalError('Email sudah terdaftar');
        }
        
        $data = ['email' => $email, 'nama' => $fullName, 'password' => $passwrd, 'affiliate_code' => $this->generateRandomString()];
        $ins = $this->db->insert('akun_user', $data);
        if($ins){
            $this->success('Pendaftar berhasil. Silahkan login');
        }else{
            $this->internalError("pendaftaran gagal");
        }
    }
    
    function testPageAuth(){
        $this->checkAuthToken();
        echo "It's worked. ". $this->email ." ".$this->getDate();
    }
    
}