<?php
defined('BASEPATH') or exit('No direct script access allowed');


class JSONHelper
{
    private $dir = APPPATH . 'db-json/router-data/';
    private $data_json;
    private $filename;
    private $data_array = [];
    private $file_dir;

    public function __construct()
    {
        $this->data_array = json_encode($this->data_array);
    }

    public function setFileName($filename)
    {
        $this->filename = $filename;
        $this->file_dir = $this->dir . $this->filename . '.json';
    }

    public function setData($data)
    {
        $this->data_array = $data;
    }


    public function addItem()
    {
        $json_current = '';
        $new_json = '';
        // check file sebelumnya
        if (strlen($this->data_json) > 2) {
            $json_current = $this->data_json;
            $json_current = json_decode($json_current);

            $data_new = [];
            $encrypt = new EncryptDecrypt;
            for ($i = 0; $i < count($json_current); $i++) {
                $obj = $json_current[$i];

                $username = $obj->{'username_'};
                $password = $obj->{'password_'};
                $ipaddress = $obj->{'ip_address'};
                $port_api = $obj->{'port_api'};
                $router_name = $obj->{'router_name'};
                $id_router = $obj->{'id_router'};

                $encrypt->setString($username);
                $username = $encrypt->encrypt();

                $encrypt->setString($password);
                $password = $encrypt->encrypt();

                $encrypt->setString($router_name);
                $router_name = $encrypt->encrypt();

                $encrypt->setString($ipaddress);
                $ipaddress = $encrypt->encrypt();

                $encrypt->setString($port_api);
                $port_api = $encrypt->encrypt();

                $data_new[$i] = (array(
                    'username_' => $username, 'password_' => $password,
                    'router_name' => $router_name, 'ip_address' => $ipaddress, 'port_api' => $port_api,
                    'id_router'=>$id_router
                ));
            }
            $length = count($data_new);

            $data_new[$length] = $this->data_array;
            $new_json = json_encode($data_new);

            $this->data_json = $new_json;
        } else {
            $data_array  = [];

            $data_array[0] = $this->data_array;
            $this->data_json = json_encode($data_array);
        }
        $this->create();
        return true;
    }

    public function checkFile()
    {
        if (file_exists($this->file_dir)) {
            return true;
        } else {
            return false;
        }
    }

    public function create()
    {
        $myfile = fopen($this->file_dir, "w") or die("Unable to open file!");

        fwrite($myfile, $this->data_json);
    }

    public function delete($id_router_delete){
        $this->read();
      
        $data_json = json_decode($this->data_json);
        $match = false;
        $data_json = ((array) $data_json);
        $i=0;
        foreach ($data_json as $key => $value) {
            $id_router = $value->{"id_router"};
            if ($id_router_delete===$id_router){
               unset($data_json[$i]);
               $match = true;
            }
            $i++;
        }
        $data_json = ((object) $data_json);
      
        $data_new = [];
        $encrypt = new EncryptDecrypt;
        $i=0;
        foreach ($data_json as $key => $value) {

            $username = $value->{'username_'};
            $password = $value->{'password_'};
            $ipaddress = $value->{'ip_address'};
            $port_api = $value->{'port_api'};
            $router_name = $value->{'router_name'};
            $id_router = $value->{'id_router'};

            $encrypt->setString($username);
            $username = $encrypt->encrypt();

            $encrypt->setString($password);
            $password = $encrypt->encrypt();

            $encrypt->setString($router_name);
            $router_name = $encrypt->encrypt();

            $encrypt->setString($ipaddress);
            $ipaddress = $encrypt->encrypt();

            $encrypt->setString($port_api);
            $port_api = $encrypt->encrypt();

            $data_new[$i] = (array(
                'username_' => $username, 'password_' => $password,
                'router_name' => $router_name, 'ip_address' => $ipaddress, 'port_api' => $port_api,
                'id_router'=>$id_router
            ));
            $i++;
        }
        
        $this->data_json = json_encode($data_new);
        $this->create();
        return $match ? true : false;
    }

    public function clear(){
        $myfile = fopen($this->file_dir, "w") or die("Unable to open file!");
        $this->data_json = json_encode(array());
        fwrite($myfile,'');
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
           
             $i=0;
            foreach ( $this->data_json as $key => $value) {
               
                $id_router =  $value->{'id_router'};

                if ($id_router===null || $id_router===''){
                    continue;
                }
               
                $username =  $value->{'username_'};
                $password =  $value->{'password_'};
                $router_name =  $value->{'router_name'};
                $ipaddress =  $value->{'ip_address'};
                $port =  $value->{'port_api'};
                
                $decrypt->setEncrypt($username);
                $username = $decrypt->decrypt();

                $decrypt->setEncrypt($password);
                $password = $decrypt->decrypt();

                $decrypt->setEncrypt($ipaddress);
                $ipaddress = $decrypt->decrypt();

                $decrypt->setEncrypt($port);
                $port = $decrypt->decrypt();

                $decrypt->setEncrypt($router_name);
                $router_name = $decrypt->decrypt();

                $data_decrypt[$i] = (array(
                    'username_' => $username, 'password_' => $password,
                    'router_name' => $router_name, 'ip_address' => $ipaddress, 'port_api' => $port,
                    'id_router' => $id_router
                ));
                $i++;
            }
            
            $this->data_json = json_encode($data_decrypt);
            return $this->data_json;
            fclose($myfile);
        }
    }
}
