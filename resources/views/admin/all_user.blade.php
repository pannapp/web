@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê người dùng
    </div>
 
    <div class="table-responsive">
    <?php
      $message = Session::get('message');
      if($message){
        echo '<span class="text-alert">'.$message.'</span>';
        Session::put('message', null);
      }
	  ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Họ tên</th>
            <th>Ngày sinh</th>
            <th>Email</th>
            <th>Vai trò</th>
            <th>Số điện thoại</th>
            <th>Thời gian tạo</th>
            <th>Tài khoản</th>
            <th>Mật khẩu</th>

            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_user as $key => $cate_pro)
          <tr>
            <td>{{$cate_pro->ho_ten}}</td>
            <td><span class="text-ellipsis">{{$cate_pro->ngay_sinh}}</span></td>
            <td><span class="text-ellipsis">{{$cate_pro->email}}</span></td>
            <td><span class="text-ellipsis">
               <?php
                    if($cate_pro->vai_tro == 0){
                        echo "Admin";
                    }else{
                        echo "Người dùng";
                    }
               
               ?>
            
            </span></td>
            <td><span class="text-ellipsis">{{$cate_pro->sdt}}</span></td>
            <td><span class="text-ellipsis">{{$cate_pro->thoi_gian_tao}}</span></td>
            <td><span class="text-ellipsis">{{$cate_pro->tai_khoan}}</span></td>
            <td><span class="text-ellipsis">{{$cate_pro->mat_khau}}</span></td>

            
            
            <td>
                <a href="{{URL::to('/edit-user/'.$cate_pro->id)}}" class="active styling-edit" ui-toggle-class="">
                    <i class="fa fa-pencil-square-o text-success text-active"></i>
                </a>
                <a onclick="return confirm('Bạn có chắc muốn xóa người dùng này chứ?')" href="{{URL::to('/delete-user/'.$cate_pro->id)}}" class="active styling-edit" ui-toggle-class="">
                    <i class="fa fa-times text-danger text"></i>
                </a> 
            </td>
          </tr>
         @endforeach
        </tbody>
      </table>
    </div>

  </div>
</div>


@endsection