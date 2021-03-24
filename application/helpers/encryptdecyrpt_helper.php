<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class EncryptDecrypt
{
    private $chiper = 'AES-128-CTR';
    private $option = 0;
    private $encrypt_key = 'pdrtechnology';
    private $encrypt_iv = 1234567890123456;
    private $string_ori;
    private $result_encrypt;
    private $result_decrypt;
    private $encrypt_ori;

    public function setString($string){
        $this->string_ori = $string;
    }

    public function setEncrypt($string){
        $this->encrypt_ori  = $string;
    }

    public function encrypt(){
        $this->result_encrypt = openssl_encrypt($this->string_ori, $this->chiper, 
        $this->encrypt_key, $this->option, $this->encrypt_iv); 
        return $this->result_encrypt;
    }

    public function decrypt(){
        $this->result_decrypt = openssl_decrypt($this->encrypt_ori, $this->chiper, 
        $this->encrypt_key, $this->option, $this->encrypt_iv);
        return $this->result_decrypt; 
    }
}
