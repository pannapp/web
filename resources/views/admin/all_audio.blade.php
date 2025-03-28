@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê audio
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
            <th>Bài kiểm tra</th>
            <th>File audio</th>
            <th>File ảnh</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_audio as $key => $cate_pro)
          <tr>
            <td>{{$cate_pro->ten_bkt}}</td>
            
            <td><span class="text-ellipsis">
              <img src="{{ asset('public/' .$cate_pro->file_anh_url) }}" style="width: 100px; height: auto;">
            </span></td>
            <td>{{$cate_pro->file_audio_url}}</td>


            <td>
                <a href="{{URL::to('/edit-audio/'.$cate_pro->id)}}" class="active styling-edit" ui-toggle-class="">
                    <i class="fa fa-pencil-square-o text-success text-active"></i>
                </a>
                <a onclick="return confirm('Bạn có chắc muốn xóa khóa học này chứ?')" href="{{URL::to('/delete-audio/'.$cate_pro->id)}}" class="active styling-edit" ui-toggle-class="">
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