<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
use Illuminate\Support\Facades\File;

class CategoryCourse extends Controller
{
    public function AuthLogin(){
        $admin_id= Session::get('id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_category_course(){
        $this->AuthLogin();

        return view('admin.add_category_course');
    }

    public function all_category_course(){
        $this->AuthLogin();


        $all_courses=DB::table('khoa_hoc')->get();
        $manager_category_courses = view('admin.all_category_course')->with('all_courses', $all_courses);
        return view('admin_layout')->with('admin.all_category_course', $manager_category_courses);

    }



    public function save_category_course(Request $request){
        $this->AuthLogin();
        
        // Kiểm tra dữ liệu đầu vào
        $validatedData = $request->validate([
            'ten_khoa_hoc' => 'required',
            'hoc_phi' => 'required|numeric',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240'
        ], [
            'ten_khoa_hoc.required' => 'Tên khóa học không được để trống.',
            'hoc_phi.required' => 'Học phí không được để trống.',
            'hoc_phi.numeric' => 'Học phí phải là số.',
            'img.required' => 'Vui lòng chọn ảnh.',
            'img.image' => 'File phải là ảnh.',
            'img.mimes' => 'Chỉ hỗ trợ định dạng JPEG, PNG, JPG, GIF.',
            'img.max' => 'Ảnh không được lớn hơn 10MB.',
        ]);

        // Nếu validate thành công, tiếp tục lưu dữ liệu
        $data = [
            'ten_khoa_hoc' => $request->ten_khoa_hoc,
            'mo_ta' => $request->mo_ta,
            'hoc_phi' => $request->hoc_phi,
            'img' => '',
        ];

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $image_name = time() . '_'. $image->getClientOriginalName();
            $image->move(public_path('images/khoahoc'), $image_name);
            $data['img'] =$image_name;
        }

        DB::table('khoa_hoc')->insert($data);
        Session::put('message', 'Thêm khóa học thành công.');
        $document_dir = "public/Document/" . $request->ten_khoa_hoc;
        if (!file_exists($document_dir)) {
            mkdir($document_dir, 0777, true);
        }
        return Redirect::to('add-category-course');
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

    public function delete_category_course($category_course_id){
        $this->AuthLogin();
        

        // Lấy tên khóa học trước khi xóa
        $khoa_hoc = DB::table('khoa_hoc')->where('id', $category_course_id)->first();
    
        if ($khoa_hoc) {
            $folderPath = public_path('Document/' . $khoa_hoc->ten_khoa_hoc);
    
            // Xóa khóa học trong database
            DB::table('khoa_hoc')->where('id', $category_course_id)->delete();
    
            // Kiểm tra nếu thư mục tồn tại thì xóa
            if (File::exists($folderPath)) {
                File::deleteDirectory($folderPath);
            }
            
            Session::put('message', 'Xóa khóa học thành công.');
        } else {
            Session::put('message', 'Khóa học không tồn tại.');
        }
    
        return Redirect::to('all-category-course');
    }

}
