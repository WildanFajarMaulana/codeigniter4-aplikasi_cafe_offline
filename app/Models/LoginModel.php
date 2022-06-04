<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table      = 'tb_login';
    protected $primaryKey = 'id_login';

    protected $allowedFields = ['nama','username','password','role'];
 

    public function getUser(){
      $where = "role != 'admin' ";
      return $this->where($where)->find();
    }
    public function getUserByid($id){
      $where = "id_login='$id'";
      return $this->where($where)->first();
    }
    public function getUserByusername($username){
      $where = "username='$username'";
      return $this->where($where)->first();
    }
    public function getUserByRoleKasir(){
      $where = "role='kasir'";
      return $this->where($where)->find();
    }
    public function deleteUser($id){
      $sql="DELETE FROM tb_login WHERE id_login='$id'";
      return $this->query($sql);
    }
   
}