<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
use Illuminate\Support\Facades\File;




class DoanVanController extends Controller
{
    public function AuthLogin(){
        $admin_id= Session::get('id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_doanvan(){
        $this->AuthLogin();

        $bkt_list = DB::table('bai_kiem_tra')->get();
        $manager_doanvan = view('admin.add_doanvan')->with('bkt_list', $bkt_list);
        return view('admin_layout')->with('admin.add_doanvan', $manager_doanvan);
    }

    public function all_doanvan(){
        $this->AuthLogin();


        $all_doanvan = DB::table('doan_van')
        ->join('bai_kiem_tra', 'doan_van.bkt_id', '=', 'bai_kiem_tra.id')
        ->select('doan_van.*', 'bai_kiem_tra.ten_bkt')

        ->get();

        return view('admin.all_doanvan', compact('all_doanvan'));
    }



    public function save_doanvan(Request $request){
        $this->AuthLogin();
        
        // Kiểm tra dữ liệu đầu vào
        $request->validate([
            'bkt_id' => 'required|exists:bai_kiem_tra,id',
            'noi_dung' => 'required|string',
            'giai_thich' => 'nullable|string',
        ], [
            'bkt_id.required' => 'Bài kiểm tra không được để trống.',
            'bkt_id.exists' => 'Bài kiểm tra không tồn tại.',
            'noi_dung.required' => 'Nội dung không được để trống.',
            'noi_dung.string' => 'Nội dung phải là chuỗi.',
            'giai_thich.string' => 'Giải thích phải là chuỗi.',
        ]);
    
        // Lưu dữ liệu vào bảng
        DB::table('doan_van')->insert([
            'bkt_id' => $request->bkt_id,
            'noi_dung' => $request->noi_dung,
            'giai_thich' => $request->giai_thich, // Có thể null
        ]);
    
        return Redirect::back()->with('message', 'Lưu đoạn văn thành công.');
    }

    public function edit_category_course($category_course_id){
        $this->AuthLogin();

        $edit_courses=DB::table('khoa_hoc')->where('id', $category_course_id)->get();
        $manager_category_courses = view('admin.edit_category_course')->with('edit_courses', $edit_courses);
        return view('admin_layout')->with('admin.edit_category_course', $manager_category_courses);


    }
    
    public function update_category_course(Request $request, $category_course_id){
        $this->AuthLogin();
        
        $validatedData = $request->validate([
            'ten_khoa_hoc' => 'required',
            'hoc_phi' => 'required|numeric',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240'
        ], [
            'ten_khoa_hoc.required' => 'Tên khóa học không được để trống.',
            'hoc_phi.required' => 'Học phí không được để trống.',
            'hoc_phi.numeric' => 'Học phí phải là số.',
            'img.image' => 'File phải là ảnh.',
            'img.mimes' => 'Chỉ hỗ trợ định dạng JPEG, PNG, JPG, GIF.',
            'img.max' => 'Ảnh không được lớn hơn 10MB.',
        ]);

        $data = array();
        $data['ten_khoa_hoc'] = $request->ten_khoa_hoc;
        $data['mo_ta'] = $request->mo_ta;
        $data['hoc_phi'] = $request->hoc_phi;
    
        // Kiểm tra nếu có upload ảnh mới
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $new_image_name = time() . "_" . $image->getClientOriginalName(); // Đặt tên file mới
            $image->move(public_path('images/khoahoc'), $new_image_name); // Lưu file vào thư mục
    
            // Cập nhật đường dẫn ảnh vào database
            $data['img'] = $new_image_name;
    
            // Xóa ảnh cũ nếu có
            $old_image = DB::table('khoa_hoc')->where('id', $category_course_id)->value('img');
            if ($old_image && file_exists(public_path('images/khoahoc/' . $old_image))) {
                unlink(public_path('images/khoahoc/' . $old_image));
            }
        }
    
        // Cập nhật dữ liệu vào database
        DB::table('khoa_hoc')->where('id', $category_course_id)->update($data);
    
        Session::put('message', 'Cập nhật khóa học thành công.');
        return Redirect::to('all-category-course');
       

    }

    public function delete_doanvan($id){
        $this->AuthLogin();
        
    // Kiểm tra xem đoạn văn có tồn tại không
    $doanvan = DB::table('doan_van')->where('id', $id)->first();
    if (!$doanvan) {
        return Redirect::to('all-doanvan')->with('error', 'Đoạn văn không tồn tại.');
    }

    // Xóa đoạn văn
    DB::table('doan_van')->where('id', $id)->delete();

    // Lưu thông báo vào session
    return Redirect::to('all-doanvan')->with('message', 'Xóa đoạn văn thành công.');
    }
}
