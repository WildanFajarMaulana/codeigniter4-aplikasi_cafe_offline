<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table      = 'tb_menu';
    protected $primaryKey = 'id';

    protected $allowedFields = ['nama_menu','gambar_menu','stok','harga','kategori'];
 

    // public function getMenu(){
    //   return $this->findAll();
    // }
    public function getMenuByid($id){
      $where = "id='$id'";
      return $this->where($where)->first();
    }
    // public function getUserByusername($username){
    //   $where = "username='$username'";
    //   return $this->where($where)->first();
    // }
   
    public function deleteMenu($id){
      $sql="DELETE FROM tb_menu WHERE id='$id'";
      return $this->query($sql);
    }
   
}