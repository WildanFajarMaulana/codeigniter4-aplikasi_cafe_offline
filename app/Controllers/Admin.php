<?php

namespace App\Controllers;
use App\Models\LoginModel;
use App\Models\LogPegawaiModel;

class Admin extends BaseController
{
    protected $LoginModel;
    protected $LogPegawaiModel;
    public function __construct()
    {
        $this->LoginModel = new LoginModel();
        $this->LogPegawaiModel = new LogPegawaiModel();

    }
    public function index()
    {
      if(!session()->get('id')){
        return redirect()->to('/'); 

      }
      if(session()->get('role')=='kasir'){
        return redirect()->to('/kasir'); 

      }
      if(session()->get('role')=='manager'){
        return redirect()->to('/manager'); 

      }
      
     
      $data['css']='dataUser.css';
      $data['title']='Ayo Ngopi || ManageUser';
      $data['js']='dataUser.js';
     
      return view('admin/dataUser.php',$data);
    }
    public function dataUser(){
        if($this->request->isAJAX()){
            $data['dataUser']=$this->LoginModel->getUser();
            $msg=[
                'data'=>view('admin/tableUser',$data)
            ];
            echo json_encode($msg);
        }else{
            exit("request tidak dapat dilakukan");
        }
        
    }
    public function dataUserByid(){
        if($this->request->isAJAX()){
            $data['dataUserByid']=$this->LoginModel->getUserByid($this->request->getGet('id'));
            $msg=[
                'data'=>$data['dataUserByid']
            ];
            echo json_encode($msg);
        }else{
            exit("request tidak dapat dilakukan");
        }
       
    }
    public function user(){
        if($this->request->isAJAX()){
            if($this->request->getPost('id')){
                $dataUser=$this->LoginModel->getUserByid($this->request->getPost('id'));


                if($dataUser['username']==$this->request->getPost('username')){
                    $rules='required';
                }else{
                    $rules='required|is_unique[tb_login.username]';
                }


            
                
                $validation=\Config\Services::validation();
                $valid=$this->validate([
                    'nama'=>[ 
                        'rules'=>'required',
                        'errors'=>[
                            'required'=>'{field}  harus diisi',
                            'is_unique'=>'{field}  sudah terdaftar'
                            
                        ]
                    ],
                    'username'=>[
                        'rules'=>$rules,
                        'errors'=>[
                            'required'=>'{field}  harus diisi',
                            'is_unique'=>'{field}  sudah terdaftar'
                            
                        ]
                        ],
                    'role'=>[
                            'rules'=>'required',
                            'errors'=>[
                                'required'=>'{field}  harus diisi'
                            ]
                    ]
                ]);
                if(!$valid){
                    $msg=[
                        'error'=>[
                            'nama'=>$validation->getError('nama'),
                            'username'=>$validation->getError('username'),
                            'role'=>$validation->getError('role')
                        ]              
                    ];               
                }else{
                    if($this->request->getPost('password')==""){
                        $data=[
                            'id_login'=>$this->request->getPost('id'),
                            'nama'=>$this->request->getPost("nama"),
                            'username'=>$this->request->getPost("username"),
                            'password'=>$dataUser['password'],
                            'role'=>$this->request->getPost('role')
                        ];
    
                        $this->LoginModel->save($data);
                    }else{
                        $data=[
                            'id_login'=>$this->request->getPost('id'),
                            'nama'=>$this->request->getPost("nama"),
                            'username'=>$this->request->getPost("username"),
                            'password'=>password_hash($this->request->getPost("password"),PASSWORD_BCRYPT),
                            'role'=>$this->request->getPost('role')
                        ];
    
                        $this->LoginModel->save($data);
                    }
                    $msg=[
                        'success'=>'Akun Berhasil Diubah'
                    ];
                }
                echo json_encode($msg);
              
            }else{
                $validation=\Config\Services::validation();
                $valid=$this->validate([
                    'nama'=>[ 
                        'rules'=>'required',
                        'errors'=>[
                            'required'=>'{field}  harus diisi',
                            'is_unique'=>'{field}  sudah terdaftar'
                            
                        ]
                    ],
                    'username'=>[
                        'rules'=>'required|is_unique[tb_login.username]',
                        'errors'=>[
                            'required'=>'{field}  harus diisi',
                            'is_unique'=>'{field}  sudah terdaftar'
                            
                        ]
                    ],
                    'password'=>[
                            'rules'=>'required',
                            'errors'=>[
                                'required'=>'{field}  harus diisi'
                            ]
                    ],
                    'role'=>[
                            'rules'=>'required',
                            'errors'=>[
                                'required'=>'{field}  harus diisi'
                            ]
                    ]
                ]);
                if(!$valid){
                    $msg=[
                        'error'=>[
                            'nama'=>$validation->getError('nama'),
                            'username'=>$validation->getError('username'),
                            'password'=>$validation->getError('password'),
                            'role'=>$validation->getError('role')
                        ]              
                    ];               
                }else{
                    $data=[
                        'nama'=>$this->request->getPost("nama"),
                        'username'=>$this->request->getPost("username"),
                        'password'=>password_hash($this->request->getPost("password"),PASSWORD_BCRYPT),
                        'role'=>$this->request->getPost('role')
                    ];

                    $this->LoginModel->save($data);

                    $msg=[
                        'success'=>'Akun Berhasil Dibuat'
                    ];
                
                }  
                echo json_encode($msg);
            }
            

        }else{
            exit("request tidak dapat dilakukan");
        }
       
    }
    public function hapusUser(){
        if($this->request->isAJAX()){
            $delete=$this->LoginModel->deleteUser($this->request->getPost('id'));
            if($delete){
                $msg=[
                    'success'=>'Berhasil Hapus Data'
                ];
            }
          
            echo json_encode($msg);
        }else{
            exit("request tidak dapat dilakukan");
        }
    }
    public function logPegawai()
    {
        if(!session()->get('id')){
            return redirect()->to('/'); 
    
          }
          if(session()->get('role')=='kasir'){
            return redirect()->to('/kasir'); 
    
          }
          if(session()->get('role')=='manager'){
            return redirect()->to('/manager'); 
    
          }
        
         
      $data['css']='logPegawai.css';
      $data['title']='Ayo Ngopi || LogPegawai';
      $data['js']='logPegawai.js';
     
      return view('admin/logPegawai.php',$data);
    }
    public function dataLog(){
        if($this->request->isAJAX()){
            $data['dataLog']=$this->LogPegawaiModel->getLog();
            $msg=[
                'data'=>view('admin/tableLog',$data)
            ];
            echo json_encode($msg);
        }else{
            exit("request tidak dapat dilakukan");
        }
        
    }
}   