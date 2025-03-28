<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();


class CauHoiDController extends Controller
{
    public function AuthLogin(){
    
        $admin_id= Session::get('id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_cauhoi(){
        $this->AuthLogin();

        $bkt_list = DB::table('bai_kiem_tra')->get();
        $manager_audios = view('admin.add_cauhoi')->with('bkt_list', $bkt_list);
        return view('admin_layout')->with('admin.add_cauhoi', $manager_audios);
    }

    public function all_lesson(){
        $this->AuthLogin();

        // Lấy danh sách bài học và tên khóa học
        $all_lessons = DB::table('bai_hoc')
        ->join('khoa_hoc', 'bai_hoc.khoa_hoc_id', '=', 'khoa_hoc.id')
        ->select('bai_hoc.id', 'bai_hoc.ten_bai_hoc', 'khoa_hoc.ten_khoa_hoc')
        ->get();

        return view('admin.all_lesson', compact('all_lessons'));
    }



    public function save_lesson(Request $request){
        $this->AuthLogin();

    // Kiểm tra dữ liệu đầu vào
        $validatedData = $request->validate([
            'ten_bai_hoc' => 'required',
            'khoa_hoc_id' => 'required',
        ], [
            'ten_bai_hoc.required' => 'Tên bài học không được để trống.',
            'khoa_hoc_id.required' => 'Khóa học không được để trống.',
        ]);

        // Nếu validate thành công, tiếp tục lưu dữ liệu
        $data = [
            'ten_bai_hoc' => $request->ten_bai_hoc,
            'khoa_hoc_id' => $request->khoa_hoc_id,
        ];


        DB::table('bai_hoc')->insert($data);
        Session::put('message', 'Thêm bài học thành công.');

        return Redirect::to('add-lesson');
    }

    public function edit_lesson($id){
        $this->AuthLogin();


        $all_courses = DB::table('khoa_hoc')->get();
        $edit_lessons = DB::table('bai_hoc')->where('id',$id)->get();
     
        return view('admin.edit_lesson', compact('edit_lessons','all_courses'));


    }
    
    public function update_lesson(Request $request, $id){
        
        $validatedData = $request->validate([
            'ten_bai_hoc' => 'required',
            'khoa_hoc_id' => 'required',
        ], [
            'ten_bai_hoc.required' => 'Tên bài học không được để trống.',
            'khoa_hoc_id.required' => 'Khóa học không được để trống.',
        ]);

        $data = array();
        $data['ten_bai_hoc'] = $request->ten_bai_hoc;
        $data['khoa_hoc_id'] = $request->khoa_hoc_id;

    
    
        // Cập nhật dữ liệu vào database
        DB::table('bai_hoc')->where('id', $id)->update($data);
    
        Session::put('message', 'Cập nhật bài học thành công.');
        return Redirect::to('all-lesson');
       

    }

    public function delete_lesson($id){
        // Cập nhật dữ liệu vào database
        DB::table('bai_hoc')->where('id', $id)->delete();
            
        Session::put('message', 'Xóa bài học thành công.');
        return Redirect::to('all-lesson');
        

    }



}
