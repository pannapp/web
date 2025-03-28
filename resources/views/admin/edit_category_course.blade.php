@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật khóa học
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
                            @foreach($edit_courses as $key => $edit_value)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-category-course/'.$edit_value->id)}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}} 
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên khóa học</label>
                                    <input type="text" name="ten_khoa_hoc" value="{{$edit_value->ten_khoa_hoc}}" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả danh mục</label>
                                    <textarea style="resize:none" rows="5" type="text" name="mo_ta" class="form-control" id="exampleInputPassword1"> 
                                        {{$edit_value->mo_ta}}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Học phí</label>
                                    <input type="text" name="hoc_phi" class="form-control" id="exampleInputEmail1" value="{{$edit_value->hoc_phi}}">
                                </div>

                                <div class="form-group">
                                <label for="exampleInputEmail1">Ảnh trước đó</label>
                                <img src="{{ asset('public/images/khoahoc/' . $edit_value->img) }}" style="width: 100px; height: auto;">
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputFile">Sửa ảnh</label>
                                    <input type="file" name="img" id="exampleInputFile">
                                </div>
                              
                                <button type="submit" name="add_category_course" class="btn btn-info">Cập nhật khóa học</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>

            </div>

@endsection