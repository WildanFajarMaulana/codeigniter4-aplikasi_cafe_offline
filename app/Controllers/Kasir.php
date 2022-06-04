<?php

namespace App\Controllers;
use App\Models\MenuModel;
use App\Models\MejaModel;
use App\Models\KeranjangModel;
use App\Models\TranksaksiModel;
use App\Models\TambahKeranjangTranksaksi;
use App\Models\LogPegawaiModel;
class Kasir extends BaseController
{
    protected $MenuModel;
    protected $MejaModel;
    protected $KeranjangModel;
    protected $TranksaksiModel;
    protected $TambahKeranjangTranksaksi;
    protected $LogPegawaiModel;
    public function __construct()
    {
        $this->MenuModel = new MenuModel();
        $this->MejaModel = new MejaModel();
        $this->KeranjangModel = new KeranjangModel();
        $this->TranksaksiModel = new TranksaksiModel();
        $this->TambahKeranjangTranksaksi = new TambahKeranjangTranksaksi();
        $this->LogPegawaiModel = new LogPegawaiModel();

    }
    public function index()
    {
        if(!session()->get('id')){
        return redirect()->to('/'); 

      }
      
      if(session()->get('role')=='manager'){
        return redirect()->to('/manager'); 

      }
      if(session()->get('role')=='admin'){
        return redirect()->to('/admin'); 

      }
     
        $data['css']='menu.css';
        $data['js']='menu.js';
        $data['title']='Ayo Ngopi || Menu';
        return view('kasir/menu',$data);
    }
    public function dataMenu(){
        if($this->request->isAJAX()){
            $data['dataMenu']=$this->MenuModel->find();

            $msg=[
                'data'=>view('kasir/cardMenu',$data)
            ];
            echo json_encode($msg);
        }else{
            exit('request tidak dapat dilakukan');
        }
    }
    public function getMenuByid(){
        if($this->request->isAJAX()){
            $data['menuByid']=$this->MenuModel->getMenuByid($this->request->getGet('id'));

            $msg=[
                'data'=>$data['menuByid']
            ];
            echo json_encode($msg);
        }else{
            exit("request tidak dapat dilakukan");
        }
    }
    public function tambahKeranjang(){
        if($this->request->isAJAX()){
            $dataMenuByid=$this->MenuModel->getMenuByid($this->request->getPost('id'));
            $cekKeranjang=$this->KeranjangModel->cekMenuByidtrx($this->request->getPost('id'));
            if($cekKeranjang){
                $msg=[
                    'error'=>'Menu Sudah Ada Di Keranjang'
                ];
            }else{
                if($this->request->getPost('jumlah')<=$dataMenuByid['stok']){
                    $dataKeranjang=[
                        'id_menu'=>$this->request->getPost('id'),
                        'id_tranksaksi'=>0,
                        'nama_menu'=>$dataMenuByid['nama_menu'],
                        'gambar_menu'=>$dataMenuByid['gambar_menu'],
                        'jumlah'=>$this->request->getPost('jumlah'),
                        'harga'=>$dataMenuByid['harga'],
                        'total_harga'=>$this->request->getPost('jumlah')*$dataMenuByid['harga']
                    ];
                    $this->KeranjangModel->save($dataKeranjang);
                    $dataMenu=[
                        'id'=>$dataMenuByid['id'],
                        'stok'=>$dataMenuByid['stok']-$this->request->getPost('jumlah')
                    ];
                    $this->MenuModel->save($dataMenu);
                    $msg=[
                        'success'=>'Berhasil Menambahkan Menu Ke Keranjang'
                    ];
                }else{
                    $msg=[
                        'error'=>'Jumlah Stok Tidak Cukup'
                    ];
                }
            }
            
            echo json_encode($msg);
        }else{
            exit('request tidak dapat dilakukan');
        }
    }
    public function tranksaksi()
    {
        if(!session()->get('id')){
        return redirect()->to('/'); 

      }
      
      if(session()->get('role')=='manager'){
        return redirect()->to('/manager'); 

      }
      if(session()->get('role')=='admin'){
        return redirect()->to('/admin'); 

      }
     
        $data['css']='tranksaksi.css';
        $data['js']='tranksaksi.js';
        $data['title']='Ayo Ngopi || tranksaksi';
        $data['meja']=$this->MejaModel->find();
        return view('kasir/tranksaksi',$data);
    }
    public function keranjang()
    {
        if(!session()->get('id')){
        return redirect()->to('/'); 

      }
      
      if(session()->get('role')=='manager'){
        return redirect()->to('/manager'); 

      }
      if(session()->get('role')=='admin'){
        return redirect()->to('/admin'); 

      }
     
        $data['css']='keranjang.css';
        $data['js']='keranjang.js';
        $data['title']='Ayo Ngopi || Keranjang';
        $data['meja']=$this->MejaModel->find();
        $data['keranjang']=$this->KeranjangModel->getKeranjangByidTrx();
        return view('kasir/keranjang',$data);
    }
    public function dataKeranjangCard(){
        if($this->request->isAJAX()){
            $data['dataKeranjangCard']=$this->KeranjangModel->getKeranjangByidTrx();
            $data['total_pembayaran']=$this->KeranjangModel->sumKeranjangByIdTranksaksi();
            $msg=[
                
                'data'=>view('kasir/cardKeranjang',$data),
                
            ];
            echo json_encode($msg);
        }else{
            exit('request tidak dapat dilakukan');
        }
    }
    public function tambahJumlah(){
        if($this->request->isAJAX()){
          
           
            $data['menuUser']=$this->KeranjangModel->getKeranjangUserByMenu($this->request->getPost('id_menu'));
            $data['menuP']=$this->MenuModel->getMenuByid($data['menuUser']['id_menu']);
            $jumlahMenu=$data['menuUser']['jumlah']+1;
            if($data['menuP']['stok']!=0){
                $dataMenu=[
                    'id'=>$data['menuP']['id'],
                    'stok'=>$data['menuP']['stok']-1
                ];
                $this->MenuModel->save($dataMenu);
                $data=[
                  'id'=>$data['menuUser']['id'],
                  'jumlah'=>$jumlahMenu,
                  'total_harga'=>$jumlahMenu*$data['menuUser']['harga']
                ];
                $this->KeranjangModel->save($data);
                 
                  
               
                  $msg=[
                      'data'=>'sukses'
                  ];
            }else{
                $msg=[
                    'error'=>'Stok Tidak Cukup'
                ];
            }
            
    
              echo json_encode($msg);
      }else{
          exit('request tidak dapat dilakukan');
      }
    }
    public function kurangJumlah(){
        if($this->request->isAJAX()){
             
                
              $data['menuUser']=$this->KeranjangModel->getKeranjangUserByMenu($this->request->getPost('id_menu'));
              
              $data['menuP']=$this->MenuModel->getMenuByid($data['menuUser']['id_menu']);
              if($data['menuUser']['jumlah']==1){
                    $msg=[
                    'error'=>'batas Maximum Pengurangan Menu'
                ];
              }else{
                  $jumlahMenu=$data['menuUser']['jumlah']-1;
                  $dataMenu=[
                    'id'=>$data['menuP']['id'],
                    'stok'=>$data['menuP']['stok']+1
                ];
                $this->MenuModel->save($dataMenu);
                  $data=[
                    'id'=>$data['menuUser']['id'],
                    'jumlah'=>$jumlahMenu,
                    'total_harga'=>$jumlahMenu*$data['menuUser']['harga']
                  ];
                  $this->KeranjangModel->save($data);
                   $msg=[
                    'data'=>'sukses'
                    ];
              }
               
                
             
                echo json_encode($msg);
        }else{
            exit('request tidak dapat dilakukan');
        }
    }
    public function hapusMenuKeranjang(){
        if($this->request->isAJAX()){
            $data['menuUser']=$this->KeranjangModel->getKeranjangUserByMenu($this->request->getPost('id'));
            $data['menuP']=$this->MenuModel->getMenuByid($data['menuUser']['id_menu']);

            $dataMenu=[
                'id'=>$data['menuP']['id'],
                'stok'=>$data['menuP']['stok']+$data['menuUser']['jumlah']
            ];
            $this->MenuModel->save($dataMenu);
            $this->KeranjangModel->deleteMenuKeranjang($this->request->getPost('id'));
            $msg=[
                'success'=>'Menu Berhasil Dihapus'
            ];
            
            echo json_encode($msg);
        }else{
             exit('request tidak dapat dilakukan');
        }
    }
    public function bayarTranksaksi(){
        if($this->request->isAJAX()){
            $kembalian=$this->request->getPost('bayar_tranksaksi')-$this->request->getPost('total_pembayaran');
            $dataTrx=[
                'id_pegawai'=>session()->get('id'),
                'nama_pembeli'=>$this->request->getPost('nama_pembeli'),
                'total_pembayaran'=>$this->request->getPost('total_pembayaran'),
                'status'=>'diproses',
                'kode_meja'=>$this->request->getPost('meja'),
                'tanggal_tertentu'=>date("Y-m-d"),
                'hari'=>date("d"),
                'bulan'=>date("m")
            ];
             $this->TranksaksiModel->save($dataTrx);
             $this->MejaModel->updateStatusMeja($this->request->getPost('meja'));

            $dataTrxBaruDibuat=$this->TranksaksiModel->getTranksaksiBaru(session()->get('id'));
            $dataKeranjang=$this->KeranjangModel->getKeranjangByidTrx();
            $totalKeranjang=$this->KeranjangModel->totalKeranjangByIdTranksaksi();
            $dataKeranjangBaru=array();
            $dataKeranjangBaru2=[];
            foreach($dataKeranjang as $ds){
                array_push($dataKeranjangBaru,array(
                    'id'=>$ds['id'],
                    'id_tranksaksi'=>$dataTrxBaruDibuat['id']
                ));
                $dataKeranjangBaru2=[
                    'id'=>$ds['id'],
                    'id_tranksaksi'=>$dataTrxBaruDibuat['id']
                ];
            }
            if($totalKeranjang==1){
                $this->KeranjangModel->save($dataKeranjangBaru2);
            }else{
                $this->KeranjangModel->updateBatch($dataKeranjangBaru,'id');
            }
            $dataLog=[
                'id_pegawai'=>session()->get('id'),
                'deskripsi'=>'Melakukan Tranksaksi '.$dataTrxBaruDibuat['id']
            ];
            $this->LogPegawaiModel->save($dataLog);
          
            $msg=[
                'success'=>'Tranksaksi Berhasil,Kembalian'.$kembalian
            ];
            echo json_encode($msg);
           

        }else{
            exit('request tidak dapat dilakukan');
        }
    }
    public function viewTambahPesanan()
    {
        if(!session()->get('id')){
        return redirect()->to('/'); 

      }
      
      if(session()->get('role')=='manager'){
        return redirect()->to('/manager'); 

      }
      if(session()->get('role')=='admin'){
        return redirect()->to('/admin'); 

      }
     
        $data['css']='tambahPesanan.css';
        $data['js']='tambahPesanan.js';
        $data['title']='Ayo Ngopi || tambahPesanan';
        $data['meja']=$this->MejaModel->find();
        return view('kasir/tambahPesanan',$data);
    }
    public function cariMeja(){
        if($this->request->isAJAX()){
            $data['cariMeja']=$this->TranksaksiModel->cariMejaByStatus($this->request->getPost('kode_meja'));
            if(!$data['cariMeja']){
                $msg=[
                    'error'=>'Meja Yang Anda Cari Tidak Ada'
                ];
            }else{
                $msg=[
                    'id_trx'=>$data['cariMeja']['id']
                ];
            }
            
            echo json_encode($msg);
        }else{
            exit('request tidak dapat dilakukan');
        }
    }
    public function tambahPesanan($id_trx){
        if(!session()->get('id')){
        return redirect()->to('/'); 

      }
      
      if(session()->get('role')=='manager'){
        return redirect()->to('/manager'); 

      }
      if(session()->get('role')=='admin'){
        return redirect()->to('/admin'); 

      }
     
        $data['css']='tambahPesanan.css';
        $data['js']='tambahPesanan.js';
        $data['title']='Ayo Ngopi || tambahPesanan';
        $data['id_tranksaksi']=$id_trx;
        
        $data['dataMenu']=$this->MenuModel->find();
        $data['dataTambahKeranjangTranksaksi']=$this->TambahKeranjangTranksaksi->getDataByidtranksaksi($id_trx);
        return view('kasir/tambahPesananIdtrx',$data);
    }
    public function prosesTambahPesananTrx(){
        if($this->request->isAJAX()){
            $dataMenuByid=$this->MenuModel->getMenuByid($this->request->getPost('id_menu'));
            $cekKeranjangTambah=$this->TambahKeranjangTranksaksi->cekMenuByidtrx($this->request->getPost('id_menu'),$this->request->getPost('id_tranksaksi'));
            if($cekKeranjangTambah){
                $msg=[
                    'error'=>'Menu Sudah Ada Di Keranjang'
                ];
                echo json_encode($msg);
            }else{
                if($this->request->getPost('jumlah')<=$dataMenuByid['stok']){
                    $dataTambah=[
                        'id_tranksaksi'=>$this->request->getPost('id_tranksaksi'),
                        'id_menu'=>$this->request->getPost('id_menu'),
                        'jumlah_tambah'=>$this->request->getPost('jumlah'),
                        'total_harga_tambah'=>$this->request->getPost('jumlah')*$dataMenuByid['harga']
                    ];
                    $this->TambahKeranjangTranksaksi->save($dataTambah);
                    $dataKeranjangLama=$this->KeranjangModel->getKeranjangLama($this->request->getPost('id_tranksaksi'),$this->request->getPost('id_menu'));
                    if( $dataKeranjangLama){
                        $dataTambahKeranjang=[
                            'id'=>$dataKeranjangLama['id'],
                            'jumlah'=>$dataKeranjangLama['jumlah']+$this->request->getPost('jumlah'),
                            'total_harga'=>$dataKeranjangLama['total_harga']+$this->request->getPost('jumlah')*$dataMenuByid['harga']
                        ];
                        $this->KeranjangModel->save($dataTambahKeranjang);
                    }else{
                        $dataTambahKeranjang=[
                            'id_menu'=>$this->request->getPost('id_menu'),
                            'id_tranksaksi'=>$this->request->getPost('id_tranksaksi'),
                            'nama_menu'=>$dataMenuByid['nama_menu'],
                            'gambar_menu'=>$dataMenuByid['gambar_menu'],
                            'jumlah'=>$this->request->getPost('jumlah'),
                            'harga'=>$dataMenuByid['harga'],
                            'total_harga'=>$this->request->getPost('jumlah')*$dataMenuByid['harga']
                        ];
                        
                        $this->KeranjangModel->save($dataTambahKeranjang);
                    }
                    $dataMenu=[
                        'id'=>$dataMenuByid['id'],
                        'stok'=>$dataMenuByid['stok']-$this->request->getPost('jumlah')
                    ];
                    $this->MenuModel->save($dataMenu);
                   
                    $msg=[
                        'success'=>'Berhasil Menambahkan Menu Ke Keranjang',
                        'id_trx'=>$this->request->getPost('id_tranksaksi')
                    ];
                    echo json_encode($msg);
                }else{
                    $msg=[
                        'error'=>'Jumlah Stok Tidak Cukup'
                    ];
                    echo json_encode($msg);
                }
            }
           
        }else{
            exit('request tidak dapat dilakukan');
        }
       
        
    }
    public function dataKeranjangTrxTambah(){
        if($this->request->isAJAX()){
            $data['dataKeranjangTambah']=$this->TambahKeranjangTranksaksi->getKeranjangByidTrx($this->request->getGet('id_trx'));
            $data['total_pembayaran']=$this->TambahKeranjangTranksaksi->sumKeranjangTambahByidTranksaksi($this->request->getGet('id_trx'));
            $data['id_tranksaksi']=$this->request->getGet('id_trx');
            $msg=[ 
                'data'=>view('kasir/cardTambah',$data)
            ];
            echo json_encode($msg);
        }else{
            exit('request tidak dapat dilakukan');
        }
    }
   
