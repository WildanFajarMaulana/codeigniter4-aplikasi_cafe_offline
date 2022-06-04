<?php

namespace App\Models;

use CodeIgniter\Model;

class LogPegawaiModel extends Model
{
    protected $table      = 'tb_logpegawai';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id_pegawai','deskripsi'];
 

    public function getLog(){
        return $this->join('tb_login','tb_login.id_login=tb_logpegawai.id_pegawai')->find();  
    }
    public function getLogKasir(){
        return $this->join('tb_login','tb_login.id_login=tb_logpegawai.id_pegawai')->where(['role'=>'kasir'])->find();  
    }
    // public function getUserByid($id){
    //   $where = "id='$id'";
    //   return $this->where($where)->first();
    // }
    // public function getUserByusername($username){
    //   $where = "username='$username'";
    //   return $this->where($where)->first();
    // }
    // public function deleteUser($id){
    //   $sql="DELETE FROM tb_login WHERE id='$id'";
    //   return $this->query($sql);
    // }
   
}