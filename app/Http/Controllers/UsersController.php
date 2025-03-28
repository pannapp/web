<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class UsersController extends Controller
{
    public function AuthLogin(){
        $admin_id= Session::get('id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_user(){
        $this->AuthLogin();

        return view('admin.add_user');
    }

    public function all_user(){
        $this->AuthLogin();

        $all_users=DB::table('nguoi_dung')->get();
        $manager_category_user = view('admin.all_user')->with('all_user', $all_users);
        return view('admin_layout')->with('admin.all_user', $manager_category_user);

    }



    public function save_user(Request $request){
        $this->AuthLogin();

        // Kiểm tra dữ liệu đầu vào
        $validatedData = $request->validate([
            'ho_ten' => 'required',
            'ngay_sinh' => 'nullable|date',
            'email' => 'required|email|unique:nguoi_dung,email',
            'sdt' => 'nullable|unique:nguoi_dung,sdt',
            'vai_tro' => 'required|in:0,1',
            'tai_khoan' => 'required|unique:nguoi_dung,tai_khoan',
            'mat_khau' => 'required|min:3',
        ], [
            'ho_ten.required' => 'Họ tên không được để trống.',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email đã tồn tại.',
            'sdt.unique' => 'Số điện thoại đã được sử dụng.',
            'vai_tro.required' => 'Vai trò không được để trống.',
            'tai_khoan.required' => 'Tài khoản không được để trống.',
            'tai_khoan.unique' => 'Tài khoản đã tồn tại.',
            'mat_khau.required' => 'Mật khẩu không được để trống.',
            'mat_khau.min' => 'Mật khẩu phải có ít nhất 3 ký tự.',
        ]);

        // Xử lý dữ liệu
        $ngay_sinh = $request->ngay_sinh ? date('Y-m-d', strtotime($request->ngay_sinh)) : null;

        $data = [
            'ho_ten' => $request->ho_ten,
            'ngay_sinh' => $ngay_sinh,
            'email' => $request->email,
            'sdt' => $request->sdt,
            'vai_tro' => $request->vai_tro,
            'tai_khoan' => $request->tai_khoan,
            'mat_khau' => password_hash($request->mat_khau, PASSWORD_DEFAULT), // Mã hóa mật khẩu
        ];



        // Lưu vào database
        DB::table('nguoi_dung')->insert($data);

        // Thông báo thành công
        Session::put('message', 'Thêm người dùng thành công.');
        return Redirect::to('add-user');
    }

    public function edit_user($category_user_id){
        $this->AuthLogin();

        $edit_users=DB::table('nguoi_dung')->where('id', $category_user_id)->get();
        $manager_category_user = view('admin.edit_user')->with('edit_user', $edit_users);
        return view('admin_layout')->with('admin.edit_user', $manager_category_user);

    }
    
    public function update_user(Request $request, $id){
        $this->AuthLogin();
        
        $validatedData = $request->validate([
            'ho_ten' => 'required',
            'ngay_sinh' => 'nullable|date',  
            'vai_tro' => 'required|in:0,1',
            'ho_ten' => 'required|string|max:255',
            'email' => 'required|email|unique:nguoi_dung,email,'.$id,',id', // Email không trùng với user khác
            'sdt' => 'nullable|numeric|unique:nguoi_dung,sdt,'.$id,',id', // Số điện thoại có thể để trống nhưng phải unique nếu nhập
            'tai_khoan' => 'required|string|unique:nguoi_dung,tai_khoan,'.$id.',id',
            'mat_khau' => 'nullable|min:3',

        ], [
            'ho_ten.required' => 'Họ tên không được để trống.',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email đã tồn tại.',
            'sdt.unique' => 'Số điện thoại đã được sử dụng.',
            'vai_tro.required' => 'Vai trò không được để trống.',
            'tai_khoan.required' => 'Tài khoản không được để trống.',
            'tai_khoan.unique' => 'Tài khoản đã tồn tại.',
            'mat_khau.min' => 'Mật khẩu phải có ít nhất 3 ký tự.',
        ]);

        $ngay_sinh = $request->ngay_sinh ? date('Y-m-d', strtotime($request->ngay_sinh)) : null;


        // Lấy thông tin người dùng từ DB
        $user = DB::table('nguoi_dung')->where('id', $id)->first();

        // Kiểm tra mật khẩu mới
        if ($request->filled('mat_khau')) {
            $mat_khau = password_hash($request->mat_khau, PASSWORD_DEFAULT);
        } else {
            $mat_khau = $user->mat_khau; // Giữ nguyên mật khẩu cũ
        }

        // Cập nhật thông tin người dùng
        DB::table('nguoi_dung')->where('id', $id)->update([
            'ho_ten' => $request->ho_ten,
            'ngay_sinh' => $ngay_sinh,
            'email' => $request->email,
            'vai_tro' => $request->vai_tro,
            'sdt' => $request->sdt,
            'tai_khoan' => $request->tai_khoan,
            'mat_khau' => $mat_khau
        ]);
 
    
        Session::put('message', 'Cập nhật người dùng thành công.');
        return Redirect::to('all-user');
       

    }

    public function delete_user($id){
        $this->AuthLogin();
        
        // Cập nhật dữ liệu vào database
        DB::table('nguoi_dung')->where('id', $id)->delete();
            
        Session::put('message', 'Xóa người dùng thành công.');
        return Redirect::to('all-user');
        

    }
}
