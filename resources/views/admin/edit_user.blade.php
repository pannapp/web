@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật người dùng
                        </header>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message', null);
                            }
                        ?>
                        <div class="panel-body">
                        @foreach($edit_user as $key => $edit_value)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-user/'.$edit_value->id)}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}} 
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên người dùng</label>
                                    <input type="text" name="ho_ten" value="{{$edit_value->ho_ten}}" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên người dùng">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày sinh</label>
                                    <input type="date" name="ngay_sinh" value="{{$edit_value->ngay_sinh}}" class="form-control" id="exampleInputEmail1" placeholder="Nhập ngày sinh">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" name="email" value="{{$edit_value->email}}" class="form-control" id="exampleInputEmail1" placeholder="Nhập email">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Vai trò</label>
                                    <select class="form-control m-bot15" name ="vai_tro">
                                        <option value="1" {{ $edit_value->vai_tro == 1 ? 'selected' : '' }} >Người dùng</option>
                                        <option value="0" {{ $edit_value->vai_tro == 0 ? 'selected' : '' }} >Admin</option>
                                    </select>


                                </div>

                               

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số điện thoại</label>
                                    <input type="text" name="sdt" value="{{$edit_value->sdt}}" class="form-control" id="exampleInputEmail1" placeholder="Nhập số điện thoại">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tài khoản</label>
                                    <input type="text" name="tai_khoan" value="{{$edit_value->tai_khoan}}" class="form-control" id="exampleInputEmail1" placeholder="Nhập số tài khoản">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mật khẩu (bỏ trống nếu không đổi)</label>
                                    <input type="password" name="mat_khau" class="form-control" id="exampleInputEmail1" placeholder="Nhập số mật khẩu">
                                </div>
                             
                              
                                <button type="submit" name="update_user" class="btn btn-info">Cập nhật người dùng</button>
                            </form>
                            </div>

                        @endforeach

                        </div>
                    </section>

            </div>

@endsection