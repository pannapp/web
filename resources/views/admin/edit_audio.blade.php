@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật audio
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
                            @foreach($edit_audio as $key => $edit_value)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-audio/'.$edit_value->id)}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}} 
                              
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Của bài kiểm tra</label>
                                    <select class="form-control m-bot15" name ="bkt_id">
                                        @foreach($bkt_list as $key => $value)
                                            <option value="{{ $value->id }}" {{ $edit_value->bkt_id == $value->id ? 'selected' : '' }} >{{ $value->ten_bkt }}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>

                                <div class="form-group">
                                <label for="exampleInputEmail1">Ảnh trước đó</label>
                                <img src="{{ asset('public/' .$edit_value->file_anh_url) }}" style="width: 100px; height: auto;">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">Sửa ảnh (bỏ trống nếu không thay đổi)</label>
                                    <input type="file" name="file_anh_url" id="exampleInputFile">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">Sửa file audio (bỏ trống nếu không thay đổi)</label>
                                    <input type="file" name="file_audio_url" id="exampleInputFile">
                                </div>
                              
                                <button type="submit" name="add_category_course" class="btn btn-info">Cập nhật audio</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>

            </div>

@endsection