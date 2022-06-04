<?php

namespace App\Models;

use CodeIgniter\Model;

class TambahKeranjangTranksaksi extends Model
{
    protected $table      = 'tambahkeranjangtranksaksi';
    protected $primaryKey = 'id_tambah';

    protected $allowedFields = ['id_tranksaksi','id_menu','jumlah_tambah','total_harga_tambah'];
 

  
    public function getDataByidtranksaksi($id_trx){
      $where = "id_tranksaksi='$id_trx'";
      return $this->where($where)->find();
    }
    public function sumKeranjangTambahByidTranksaksi($id_trx){
      return $this->selectSum('total_harga_tambah')->where(['id_tranksaksi'=>$id_trx])->find();
    }
    public function getKeranjangByidTrx($id_trx){
      return $this->join('tb_menu','tb_menu.id=tambahkeranjangtranksaksi.id_menu')->where(['id_tranksaksi'=>$id_trx])->find();  
     
    }
    public function cekMenuByidtrx($id_menu,$id_trx){
      return $this->where(['id_menu'=>$id_menu,'id_tranksaksi'=>$id_trx])->first();
    }
    public function getMenuTambahByid($id){
      return $this->where(['id_tambah'=>$id])->first();
    }
    public function deleteMenuKeranjangTambah($id){
      $sql="DELETE FROM tambahkeranjangtranksaksi WHERE id_tambah='$id' ";
      return $this->query($sql);
    }
    public function deleteByidTranksaksi($id_tranksaksi){
      $sql="DELETE FROM tambahkeranjangtranksaksi WHERE id_tranksaksi='$id_tranksaksi' ";
      return $this->query($sql);
    }
 
   
}