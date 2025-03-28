@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê bài kiểm tra
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
            <th>Tên bài kiểm tra</th>
            <th>Thời gian làm bài</th>
            <th>Của bài học</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_tests as $key => $cate_pro)
          <tr>
            
            <td><span class="text-ellipsis">{{$cate_pro->ten_bkt}}</span></td>
            <td><span class="text-ellipsis">{{$cate_pro->thoi_gian_lam_bai}}</span></td>
            <td><span class="text-ellipsis">{{$cate_pro->ten_bai_hoc}}</span></td>


            
            <td>
                <a href="{{URL::to('/edit-test/'.$cate_pro->id)}}" class="active styling-edit" ui-toggle-class="">
                    <i class="fa fa-pencil-square-o text-success text-active"></i>
                </a>
                <a onclick="return confirm('Bạn có chắc muốn xóa bài học này chứ?')" href="{{URL::to('/delete-test/'.$cate_pro->id)}}" class="active styling-edit" ui-toggle-class="">
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