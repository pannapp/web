<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class AdminController extends Controller
{
    public function AuthLogin(){
        $admin_id= Session::get('id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function index(){
        return view('admin_login');
    }
    public function show_dashboard(){
        $this->AuthLogin();
        return view('admin.dashboard');
    }
    public function dashboard(Request $request){
        $admin_taikhoan = $request->admin_taikhoan;
        $admin_password = $request->admin_password;
        
        
        $result = DB::table('nguoi_dung')
                ->where('tai_khoan', $admin_taikhoan)
                ->where('vai_tro', 0)
                ->first();
        
        if ($result) {
            // Kiểm tra mật khẩu bằng password_verify()
            if (password_verify($admin_password, $result->mat_khau)) {
                Session::put('ho_ten',$result->ho_ten);
                Session::put('id',$result->id);
                return Redirect::to('/dashboard');
                // Sau này có thể dùng session để lưu thông tin user
            } else {
                Session::put('message', 'Tài khoản hoặc mật khẩu không chính xác. Vui lòng nhập lại');

                return Redirect::to('/admin');

            }
        } else {
            Session::put('message', 'Tài khoản không tồn tại.');
            return Redirect::to('/admin');

        }


    }

    public function logout(Request $request){
        $this->AuthLogin();
        Session::put('ho_ten',null);
        Session::put('id',null);
        return Redirect::to('/admin');
        
    }


}
