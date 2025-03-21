<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NguoiDungController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nguoi_dung = Nguoi_dung::all();
        return view('nguoi_dung.index', compact('nguoi_dung'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('nguoi_dung.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ho_ten' => 'required|string|max:255',
            'email' => 'required|email|unique:nguoi_dung',
            'sdt' => 'required|digits:10',
            'tai_khoan' => 'required|unique:nguoi_dung',
            'mat_khau' => 'required|min:6',
        ]);

        Nguoi_dung::create($request->all());

        return redirect()->route('nguoi_dung.index')->with('success', 'Người dùng đã được thêm!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $nguoi_dung = Nguoi_dung::findOrFail($id);
        return view('nguoi_dung.show', compact('nguoi_dung'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $nguoi_dung = Nguoi_dung::findOrFail($id);
        return view('nguoi_dung.edit', compact('nguoi_dung'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $nguoi_dung = Nguoi_dung::findOrFail($id);
        $nguoi_dung->update($request->all());

        return redirect()->route('nguoi_dung.index')->with('success', 'Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Nguoi_dung::destroy($id);
        return redirect()->route('nguoi_dung.index')->with('success', 'Ðã xóa người dùng!');
    }
}
