<?php
defined('BASEPATH') or exit('No direct script access allowed');


class JSONAdmin{
    private $dir = APPPATH . 'db-json/admin/';
    private $data_json;
    private $filename;
    private $data_array = [];
    private $file_dir;

    public function __construct()
    {
        $this->data_array = json_encode($this->data_array);
        $this->setFilename();
    }

    private function setFilename()
    {
        $this->filename = 'admin';
        $this->file_dir = $this->dir . $this->filename . '.json';
    }

    public function setData($data)
    {
        $this->data_array = $data;
    }

    public function convertToJson(){
        $encrypt = new EncryptDecrypt;

        $data = $this->data_array;

        $encrypt->setString($data['username_']);
        $username = $encrypt->encrypt();

        $encrypt->setString($data['password_']);
        $password = $encrypt->encrypt();

        $id_admin = $data['id_admin'];

        $this->data_json = json_encode(array("username_"=>$username, "password_"=>$password, "id_admin"=>$id_admin));
    }

    public function create()
    {
        $myfile = fopen($this->file_dir, "w") or die("Unable to open file!");

        fwrite($myfile, $this->data_json);
        return true;
    }

    public function read()
    {
        $myfile = fopen($this->file_dir, "r") or die("Unable to open file!");
        if (filesize($this->file_dir) == 0) {
            $this->data_json = json_encode(array());
        } else {
            $this->data_json = fread($myfile, filesize($this->file_dir));

            $data_decrypt = [];

            $decrypt = new EncryptDecrypt;

            $this->data_json = json_decode($this->data_json);
         
            $obj = $this->data_json;

            $username =  $obj->{'username_'};
            $password =  $obj->{'password_'};
            $id_admin =  $obj->{'id_admin'};

            $decrypt->setEncrypt($username);
            $username = $decrypt->decrypt();

            $decrypt->setEncrypt($password);
            $password = $decrypt->decrypt();

            $data_decrypt = (array(
                'username_' => $username, 'password_'=>$password,'id_admin'=>$id_admin
            ));
            $this->data_json = json_encode($data_decrypt);
            return $this->data_json;
            fclose($myfile);
        }
    }
}