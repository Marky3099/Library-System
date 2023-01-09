<?php
namespace App\Controllers;
use App\Models\UserModel;
class RegisterController extends BaseController
{
    public function __construct(){
        helper(['url','form']);
    }
    public function index()
    {
        helper(['form']);
        $data = [];
        return view('home/register.php', $data);
    }
    public function store()
    {
        // dd($_POST);
        helper(['form']);
        $rules = [
            'firstname'          => 'required|min_length[2]|max_length[50]',
            'lastname'          => 'required|min_length[2]|max_length[50]',
            'email'         => 'required|min_length[4]|max_length[100]|valid_email|is_unique[users.email]',
            'password'      => 'required|min_length[4]|max_length[50]',
            'confirmpassword'  => 'matches[password]'
        ];
          
        if($this->validate($rules)){
            $userModel = new UserModel();
            $data = [
                'firstname'     => $this->request->getVar('firstname'),
                'lastname'     => $this->request->getVar('lastname'),
                'email'    => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'role' => 'Student',
            ];
            $userModel->save($data);
            return redirect()->to('/');
        }else{
            $data['validation'] = $this->validator;
            return view('home/register.php', $data);
        }
          
    }
}
