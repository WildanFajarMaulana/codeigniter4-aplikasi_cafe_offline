<?php

namespace App\Models;

use CodeIgniter\Model;

class MejaModel extends Model
{
    protected $table      = 'tb_meja';
    protected $primaryKey = 'id';

    protected $allowedFields = ['kode_meja','status'];
 

    // public function getMenu(){
    //   return $this->findAll();
    // }
    public function getMejaByid($id){
      $where = "id='$id'";
      return $this->where($where)->first();
    }
    public function getMejaByKode($kode_meja){
      $where = "kode_meja='$kode_meja'";
      return $this->where($where)->first();
    }
    // public function getUserByusername($username){
    //   $where = "username='$username'";
    //   return $this->where($where)->first();
    // }
    public function deleteMeja($id){
      $sql="DELETE FROM tb_meja WHERE id='$id'";
      return $this->query($sql);
    }
    public function updateStatusMeja($kode_meja){
      $sql="UPDATE tb_meja SET status=1 WHERE kode_meja='$kode_meja'";
      return $this->query($sql);
    }
   
}