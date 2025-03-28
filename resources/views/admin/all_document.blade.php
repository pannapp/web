@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê tài liệu
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
            <th>Tên tài liệu</th>
            <th>Của bài học</th>
            <th>Bài học thuộc khóa học</th>
            <th>File</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_documents as $key => $cate_pro)
          <tr>
            
            <td><span class="text-ellipsis">{{$cate_pro->ten_tai_lieu}}</span></td>
            <td><span class="text-ellipsis">{{$cate_pro->ten_bai_hoc}}</span></td>
            <td><span class="text-ellipsis">{{$cate_pro->ten_khoa_hoc}}</span></td>

            <td>
                <a href="{{ URL::to('/view-document/'.$cate_pro->id) }}" class="btn btn-primary">Xem</a>
            </td>
            
            <td>
                <a href="{{URL::to('/edit-document/'.$cate_pro->id)}}" class="active styling-edit" ui-toggle-class="">
                    <i class="fa fa-pencil-square-o text-success text-active"></i>
                </a>
                <a onclick="return confirm('Bạn có chắc muốn xóa tài liệu này chứ?')" href="{{URL::to('/delete-document/'.$cate_pro->id)}}" class="active styling-edit" ui-toggle-class="">
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