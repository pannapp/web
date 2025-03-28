@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật bài học
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
                        @foreach($edit_lessons as $key => $edit_value)

                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-lesson/'.$edit_value->id)}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}} 
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên bài học</label>
                                    <input type="text" name="ten_bai_hoc" value="{{$edit_value->ten_bai_hoc}}" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên khóa học">
                                </div>
                      
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Của khóa học</label>
                                    <select class="form-control m-bot15" name ="khoa_hoc_id">

                                        @foreach($all_courses as $key => $value)
                                            <option value="{{ $value->id }}" {{ $edit_value->khoa_hoc_id == $value->id ? 'selected' : '' }} >{{ $value->ten_khoa_hoc }}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                              
                                <button type="submit" name="add_category_course" class="btn btn-info">Cập nhật bài học</button>
                            </form>
                            </div>
                        @endforeach

                        </div>
                    </section>

            </div>

@endsection