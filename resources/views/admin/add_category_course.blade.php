@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm tài liệu
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
                                <form role="form" action="{{URL::to('/save-category-course')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}} 
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên khóa học</label>
                                    <input type="text" name="ten_khoa_hoc" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên khóa học">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả danh mục</label>
                                    <textarea style="resize:none" rows="5" type="text" name="mo_ta" class="form-control" id="exampleInputPassword1" placeholder="Mô tả khóa học"> 

                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Học phí</label>
                                    <input type="text" name="hoc_phi" class="form-control" id="exampleInputEmail1" placeholder="Nhập học phí">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Thêm ảnh</label>
                                    <input type="file" name="img" id="exampleInputFile">
                                </div>
                              
                                <button type="submit" name="add_category_course" class="btn btn-info">Thêm</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>

@endsection