    public function tambahJumlahTrx(){
        if($this->request->isAJAX()){
          
            
            $data['menuTambah']=$this->TambahKeranjangTranksaksi->getMenuTambahByid($this->request->getPost('id'));
            $data['menuUser']=$this->MenuModel->getMenuByid($data['menuTambah']['id_menu']);
            $dataKeranjangLama=$this->KeranjangModel->getKeranjangLama($data['menuTambah']['id_tranksaksi'],$data['menuTambah']['id_menu']);
            
            $jumlahMenu=$data['menuTambah']['jumlah_tambah']+1;
            if($data['menuUser']['stok']!=0){
                $dataMenu=[
                    'id'=>$data['menuUser']['id'],
                    'stok'=>$data['menuUser']['stok']-1
                ];
                $this->MenuModel->save($dataMenu);
                $dataKeranjang=[
                    'id'=>$dataKeranjangLama['id'],
                    'jumlah'=>$dataKeranjangLama['jumlah']+1,
                    'total_harga'=>$dataKeranjangLama['total_harga']+$data['menuUser']['harga']
                ];
                $this->KeranjangModel->save($dataKeranjang);
                $data=[
                  'id_tambah'=>$data['menuTambah']['id_tambah'],
                  'jumlah_tambah'=>$jumlahMenu,
                  'total_harga_tambah'=>$jumlahMenu*$data['menuUser']['harga']
                ];
               
                $this->TambahKeranjangTranksaksi->save($data);
                
                $msg=[
                    'data'=>'sukses'
                ];
            }else{
                $msg=[
                    'error'=>'Stok Tidak Cukup'
                ];
            }
           

         
             
              
           
             
    
              echo json_encode($msg);
      }else{
          exit('request tidak dapat dilakukan');
      }
    }
    public function kurangJumlahTrx(){
        if($this->request->isAJAX()){
             
                
            
            $data['menuTambah']=$this->TambahKeranjangTranksaksi->getMenuTambahByid($this->request->getPost('id'));
            
            $data['menuUser']=$this->MenuModel->getMenuByid($data['menuTambah']['id_menu']);
            $dataKeranjangLama=$this->KeranjangModel->getKeranjangLama($data['menuTambah']['id_tranksaksi'],$data['menuTambah']['id_menu']);
            
              
            $jumlahMenu=$data['menuTambah']['jumlah_tambah']-1;

            if($data['menuTambah']['jumlah_tambah']==1){
                $msg=[
                    'error'=>'Batax Pengurangan Maximum'
                ];
            }else{
                $dataMenu=[
                    'id'=>$data['menuUser']['id'],
                    'stok'=>$data['menuUser']['stok']+1
                ];
                $this->MenuModel->save($dataMenu);
                $dataKeranjang=[
                    'id'=>$dataKeranjangLama['id'],
                    'jumlah'=>$dataKeranjangLama['jumlah']-1,
                    'total_harga'=>$dataKeranjangLama['total_harga']-$data['menuUser']['harga']*1
                ];
                $this->KeranjangModel->save($dataKeranjang);
                $data=[
                    'id_tambah'=>$data['menuTambah']['id_tambah'],
                    'jumlah_tambah'=>$jumlahMenu,
                    'total_harga_tambah'=>$jumlahMenu*$data['menuUser']['harga']
                  ];
                 
                  $this->TambahKeranjangTranksaksi->save($data);
                  
                
                 
                   
                    
                 
                    $msg=[
                        'data'=>'sukses'
                    ];
            }

           
    
              echo json_encode($msg);
        }else{
            exit('request tidak dapat dilakukan');
        }
    }
    public function hapusMenuKeranjangTambah(){
        if($this->request->isAJAX()){
            $data['menuTambah']=$this->TambahKeranjangTranksaksi->getMenuTambahByid($this->request->getPost('id'));
            $data['menuUser']=$this->MenuModel->getMenuByid($data['menuTambah']['id_menu']);
            $dataMenu=[
                'id'=>$data['menuUser']['id'],
                'stok'=>$data['menuUser']['stok']+$data['menuTambah']['jumlah_tambah']
            ];
            $this->MenuModel->save($dataMenu);
            $dataKeranjangLama=$this->KeranjangModel->getKeranjangLama($data['menuTambah']['id_tranksaksi'],$data['menuTambah']['id_menu']);
            $dataKeranjang=[
                'id'=>$dataKeranjangLama['id'],
                'jumlah'=> $dataKeranjangLama['jumlah']-$data['menuTambah']['jumlah_tambah'],
                'total_harga'=> $dataKeranjangLama['total_harga']-$data['menuTambah']['total_harga_tambah']
            ];
            $this->KeranjangModel->save($dataKeranjang);

            $this->TambahKeranjangTranksaksi->deleteMenuKeranjangTambah($this->request->getPost('id'));
            $msg=[
                'success'=>'Menu Berhasil Dihapus'
            ];
            
            echo json_encode($msg);
        }else{
             exit('request tidak dapat dilakukan');
        }
    }
    public function bayarTambahPesanan(){
        if($this->request->isAJAX()){
            $kembalian=$this->request->getPost('bayar_tranksaksi')-$this->request->getPost('total_pembayaran');
            $tranksaksiByid=$this->TranksaksiModel->getTranksaksiBYid($this->request->getPost('id_tranksaksi'));
            $dataTranksaksi=[
                'id'=>$tranksaksiByid['id'],
                'total_pembayaran'=>$tranksaksiByid['total_pembayaran']+$this->request->getPost('total_pembayaran')
            ];
            $this->TranksaksiModel->save($dataTranksaksi);
            $this->TambahKeranjangTranksaksi->deleteByidTranksaksi($this->request->getPost('id_tranksaksi'));
            $msg=[
                'success'=>'Pembayaran Berhasil,Kembalian:'.$kembalian
            ];
            echo json_encode($msg);
        }else{
            exit('request tidak dapat dilakukan');
        }
    }
    public function viewTranksaksi()
    {
        if(!session()->get('id')){
        return redirect()->to('/'); 

      }
      
      if(session()->get('role')=='manager'){
        return redirect()->to('/manager'); 

      }
      if(session()->get('role')=='admin'){
        return redirect()->to('/admin'); 

      }
     
        $data['css']='listTranksaksi.css';
        $data['js']='listTranksaksi.js';
        $data['title']='Ayo Ngopi || listTranksaksi';
        return view('kasir/listTranksaksi',$data);
    }
    public function dataTranksaksiDiproses(){
        if($this->request->isAJAX()){
            $data['dataTranksaksiDiprosesp']=$this->TranksaksiModel->getTranksaksiDiproses();

            $msg=[
                'data'=>view('kasir/dataTranksaksiDiproses',$data)
            ];
            echo json_encode($msg);
        }else{
            exit('request tidak dapat dilakukan');
        }
    }
    public function updateTranksaksiDiproses(){
        if($this->request->isAJAX()){
            $dataTranksaksiDiproses=$this->TranksaksiModel->getTranksaksiBYidDiproses($this->request->getPost('id'));
            $dataTrx=[
                'id'=>$dataTranksaksiDiproses['id'],
                'status'=>'selesai'
            ];
            $this->TranksaksiModel->save($dataTrx);
            $dataMejaOn=$this->MejaModel->getMejaByKode($dataTranksaksiDiproses['kode_meja']);
            $dataMeja=[
                'id'=>$dataMejaOn['id'],
                'status'=>0
            ];
            $this->MejaModel->save($dataMeja);
            $msg=[
                'success'=>'Berhasil Memperbarui Tranksaksi'
            ];
            echo json_encode($msg);
        }else{
            exit('request tidak dapat dilakukan');
        }
    }
    public function dataMenuPesanan(){
        if($this->request->isAJAX()){
            $data['dataMenuPesanan']=$this->KeranjangModel->getMenuByIdTranksaksi($this->request->getPost('id_tranksaksi'));

            $msg=[
                'data'=>view('kasir/cardMenuPesanan',$data)
            ];
            echo json_encode($msg);
        }else{
            exit('request tidak dapat dilakukan');
        }
    }
}