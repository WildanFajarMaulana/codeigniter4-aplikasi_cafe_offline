<?php

namespace App\Models;

use CodeIgniter\Model;

class TranksaksiModel extends Model
{
    protected $table      = 'tb_tranksaksi';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id_pegawai','nama_pembeli','total_pembayaran','status','kode_meja','tanggal_tertentu','hari','bulan'];
 

   public function getTranksaksiSelesai(){
        
    return $this->join('tb_login','tb_login.id_login=tb_tranksaksi.id_pegawai')->where(['status'=>'selesai'])->find();  
   }
   public function getTranksaksiDiproses(){
    return $this->join('tb_login','tb_login.id_login=tb_tranksaksi.id_pegawai')->where(['status'=>'diproses'])->find(); 
   }
   public function getTranksaksiBaru($id_pegawai){
       return $this->where(['id_pegawai'=>$id_pegawai])->orderBy('id','DESC')->first();
   }
   public function cariMejaByStatus($kode_meja){
    return $this->where(['kode_meja'=>$kode_meja,'status'=>'diproses'])->first();
}
    public function getTranksaksiBYid($id_tranksaksi){
        return $this->where(['id'=>$id_tranksaksi])->first();
    }
    public function getTranksaksiBYidDiproses($id_tranksaksi){
        return $this->where(['id'=>$id_tranksaksi,'status'=>'diproses'])->first();
    }
   
    public function getTranksaksiByNamaPegawai($id_login){
        
        return $this->join('tb_login','tb_login.id_login=tb_tranksaksi.id_pegawai')->where(['status'=>'selesai','id_pegawai'=>$id_login])->find();  
       }
    public function getTranksaksiByTanggal($tanggal_awal,$tanggal_akhir){
        $where="tanggal_tertentu>='$tanggal_awal'AND tanggal_tertentu<='$tanggal_akhir' AND status='selesai'";
        return $this->join('tb_login','tb_login.id_login=tb_tranksaksi.id_pegawai')->where($where)->find();  
    }
    public function getTotalPembayaranByHarian($hari){
        return $this->selectSum('total_pembayaran')->where(['hari'=>$hari,'status'=>'selesai'])->find();
    }
    public function getTotalPembayaranByBulanan($bulan){
        return $this->selectSum('total_pembayaran')->where(['bulan'=>$bulan,'status'=>'selesai'])->find();
    }
}