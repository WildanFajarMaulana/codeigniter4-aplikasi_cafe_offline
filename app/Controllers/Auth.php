<?php

namespace App\Controllers;
use App\Models\LoginModel;
class Auth extends BaseController
{
    protected $LoginModel;
    public function __construct()
    {
        $this->LoginModel = new LoginModel();

    }
    public function index()
    {
        if(session()->get('id')){
            return redirect()->to('/kasir'); 
        }
        return view('auth/login');
    }
    public function login(){
        if($this->request->isAJAX()){
            $validation=\Config\Services::validation();
            $valid=$this->validate([
                'username'=>[
                        'rules'=>'required',
                        'errors'=>[
                            'required'=>'{field}  harus diisi'
                        ]
                ],
                'password'=>[
                        'rules'=>'required|',
                        'errors'=>[
                            'required'=>'{field}  harus diisi'
                          
                        ]
                ]
            ]);

              if(!$valid){
                $msg=[
                    'errorValid'=>[
                        'username'=>$validation->getError('username'),
                        'password'=>$validation->getError('password')
                    ]
                ];
               
              }else{

                $username=$this->request->getPost('username');
                $password=$this->request->getPost('password');

                $user=$this->LoginModel->getUserByusername($username);
                if ($user) {
                    if($user['role']=='admin'){
                        session()->set([
                            'nama'=>$user['nama'],
                            'username' => $user['username'],
                            'role' => $user['role'],
                            'id'=>$user['id_login']
                        ]);
                        $msg=[
                        'successAdmin'=>'anda login sebagai Admin'
                        ];    
                    }else{
                        if (password_verify($password, $user['password'])) {  
                            // session
                            session()->set([
                             'nama'=>$user['nama'],
                             'username' => $user['username'],
                             'role' => $user['role'],
                             'id'=>$user['id_login']
                             ]);
                            if($user['role']=='kasir'){
                             $msg=[
                                'successKasir'=>'anda login sebagai Kasir'
                             ];    
                            }else if($user['role']=='manager'){
                             $msg=[
                                'successManager'=>'anda login sebagai Manager'
                             ];    
                            }else{
                               $msg=[
                                'successNull'=>'null'
                             ]; 
                            }
                        }else{
                             $msg=[
                                'errorPassword'=>'Password Salah'
                             ];  
                                
                        } 
                    }
                 
                } 
                else{
                
                     $msg=[
                                'errorUsername'=>'Username Tidak Terdaftar'
                     ];  
                }
                
              }
               
              echo json_encode($msg);
        }else{
            exit('request tidak dapat dilakukan');
        }
    }
    public function logout(){
         
        if($this->request->isAJAX()){
        
            session()->destroy();
            $msg=[
                'data'=>'Logout Berhasil'
            ];

            
            echo json_encode($msg);
        }else{
            exit('request tidak dapat dilakukan');
        }
        
    }
  

    
}