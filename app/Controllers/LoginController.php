<?php
namespace App\Controllers;
use App\Models\UserModel;
class LoginController extends BaseController
{
    public function index()
    {
        helper(['form']);
        return view('home/login.php');
    } 
  
    public function loginAuth()
    {
        $session = session();
        $userModel = new UserModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        
        $data = $userModel->where('email', $email)->first();
        
        if($data){
            $pass = $data['password'];
            $authenticatePassword = password_verify($password, $pass);
            if($authenticatePassword){
                $ses_data = [
                    'id' => $data['id'],
                    'firstname' => $data['firstname'],
                    'lastname' => $data['lastname'],
                    'email' => $data['email'],
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/dashboard');
            
            }else{
                $session->setFlashdata('msg', 'Password is incorrect.');
                return redirect()->to('/');
            }
        }else{
            $session->setFlashdata('msg', 'Email does not exist.');
            return redirect()->to('/');
        }
    }
}