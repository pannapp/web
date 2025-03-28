<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
use Illuminate\Support\Facades\File;


class AudioController extends Controller
{
    public function AuthLogin(){
        $admin_id= Session::get('id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_audio(){
        $this->AuthLogin();

        $bkt_list = DB::table('bai_kiem_tra')->get();
        $manager_audios = view('admin.add_audio')->with('bkt_list', $bkt_list);
        return view('admin_layout')->with('admin.add_audio', $manager_audios);
    }

    public function all_audio(){
        $this->AuthLogin();

        $all_audio = DB::table('audio')
        ->join('bai_kiem_tra', 'audio.bkt_id', '=', 'bai_kiem_tra.id')
        ->join('bai_hoc', 'bai_kiem_tra.bai_hoc_id', '=', 'bai_hoc.id')
        ->join('khoa_hoc', 'bai_hoc.khoa_hoc_id', '=', 'khoa_hoc.id')
        ->select('audio.*', 'bai_kiem_tra.ten_bkt', 'bai_hoc.ten_bai_hoc', 'khoa_hoc.ten_khoa_hoc')
        ->get();

    return view('admin.all_audio', compact('all_audio'));

    }



    public function save_audio(Request $request){
        $this->AuthLogin();
        
        // Validation dữ liệu
        $request->validate([
            'bkt_id' => 'required|exists:bai_kiem_tra,id',
            'file_audio_url' => 'nullable|max:10240', // Chỉ hỗ trợ MP3 & WAV, giới hạn 10MB
            'file_anh_url' => 'nullable|mimes:jpg,jpeg,png|max:10240', // Chỉ hỗ trợ JPG, PNG, giới hạn 10MB
        ], [
            'bkt_id.required' => 'Bài kiểm tra không được để trống.',
            'file_audio_url.max' => 'File audio không được lớn hơn 10MB.',
            'file_anh_url.mimes' => 'Chỉ hỗ trợ định dạng JPG, PNG.',
            'file_anh_url.max' => 'File ảnh không được lớn hơn 10MB.',
        ]);

        // Lấy thông tin bài kiểm tra
        $bai_kiem_tra = DB::table('bai_kiem_tra')->where('id', $request->bkt_id)->first();
        if (!$bai_kiem_tra) {
            return Redirect::back()->with('message', 'Bài kiểm tra không tồn tại.');
        }

        // Lấy thông tin bài học của bài kiểm tra
        $bai_hoc = DB::table('bai_hoc')->where('id', $bai_kiem_tra->bai_hoc_id)->first();
        if (!$bai_hoc) {
            return Redirect::back()->with('message', 'Bài học không tồn tại.');
        }

        // Lấy thông tin khóa học của bài học
        $khoa_hoc = DB::table('khoa_hoc')->where('id', $bai_hoc->khoa_hoc_id)->first();
        if (!$khoa_hoc) {
            return Redirect::back()->with('message', 'Khóa học không tồn tại.');
        }

        // Tạo thư mục lưu trữ
        $folderPath = public_path('Document/' . $khoa_hoc->ten_khoa_hoc);
        if (!File::exists($folderPath)) {
            File::makeDirectory($folderPath, 0777, true, true);
        }

        // Xử lý file audio
        $audioPath = null;
        if ($request->hasFile('file_audio_url')) {
            $audio = $request->file('file_audio_url');
            $audioName = time() . '_' . $audio->getClientOriginalName();
            $audio->move($folderPath, $audioName);
            $audioPath = 'Document/' . $khoa_hoc->ten_khoa_hoc . '/' . $audioName;
        }

        // Xử lý file ảnh
        $imagePath = null;
        if ($request->hasFile('file_anh_url')) {
            $image = $request->file('file_anh_url');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move($folderPath, $imageName);
            $imagePath = 'Document/' . $khoa_hoc->ten_khoa_hoc . '/' . $imageName;
        }

        // Lưu thông tin vào database
        DB::table('audio')->insert([
            'bkt_id' => $request->bkt_id,
            'file_audio_url' => $audioPath,
            'file_anh_url' => $imagePath,
        ]);

        return Redirect::back()->with('message', 'Thêm file thành công.');
    }

    public function edit_audio($id){
        $this->AuthLogin();
        
        $edit_audio = DB::table('audio')->where('id', $id)->get();
        $bkt_list = DB::table('bai_kiem_tra')->get(); // Lấy danh sách bài học để chọn
        
        return view('admin.edit_audio', compact('edit_audio', 'bkt_list'));

    }
    
    public function update_audio(Request $request, $id){
        $this->AuthLogin();
        
        $request->validate([
            'bkt_id' => 'required|exists:bai_kiem_tra,id',
            'file_audio_url' => 'nullable|max:10240', // Chỉ hỗ trợ MP3 & WAV, giới hạn 10MB
            'file_anh_url' => 'nullable|mimes:jpg,jpeg,png|max:10240', // Chỉ hỗ trợ JPG, PNG, giới hạn 10MB
        ], [
            'bkt_id.required' => 'Bài kiểm tra không được để trống.',
            'file_audio_url.max' => 'File audio không được lớn hơn 10MB.',
            'file_anh_url.mimes' => 'Chỉ hỗ trợ định dạng JPG, PNG.',
            'file_anh_url.max' => 'File ảnh không được lớn hơn 10MB.',
        ]);

        // Lấy thông tin file audio hiện tại
        // Lấy thông tin file audio hiện tại (nếu có)
        $audio = DB::table('audio')->where('id', $id)->first();
        if (!$audio) {
            return Redirect::back()->with('message', 'Không tìm thấy file audio.');
        }

        // Lấy thông tin bài kiểm tra, bài học, khóa học
        $bai_kiem_tra = DB::table('bai_kiem_tra')->where('id', $request->bkt_id)->first();
        $bai_hoc = DB::table('bai_hoc')->where('id', $bai_kiem_tra->bai_hoc_id)->first();
        $khoa_hoc = DB::table('khoa_hoc')->where('id', $bai_hoc->khoa_hoc_id)->first();

        // Tạo thư mục nếu chưa có
        $folderPath = public_path('Document/' . $khoa_hoc->ten_khoa_hoc);
        if (!File::exists($folderPath)) {
            File::makeDirectory($folderPath, 0777, true, true);
        }

        // Xử lý file audio (nếu có upload mới)
        $audioPath = $audio->file_audio_url; // Giữ nguyên nếu không upload mới
        if ($request->hasFile('file_audio_url')) {
            $audioFile = $request->file('file_audio_url');
            $audioName = time() . '_' . $audioFile->getClientOriginalName();
            $audioFile->move($folderPath, $audioName);
            $audioPath = 'Document/' . $khoa_hoc->ten_khoa_hoc . '/' . $audioName;

            // Xóa file cũ nếu có
            if ($audio->file_audio_url && File::exists(public_path($audio->file_audio_url))) {
                File::delete(public_path($audio->file_audio_url));
            }
        }

        // Xử lý file ảnh (nếu có upload mới)
        $imagePath = $audio->file_anh_url; // Giữ nguyên nếu không upload mới
        if ($request->hasFile('file_anh_url')) {
            $imageFile = $request->file('file_anh_url');
            $imageName = time() . '_' . $imageFile->getClientOriginalName();
            $imageFile->move($folderPath, $imageName);
            $imagePath = 'Document/' . $khoa_hoc->ten_khoa_hoc . '/' . $imageName;

            // Xóa file ảnh cũ nếu có
            if ($audio->file_anh_url && File::exists(public_path($audio->file_anh_url))) {
                File::delete(public_path($audio->file_anh_url));
            }
        }

        // Nếu file ảnh hoặc file audio rỗng, cập nhật thành NULL
        $dataUpdate = [
            'bkt_id' => $request->bkt_id,
            'file_audio_url' => $audioPath ?: null, // Nếu rỗng thì NULL
            'file_anh_url' => $imagePath ?: null, // Nếu rỗng thì NULL
        ];

        // Cập nhật dữ liệu trong database
        DB::table('audio')->where('id', $id)->update($dataUpdate);

        Session::put('message', 'Cập nhật bài học thành công.');
        return Redirect::to('all-audio');

       

    }

    public function delete_document($id){
        $this->AuthLogin();
    
        // Cập nhật dữ liệu vào database
        DB::table('tai_lieu')->where('id', $id)->delete();
            
        Session::put('message', 'Xóa tài liệu thành công.');
        return Redirect::to('all-category-course');
        
    }
}
