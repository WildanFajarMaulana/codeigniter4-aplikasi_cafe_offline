<?php

namespace App\Controllers;
use App\Models\MenuModel;
use App\Models\MejaModel;
use App\Models\TranksaksiModel;
use App\Models\LogPegawaiModel;
use App\Models\LoginModel;
class Manager extends BaseController
{
    protected $MenuModel;
    protected $MejaModel;
    protected $TranksaksiModel;
    protected $LogPegawaiModel;
    protected $LoginModel;
    public function __construct()
    {
        $this->MenuModel = new MenuModel();
        $this->MejaModel = new MejaModel();
        $this->TranksaksiModel = new TranksaksiModel();
        $this->LogPegawaiModel = new LogPegawaiModel();
        $this->LoginModel = new LoginModel();

    }
    public function index()
    {
          if(!session()->get('id')){
        return redirect()->to('/'); 

      }
      if(session()->get('role')=='kasir'){
        return redirect()->to('/kasir'); 

      }
     
      if(session()->get('role')=='admin'){
        return redirect()->to('/admin'); 

      }
     
        $data['css']='dataMenu.css';
        $data['js']='dataMenu.js';
        $data['title']='Ayo Ngopi || DataMenu';
        return view('manager/dataMenu',$data);
    }
    public function dataMenu(){
        if($this->request->isAJAX()){
            $data['dataMenu']=$this->MenuModel->find();

            $msg=[
                'data'=>view('manager/tableMenu',$data)
            ];
            echo json_encode($msg);
        }else{
            exit('request tidak dapat dilakukan');
        }
    }
    public function dataMenuByid(){
        if($this->request->isAJAX()){
            $data['dataMenuBYid']=$this->MenuModel->getMenuByid($this->request->getGet('id'));
            $msg=[
                'data'=>$data['dataMenuBYid']
            ];
            echo json_encode($msg);
        }else{
            exit("request tidak dapat dilakukan");
        }
       
    }
    public function menu(){
        if($this->request->isAjax()){
            if($this->request->getPost('id')){
                
                if($this->request->getFile('gambar_menu')==""){
                    $data=[
                        'id'=>$this->request->getPost('id'),
                        'nama_menu'=>$this->request->getPost('nama_menu'),
                        'gambar_menu'=>$this->request->getPost('gambar_lama'),
                        'stok'=>$this->request->getPost('stok'),
                        'harga'=>$this->request->getPost('harga'),
                        'kategori'=>$this->request->getPost('kategori')
                    ];
                    $this->MenuModel->save($data);
                    $msg=[
                        'success'=>'Berhasil Update Menu'
                    ];
                }else{
                    $validation=\Config\Services::validation();
                    $valid=$this->validate([
                      
                        'gambar_menu'=>[
                            'rules'=>'max_size[gambar_menu,1024]|is_image[gambar_menu]|mime_in[gambar_menu,image/jpg,image/jpeg,image/png]',
                            'errors'=>[
                                'max_size'=>'ukuran gambar terlalu besar',
                                'is_image'=>'yg anda pilih bukan gambar',
                                'mime_in'=>'yang anda pilih bukan gambar'
                            ]
                        ]
                        
                    ]);
        
                      if(!$valid){
                        $msg=[
                            'error'=>[
                              
                                'gambar_menu'=>$validation->getError('gambar_menu')
                            ]
                        ];
                       
                      }else{
                                // ambil gambar
                        $filegambar=$this->request->getFile('gambar_menu');
                    
                        
                        // generate nama gambar random
                        if($filegambar==''){
                            $namagambar='';
                        }else{
                            $namagambar=$filegambar->getRandomName();
                        // pindahkan file ke folder image
                        $filegambar->move('img',$namagambar);
                        // ambil nama file
                        // $namaSampul=$fileSampul->getName();
                        }
                        if(!$this->request->getFile('gambar_menu')){

                        }else{
                           unlink('img/'.$this->request->getPost('gambar_lama'));
                        }
                       
                        
            
                        $data=[
                            'id'=>$this->request->getPost('id'),
                            'nama_menu'=>$this->request->getPost('nama_menu'),
                            'gambar_menu'=>$namagambar,
                            'stok'=>$this->request->getPost('stok'),
                            'harga'=>$this->request->getPost('harga'),
                            'kategori'=>$this->request->getPost('kategori')
                        ];
                        $this->MenuModel->save($data);
                        
                        $msg=[
                            'success'=>'Berhasil Update Menu'
                        ];
                        }
                }
                echo json_encode($msg);
            }else{
                $validation=\Config\Services::validation();
                $valid=$this->validate([
                    'nama_menu'=>[
                        'rules'=>'required',
                        'errors'=>[
                            'required'=>'{field}  harus diisi'
                            
                        ]
                    ],
                    'gambar_menu'=>[
                        'rules'=>'max_size[gambar_menu,1024]|is_image[gambar_menu]|mime_in[gambar_menu,image/jpg,image/jpeg,image/png]',
                        'errors'=>[
                            'max_size'=>'ukuran gambar terlalu besar',
                            'is_image'=>'yg anda pilih bukan gambar',
                            'mime_in'=>'yang anda pilih bukan gambar'
                        ]
                    ],
                    'stok'=>[
                            'rules'=>'required',
                            'errors'=>[
                                'required'=>'{field}  harus diisi'
                            ]
                    ],
                    'harga'=>[
                            'rules'=>'required',
                            'errors'=>[
                                'required'=>'{field}  harus diisi'
                            ]
                    ],
                    'kategori'=>[
                        'rules'=>'required',
                        'errors'=>[
                            'required'=>'{field}  harus diisi'
                        ]
                    ],
                    
                ]);
    
                  if(!$valid){
                    $msg=[
                        'error'=>[
                            'nama_menu'=>$validation->getError('nama_menu'),
                            'gambar_menu'=>$validation->getError('gambar_menu'),
                            'stok'=>$validation->getError('stok'),
                            'harga'=>$validation->getError('harga'),
                            'kategori'=>$validation->getError('kategori')
                        ]
                    ];
                   
                  }else{
                            // ambil gambar
                    $filegambar=$this->request->getFile('gambar_menu');
                
                    
                    // generate nama gambar random
                    if($filegambar==''){
                        $namagambar='';
                    }else{
                        $namagambar=$filegambar->getRandomName();
                    // pindahkan file ke folder image
                    $filegambar->move('img',$namagambar);
                    // ambil nama file
                    // $namaSampul=$fileSampul->getName();
                    }
                    
        
                    $data=[
                        'nama_menu'=>$this->request->getPost('nama_menu'),
                        'gambar_menu'=>$namagambar,
                        'stok'=>$this->request->getPost('stok'),
                        'harga'=>$this->request->getPost('harga'),
                        'kategori'=>$this->request->getPost('kategori')
                    ];
                    $this->MenuModel->save($data);
                    $dataLog=[
                        'id_pegawai'=>session()->get('id'),
                        'deskripsi'=>'Menambahkan Menu '.$this->request->getPost('nama_menu')
                    ];
                    $this->LogPegawaiModel->save($dataLog);
                    $msg=[
                        'success'=>'Berhasil Menambahkan Menu'
                    ];
                    }
                    echo json_encode($msg);
                  }

            
              
        }else{
            exit('request tidak dapat dilakukan');
        }
    }
    public function hapusMenu(){
        if($this->request->isAJAX()){
            $getMenuByid=$this->MenuModel->getMenuByid($this->request->getPost('id'));
            unlink('img/'.$getMenuByid['gambar_menu']);
            $delete=$this->MenuModel->deleteMenu($this->request->getPost('id'));
           
            if($delete){
                $msg=[
                    'success'=>'Berhasil Hapus Menu'
                ];
            }
          
            echo json_encode($msg);
        }else{
            exit("request tidak dapat dilakukan");
        }
    }
    public function viewMeja(){
          if(!session()->get('id')){
        return redirect()->to('/'); 

      }
      if(session()->get('role')=='kasir'){
        return redirect()->to('/kasir'); 

      }
     
      if(session()->get('role')=='admin'){
        return redirect()->to('/admin'); 

      }
     
        $data['css']='dataMeja.css';
        $data['js']='dataMeja.js';
        $data['title']='Ayo Ngopi || DataMeja';
        return view('manager/dataMeja',$data);
    }
    public function dataMeja(){
        if($this->request->isAJAX()){
            $data['dataMeja']=$this->MejaModel->find();

            $msg=[
                'data'=>view('manager/tableMeja',$data)
            ];
            echo json_encode($msg);
        }else{
            exit('request tidak dapat dilakukan');
        }
    }
    public function meja(){
        if($this->request->isAjax()){
            if($this->request->getPost('id')){   
                    $validation=\Config\Services::validation();
                    $valid=$this->validate([
                      
                        'kode_meja'=>[
                            'rules'=>'required',
                            'errors'=>[
                                'required'=>'{field}  harus diisi'
                                
                            ]
                        ],
                        'status'=>[
                            'rules'=>'required',
                            'errors'=>[
                                'required'=>'{field}  harus diisi'
                                
                            ]
                        ],
                        
                    ]);
        
                      if(!$valid){
                        $msg=[
                            'error'=>[   
                                'kode_meja'=>$validation->getError('kode_meja'),
                                'status'=>$validation->getError('status')
                            ]
                        ];
                       
                      }else{
                           
                        $cekMeja=$this->MejaModel->getMejaByKode($this->request->getPost('kode_meja'));
                        if($cekMeja){
                            $msg=[
                                'errorMeja'=>'Kode Meja Sudah Terdaftar'
                            ];
                        }else{
                            $data=[
                                'id'=>$this->request->getPost('id'),
                                'kode_meja'=>$this->request->getPost('kode_meja'),
                                'status'=>$this->request->getPost('status')
                            ];
                            $this->MejaModel->save($data);
                            $msg=[
                                'success'=>'Berhasil Update Meja'
                            ];
                        
                        }
                            
                           
                       
                        }
                
                echo json_encode($msg);
            }else{
                $validation=\Config\Services::validation();
                    $valid=$this->validate([
                      
                        'kode_meja'=>[
                            'rules'=>'required',
                            'errors'=>[
                                'required'=>'{field}  harus diisi'
                                
                            ]
                        ],
                        'status'=>[
                            'rules'=>'required',
                            'errors'=>[
                                'required'=>'{field}  harus diisi'
                                
                            ]
                        ],
                        
                    ]);
        
                    if(!$valid){
                        $msg=[
                            'error'=>[   
                                'kode_meja'=>$validation->getError('kode_meja'),
                                'status'=>$validation->getError('status')
                            ]
                        ];
                       
                    }else{
                        $cekMeja=$this->MejaModel->getMejaByKode($this->request->getPost('kode_meja'));
                        if($cekMeja){
                            $msg=[
                                'errorMeja'=>'Kode Meja Sudah Terdaftar'
                            ];
                        }else{
                            $data=[
                                'kode_meja'=>$this->request->getPost('kode_meja'),
                                'status'=>$this->request->getPost('status')
                            ];
                            $this->MejaModel->save($data);
                            $msg=[
                                'success'=>'Berhasil Menambahkan Meja'
                            ];
                        }
                       
                    }
                    echo json_encode($msg);
                  }

            
              
        }else{
            exit('request tidak dapat dilakukan');
        }
    }
    public function dataMejaByid(){
        if($this->request->isAJAX()){
            $data['dataMejaByid']=$this->MejaModel->getMejaByid($this->request->getGet('id'));
            $msg=[
                'data'=>$data['dataMejaByid']
            ];
            echo json_encode($msg);
        }else{
            exit("request tidak dapat dilakukan");
        }
       
    }
    public function hapusMeja(){
        if($this->request->isAJAX()){
            $delete=$this->MejaModel->deleteMeja($this->request->getPost('id'));
           
            if($delete){
                $msg=[
                    'success'=>'Berhasil Hapus Meja'
                ];
            }
          
            echo json_encode($msg);
        }else{
            exit("request tidak dapat dilakukan");
        }
    }
    public function viewRiwayatTrx(){
          if(!session()->get('id')){
        return redirect()->to('/'); 

      }
      if(session()->get('role')=='kasir'){
        return redirect()->to('/kasir'); 

      }
     
      if(session()->get('role')=='admin'){
        return redirect()->to('/admin'); 

      }
     
        $data['css']='dataRiwayatTrx.css';
        $data['js']='dataRiwayatTrx.js';
        $data['title']='Ayo Ngopi || dataRiwayatTrx';
        $data['nama_pegawai']=$this->LoginModel->getUserByRoleKasir();
        return view('manager/dataRiwayatTrx',$data);
    }
    public function dataTrx(){
        if($this->request->isAJAX()){
            $data['dataTrx']=$this->TranksaksiModel->getTranksaksiSelesai();

            $msg=[
                'data'=>view('manager/tableTranksaksi',$data)
            ];
            echo json_encode($msg);
        }else{
            exit('request tidak dapat dilakukan');
        }
    }
    public function viewLogPegawai(){
          if(!session()->get('id')){
        return redirect()->to('/'); 

      }
      if(session()->get('role')=='kasir'){
        return redirect()->to('/kasir'); 

      }
     
      if(session()->get('role')=='admin'){
        return redirect()->to('/admin'); 

      }
     
        $data['css']='dataLogPegawai.css';
        $data['js']='dataLogPegawai.js';
        $data['title']='Ayo Ngopi || dataLogPegawai';
        return view('manager/dataLogPegawai',$data);
    }
    public function dataLog(){
        if($this->request->isAJAX()){
            $data['dataLog']=$this->LogPegawaiModel->getLogKasir();
            $msg=[
                'data'=>view('manager/tableLog',$data)
            ];
            echo json_encode($msg);
        }else{
            exit("request tidak dapat dilakukan");
        }
        
    }
    public function filterNama(){
        if($this->request->isAJAX()){
            $data['dataTrxByNamaPegawai']=$this->TranksaksiModel->getTranksaksiByNamaPegawai($this->request->getPost('id_login'));

            $msg=[
                'data'=>view('manager/tableTranksaksiByNama',$data)
            ];
            echo json_encode($msg);
        }else{
            exit('request tidak dapat dilakukan');
        }
    }
    public function filterTanggal(){
        if($this->request->isAJAX()){
            $data['dataTrxByTanggal']=$this->TranksaksiModel->getTranksaksiByTanggal($this->request->getPost('tanggal_awal'),$this->request->getPost('tanggal_akhir'));

            $msg=[
                'data'=>view('manager/tableTranksaksiByTanggal',$data)
            ];
            echo json_encode($msg);
        }else{
            exit('request tidak dapat dilakukan');
        }
    }
    public function filterTotalPembayaran(){
        if($this->request->isAJAX()){
            $hari=date("d");
            $bulan=date("m");
            if($this->request->getPost('harianOrBulanan')=='harian'){
                $data['dataTrxByHarianOrBulanan']=$this->TranksaksiModel->getTotalPembayaranByHarian($hari);
            }else if($this->request->getPost('harianOrBulanan')=='bulanan'){
                $data['dataTrxByHarianOrBulanan']=$this->TranksaksiModel->getTotalPembayaranByBulanan($bulan);
            }else{
                
            }
            
            $msg=[
                'data'=>$data['dataTrxByHarianOrBulanan']
            ];
            echo json_encode($msg);
        }else{
            exit('request tidak dapat dilakukan');
        }
    }
}