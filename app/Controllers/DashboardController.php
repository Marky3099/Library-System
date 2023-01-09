<?php
namespace App\Controllers;
use App\Models\UserModel;
class DashboardController extends BaseController
{
    public function index()
    {
        $session = session();
        // echo "Hello : ".$session->get('firstname')." ".$session->get('lastname');
        return view ('admin/dashboard.php');
    }
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}