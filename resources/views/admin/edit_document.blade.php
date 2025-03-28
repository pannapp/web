@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật tài liệu
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
                        @foreach($edit_document as $key => $edit_value)

                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-document/'.$edit_value->id)}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}} 
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên tài liệu</label>
                                    <input type="text" name="ten_tai_lieu" value="{{$edit_value->ten_tai_lieu}}" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên khóa học">
                                </div>
                      
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Của bài học</label>
                                    <select class="form-control m-bot15" name ="bai_hoc_id">

                                        @foreach($bai_hoc_list as $key => $value)
                                            <option value="{{ $value->id }}" {{ $edit_value->bai_hoc_id == $value->id ? 'selected' : '' }} >{{ $value->ten_bai_hoc }}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">File hiện tại</label>
                                        @if ($edit_value->file_url)
                                            <p><a href="{{ asset('public/' .$edit_value->file_url) }}" target="_blank">Xem file</a></p>
                                        @endif
                                    <input type="text" value="{{$edit_value->file_url}}" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên khóa học">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">File (bỏ trống nếu không đổi)</label>
                                    <input type="file" name="file_url" class="form-control">
                                </div>


                              
                                <button type="submit" name="updata_document" class="btn btn-info">Cập nhật tài liệu</button>
                            </form>
                            </div>
                        @endforeach

                        </div>
                    </section>

            </div>

@endsection