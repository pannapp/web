@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê khóa học
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
            <th>Tên danh mục</th>
            <th>Mô tả</th>
            <th>Học phí</th>
            <th>Hình ảnh minh họa</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_courses as $key => $cate_pro)
          <tr>
            <td>{{$cate_pro->ten_khoa_hoc}}</td>
            <td><span class="text-ellipsis">{{$cate_pro->mo_ta}}</span></td>
            <td><span class="text-ellipsis">{{$cate_pro->hoc_phi}}</span></td>
            
            <td><span class="text-ellipsis">
              <img src="{{ asset('public/images/khoahoc/' . $cate_pro->img) }}" style="width: 100px; height: auto;">
            </span></td>
            <td>
                <a href="{{URL::to('/edit-category-course/'.$cate_pro->id)}}" class="active styling-edit" ui-toggle-class="">
                    <i class="fa fa-pencil-square-o text-success text-active"></i>
                </a>
                <a onclick="return confirm('Bạn có chắc muốn xóa khóa học này chứ?')" href="{{URL::to('/delete-category-course/'.$cate_pro->id)}}" class="active styling-edit" ui-toggle-class="">
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