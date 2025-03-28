@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật bài kiểm tra
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
                        @foreach($edit_tests as $key => $edit_value)

                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-test/'.$edit_value->id)}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}} 
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên bài kiểm tra</label>
                                    <input type="text" name="ten_bkt" value="{{$edit_value->ten_bkt}}" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên khóa học">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Thời gian làm bài</label>
                                    <input type="text" name="thoi_gian_lam_bai" value="{{$edit_value->thoi_gian_lam_bai}}" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên khóa học">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Của bài học</label>
                                    <select class="form-control m-bot15" name ="bai_hoc_id">

                                        @foreach($all_lessons as $key => $value)
                                            <option value="{{ $value->id }}" {{ $edit_value->bai_hoc_id == $value->id ? 'selected' : '' }} >{{ $value->ten_bai_hoc }}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                              
                                <button type="submit" name="update_test" class="btn btn-info">Cập nhật bài kiểm tra</button>
                            </form>
                            </div>
                        @endforeach

                        </div>
                    </section>

            </div>

@endsection