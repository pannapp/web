<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class TestController extends Controller
{
    public function AuthLogin(){
        $admin_id= Session::get('id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_test(){
        $this->AuthLogin();

        $bai_hoc_list = DB::table('bai_hoc')->get();
        $manager_lessons = view('admin.add_test')->with('bai_hoc_list', $bai_hoc_list);
        return view('admin_layout')->with('admin.add_test', $manager_lessons);

    }

    public function all_test(){
        $this->AuthLogin();

        $all_tests = DB::table('bai_kiem_tra')
        ->join('bai_hoc', 'bai_kiem_tra.bai_hoc_id', '=', 'bai_hoc.id')
        ->select('bai_kiem_tra.*', 'bai_hoc.ten_bai_hoc')
        ->get();

        return view('admin.all_test', compact('all_tests'));

    }



    public function save_test(Request $request){
        $this->AuthLogin();

        // Kiểm tra dữ liệu đầu vào
        $request->validate([
            'ten_bkt' => 'required|string|max:255',
            'thoi_gian_lam_bai' => 'required|integer|min:15',
            'bai_hoc_id' => 'required|integer|exists:bai_hoc,id',
        ], [
            'ten_bkt.required' => 'Tên bài kiểm tra không được để trống.',
            'ten_bkt.max' => 'Tên bài kiểm tra không được quá 255 ký tự.',
            'thoi_gian_lam_bai.required' => 'Thời gian làm bài không được để trống.',
            'thoi_gian_lam_bai.integer' => 'Thời gian làm bài là số nguyên tính theo phút.',
            'thoi_gian_lam_bai.min' => 'Thời gian làm bài ít nhất là 15 phút.',
            'bai_hoc_id.required' => 'Bài học không được để trống.',
        ]);

      

        $baiKiemTra = DB::table('bai_kiem_tra')->insert([
            'ten_bkt' => $request->ten_bkt,
            'thoi_gian_lam_bai' => $request->thoi_gian_lam_bai,
            'bai_hoc_id' => $request->bai_hoc_id,
        ]);



        // Thông báo thành công
        Session::put('message', 'Thêm bài kiểm tra thành công.');
        return Redirect::to('add-test');
    }

    public function edit_test($id){
        $this->AuthLogin();

        $all_lessons = DB::table('bai_hoc')->get();
        $edit_tests = DB::table('bai_kiem_tra')->where('id',$id)->get();
     
        return view('admin.edit_test', compact('edit_tests','all_lessons'));

    }
    
    public function update_test(Request $request, $id){
        $this->AuthLogin();
        
        $request->validate([
            'ten_bkt' => 'required|string|max:255',
            'thoi_gian_lam_bai' => 'required|integer|min:15',
            'bai_hoc_id' => 'required|integer|exists:bai_hoc,id',
        ], [
            'ten_bkt.required' => 'Tên bài kiểm tra không được để trống.',
            'ten_bkt.max' => 'Tên bài kiểm tra không được quá 255 ký tự.',
            'thoi_gian_lam_bai.required' => 'Thời gian làm bài không được để trống.',
            'thoi_gian_lam_bai.integer' => 'Thời gian làm bài là số nguyên tính theo phút.',
            'thoi_gian_lam_bai.min' => 'Thời gian làm bài ít nhất là 15 phút.',
            'bai_hoc_id.required' => 'Bài học không được để trống.',
        ]);



        // Cập nhật thông tin 
        DB::table('bai_kiem_tra')->where('id', $id)->update([
            'ten_bkt' => $request->ten_bkt,
            'thoi_gian_lam_bai' => $request->thoi_gian_lam_bai,
            'bai_hoc_id' => $request->bai_hoc_id,
        ]);
 
    
        Session::put('message', 'Cập nhật bài kiểm tra thành công.');
        return Redirect::to('all-test');
       

    }

    public function delete_test($id){
        $this->AuthLogin();
        
        // Cập nhật dữ liệu vào database
        DB::table('bai_kiem_tra')->where('id', $id)->delete();
            
        Session::put('message', 'Xóa bài kiểm tra thành công.');
        return Redirect::to('all-test');
        

    }
}
