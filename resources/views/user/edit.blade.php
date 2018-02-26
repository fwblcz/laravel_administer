@extends("layouts.main")

@section("content")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                系统管理
                <small>用户管理</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> 用户管理</a></li>
                <li class="active">用户列表</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(session()->has($msg))
                    <div class="flash-message">
                        <p class="alert alert-{{ $msg }}">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ session()->get($msg) }}
                        </p>
                    </div>
                @endif
            @endforeach

            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">编辑用户</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ route('users.update', $user->uid) }}" method="POST" >
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="username">用户名</label>
                                    <input type="text" class="form-control" id="username" name="username" value="{{$user->username}}" placeholder="请输入用户名">
                                </div>
                                <div class="form-group">
                                    <label for="email">邮箱地址</label>
                                    <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}" placeholder="邮箱地址">
                                </div>
                                <div class="form-group">
                                    <label>所属机构</label>
                                    <select class="form-control">
                                        <option value="" {{ $user->institution_id ? '':'selected' }}>请选择机构</option>
                                        @foreach($institutions as $institution)
                                        <option value="{{ $institution->id }}" {{ $user->institution_id == $institution->id ? 'selected':'' }}>{{$institution->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="password">密码</label>
                                    <input type="password" class="form-control" id="password" placeholder="密码">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">上传图像</label>
                                    <input type="file" id="exampleInputFile">

                                    <p class="help-block">Example block-level help text here.</p>
                                </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">提交</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection