@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm bài học
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
                                <form role="form" action="{{URL::to('/save-lesson')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}} 
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên bài học</label>
                                    <input type="text" name="ten_bai_hoc" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên khóa học">
                                </div>
                      
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Của khóa học</label>
                                    <select class="form-control m-bot15" name ="khoa_hoc_id">
                                        @foreach($khoa_hoc_list as $key => $value)
                                            <option value="{{ $value->id }}">{{ $value->ten_khoa_hoc }}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                              
                                <button type="submit" name="add_category_course" class="btn btn-info">Thêm</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>

@endsection