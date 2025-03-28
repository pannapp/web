@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm audio
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
                                <form role="form" action="{{URL::to('/save-audio')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}} 
                              
                            
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Của bài kiểm tra</label>
                                    <select class="form-control m-bot15" name ="bkt_id">
                                        @foreach($bkt_list as $key => $value)
                                            <option value="{{ $value->id }}">{{ $value->ten_bkt }}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">Thêm ảnh</label>
                                    <input type="file" name="file_anh_url" id="exampleInputFile">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">Thêm file</label>
                                    <input type="file" name="file_audio_url" id="exampleInputFile">
                                </div>


                              
                                <button type="submit" name="add_audio" class="btn btn-info">Thêm</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>

@endsection