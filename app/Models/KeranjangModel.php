<?php

namespace App\Models;

use CodeIgniter\Model;

class KeranjangModel extends Model
{
    protected $table      = 'tb_keranjang';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id_menu','id_tranksaksi','nama_menu','gambar_menu','jumlah','harga','total_harga'];
 

    // public function getMenu(){
    //   return $this->findAll();
    // }
    public function getMenuByid($id){
      $where = "id='$id'";
      return $this->where($where)->first();
    }
    public function getKeranjangByidTrx(){
      return $this->where(['id_tranksaksi'=>0])->find();
    }
    public function getKeranjangByidTrxAda($id_trx){
      return $this->where(['id_tranksaksi'=>$id_trx])->find();
    }
    public function getKeranjangUserByMenu($id_menu){
      return $this->where(['id'=>$id_menu,'id_tranksaksi'=>0])->first();
    }
    public function getKeranjangUserByTrx($id_menu,$id_trx){
      return $this->where(['id'=>$id_menu,'id_tranksaksi'=>$id_trx])->first();
    }
    public function getMenuByIdTranksaksi($id_trx){
      return $this->where(['id_tranksaksi'=>$id_trx])->find();
    }
    // public function getUserByusername($username){
    //   $where = "username='$username'";
    //   return $this->where($where)->first();
    // }
    public function cekMenuByidtrx($id_menu){
        return $this->where(['id_menu'=>$id_menu,'id_tranksaksi'=>0])->first();
    }
    public function deleteMenuKeranjang($id){
      $sql="DELETE FROM tb_keranjang WHERE id='$id' ";
      return $this->query($sql);
    }
    public function sumKeranjangByIdTranksaksi(){
      return $this->selectSum('total_harga')->where(['id_tranksaksi'=>0])->find();
    }
    public function sumKeranjangByIdTranksaksiAda($id_trx){
      return $this->selectSum('total_harga')->where(['id_tranksaksi'=>$id_trx])->find();
    }
    public function updateIdTranksaksi($id_tranksaksi){
      $sql="UPDATE FROM tb_keranjang SET `id_tranksaksi`='$id_tranksaksi' WHERE id_tranksaksi='0'";
      return $this->query($sql);
    }
    public function totalKeranjangByIdTranksaksi(){
      $query=$this->getWhere(['id_tranksaksi'=>'0']);
      return $query->getNumRows();
  }
  public function getKeranjangLama($id_tranksaksi,$id_menu){
    return $this->where(['id_tranksaksi'=>$id_tranksaksi,'id_menu'=>$id_menu])->first();
  }
   
}