<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
use Illuminate\Support\Facades\File;



class DocumentController extends Controller
{
    public function AuthLogin(){
        $admin_id= Session::get('id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_document(){
        $this->AuthLogin();


        $bai_hoc_list = DB::table('bai_hoc')->get();
        $manager_lessons = view('admin.add_document')->with('bai_hoc_list', $bai_hoc_list);
        return view('admin_layout')->with('admin.add_document', $manager_lessons);
    }

    public function all_document(){
        $this->AuthLogin();

        $all_documents = DB::table('tai_lieu')
        ->join('bai_hoc', 'tai_lieu.bai_hoc_id', '=', 'bai_hoc.id')
        ->join('khoa_hoc', 'bai_hoc.khoa_hoc_id', '=', 'khoa_hoc.id')
        ->select('tai_lieu.*', 'bai_hoc.ten_bai_hoc', 'khoa_hoc.ten_khoa_hoc')
        ->get();

        return view('admin.all_document', compact('all_documents'));

    }

    public function view_document($id) {
        $document = DB::table('tai_lieu')->where('id', $id)->first();
    
        if (!$document || !$document->file_url) {
            return redirect()->back()->with('message', 'Không tìm thấy file!');
        }
    
        return view('admin.view_document', compact('document'));
    }


    public function save_document(Request $request){
        $this->AuthLogin();
        
        // Validation dữ liệu
        $request->validate([
            'ten_tai_lieu' => 'required|string|max:255',
            'bai_hoc_id' => 'required|exists:bai_hoc,id',
            'file_url' => 'nullable|mimes:pdf|max:10240' // Giới hạn 10MB
        ], [
            'ten_tai_lieu.required' => 'Tên tài liệu không được để trống.',
            'bai_hoc_id.required' => 'Bài học không được để trống.',
            'file_url.mimes' => 'Chỉ hỗ trợ định dạng pdf.',
            'file_url.max' => 'File không được lớn hơn 10MB.',
        ]);

  
        // Lấy thông tin bài học và khóa học
        $bai_hoc = DB::table('bai_hoc')->where('id', $request->bai_hoc_id)->first();
        if (!$bai_hoc) {
            Session::put('message', 'Bài học không tồn tại.');
            return Redirect::to('add-document');
        }

        $khoa_hoc = DB::table('khoa_hoc')->where('id', $bai_hoc->khoa_hoc_id)->first();
        if (!$khoa_hoc) {
            Session::put('message', 'Khóa học không tồn tại.');
            return Redirect::to('add-document');
        }

        // Đường dẫn thư mục
        $folderPath = public_path('Document/' . $khoa_hoc->ten_khoa_hoc);
        
        // Kiểm tra và tạo thư mục nếu chưa có
        if (!File::exists($folderPath)) {
            File::makeDirectory($folderPath, 0777, true, true);
        }

        // Xử lý file nếu có
        $filePath = null;
        if ($request->hasFile('file_url')) {
            $file = $request->file('file_url');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move($folderPath, $fileName);
            $filePath = 'Document/' . $khoa_hoc->ten_khoa_hoc . '/' . $fileName;
        }

        // Lưu thông tin vào database
        DB::table('tai_lieu')->insert([
            'ten_tai_lieu' => $request->ten_tai_lieu,
            'bai_hoc_id' => $request->bai_hoc_id,
            'file_url' => $filePath, // Có thể là null
        ]);

        Session::put('message', 'Thêm tài liệu thành công.');
        return Redirect::to('add-document');
    }

    public function edit_document($id){
        $this->AuthLogin();
        
        $edit_document = DB::table('tai_lieu')->where('id', $id)->get();
        $bai_hoc_list = DB::table('bai_hoc')->get(); // Lấy danh sách bài học để chọn
        
        return view('admin.edit_document', compact('edit_document', 'bai_hoc_list'));

    }
    
    public function update_document(Request $request, $id){
        $this->AuthLogin();
        
        $request->validate([
            'ten_tai_lieu' => 'required|string|max:255',
            'bai_hoc_id' => 'required|exists:bai_hoc,id',
            'file_url' => 'nullable|mimes:pdf|max:10240' // Giới hạn 10MB
        ], [
            'ten_tai_lieu.required' => 'Tên tài liệu không được để trống.',
            'bai_hoc_id.required' => 'Bài học không được để trống.',
            'file_url.mimes' => 'Chỉ hỗ trợ định dạng pdf.',
            'file_url.max' => 'File không được lớn hơn 10MB.',
        ]);

        $data = [];
        $data['ten_tai_lieu'] = $request->ten_tai_lieu;
        $data['bai_hoc_id'] = $request->bai_hoc_id;
    
        if ($request->hasFile('file_url')) {
            // Xóa file cũ (nếu có)
            $document = DB::table('tai_lieu')->where('id', $id)->first();
            if ($document && isset($document->file_url)) {
                $filePath = public_path($document->file_url);
                
                if (file_exists($filePath) && is_file($filePath)) {
                    unlink($filePath);
                }
            }
            
    
            // Lưu file mới
            $file = $request->file('file_url');
            $file_name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('Document'), $file_name);
            $data['file_url'] = 'Document/' . $file_name;
        }
    
        DB::table('tai_lieu')->where('id', $id)->update($data);
    
        Session::put('message', 'Cập nhật tài liệu thành công.');
        return Redirect::to('/all-document');
       

    }

    public function delete_document($id){
        $this->AuthLogin();
    
        // Cập nhật dữ liệu vào database
        DB::table('tai_lieu')->where('id', $id)->delete();
            
        Session::put('message', 'Xóa tài liệu thành công.');
        return Redirect::to('all-category-course');
        
    }

}
