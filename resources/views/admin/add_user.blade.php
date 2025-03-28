@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm người dùng
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
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/save-user')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}} 
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên người dùng</label>
                                    <input type="text" name="ho_ten" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên người dùng">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày sinh</label>
                                    <input type="date" name="ngay_sinh" class="form-control" id="exampleInputEmail1" placeholder="Nhập ngày sinh">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Nhập email">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Vai trò</label>
                                    <select class="form-control m-bot15" name ="vai_tro">
                                        <option value="1">Người dùng</option>
                                        <option value="0">Admin</option>
                                    </select>


                                </div>

                               

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số điện thoại</label>
                                    <input type="text" name="sdt" class="form-control" id="exampleInputEmail1" placeholder="Nhập số điện thoại">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tài khoản</label>
                                    <input type="text" name="tai_khoan" class="form-control" id="exampleInputEmail1" placeholder="Nhập số tài khoản">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mật khẩu</label>
                                    <input type="password" name="mat_khau" class="form-control" id="exampleInputEmail1" placeholder="Nhập số mật khẩu">
                                </div>
                             
                              
                                <button type="submit" name="add_user" class="btn btn-info">Thêm</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>

@endsection