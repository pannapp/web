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
                                <form role="form" action="{{URL::to('/save-document')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}} 
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên tài liệu</label>
                                    <input type="text" name="ten_tai_lieu" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên khóa học">
                                </div>
                            
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Của bài học</label>
                                    <select class="form-control m-bot15" name ="bai_hoc_id">
                                        @foreach($bai_hoc_list as $key => $value)
                                            <option value="{{ $value->id }}">{{ $value->ten_bai_hoc }}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">Thêm file</label>
                                    <input type="file" name="file_url" id="exampleInputFile">
                                </div>


                              
                                <button type="submit" name="add_category_course" class="btn btn-info">Thêm</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>

@endsection