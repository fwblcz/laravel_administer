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
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">

                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                               添加用户
                            </button>
                            {{--<h3 class="box-title"><a>添加用户</a></h3>--}}
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div id="example1_filter" class="dataTables_filter">
                                            <label>
                                                用户名:<input type="search" class="form-control input-sm" placeholder="" aria-controls="example1">
                                            </label>
                                            <label>
                                                邮箱:<input type="search" class="form-control input-sm" placeholder="" aria-controls="example1">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                            <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 50px;">ID</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 150px;">用户名</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 150px;">邮箱</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 156px;">机构</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 119px;">操作</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(count($users))
                                                @foreach($users as $user)
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1">{{$user->uid}}</td>
                                                    <td>{{$user->username}}</td>
                                                    <td>{{$user->email}}</td>
                                                    <td>@if(isset($user->institution)){{$user->institution->title}}@else未知@endif</td>
                                                    <td>
                                                        <a href="{{ route('users.edit',$user->uid) }}" class="btn btn-default btn-xs pull-left" role="button">
                                                            <i class="glyphicon glyphicon-edit"></i> 编辑
                                                        </a>

                                                        <form action="{{ route('users.destroy', $user->uid) }}" method="post">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                            <button type="submit" class="btn btn-default btn-xs pull-left" style="margin-left: 6px">
                                                                <i class="glyphicon glyphicon-trash"></i>
                                                                删除
                                                            </button>
                                                        </form>

                                                        <a href="" class="btn btn-default btn-xs pull-right" role="button">
                                                            角色管理
                                                        </a>

                                                    </td>
                                                </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                            <tfoot></tfoot>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="dataTables_length" id="example1_length">
                                            <label>每页显示
                                                <select name="example1_length" aria-controls="example1" class="form-control input-sm">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select> 条
                                            </label>
                                        </div>
                                        {{--<div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>--}}
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                            {{$users->links()}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!--添加模态框-->
    <div class="modal fade" id="modal-default" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">添加用户</h4>
                </div>
                @include('common.error')
                <form role="form" method="POST" action="{{ route('users.store') }}">
                    {{ csrf_field() }}
                    <div class="modal-body">
                    <!-- form start -->
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">用户名</label>
                                <input type="text" class="form-control" name="username" id="username"  placeholder="请输入用户名">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">邮箱</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="请输入邮箱地址">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">密码</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="请输入密码">
                            </div>
                            <div class="form-group">
                                <label>所属机构</label>
                                <select class="form-control">
                                    <option>option 1</option>
                                    <option>option 2</option>
                                    <option>option 3</option>
                                    <option>option 4</option>
                                    <option>option 5</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">上传图像</label>
                                <input type="file" id="file" name="avatar">
                                <p class="help-block">Example block-level help text here.</p>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default pull-left" data-dismiss="modal">关闭</button>
                        <button type="submit" class="btn btn-primary">保存</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!--编辑模态框-->
    <div class="modal fade" id="modal-edit" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">编辑用户</h4>
                </div>
                <form role="form">
                    <div class="modal-body">
                        <!-- form start -->
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">用户名</label>
                                <input type="text" class="form-control" name="username" id="username"  placeholder="请输入用户名">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">邮箱</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="请输入邮箱地址">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">密码</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="请输入密码">
                            </div>
                            <div class="form-group">
                                <label>所属机构</label>
                                <select class="form-control">
                                    <option>option 1</option>
                                    <option>option 2</option>
                                    <option>option 3</option>
                                    <option>option 4</option>
                                    <option>option 5</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">上传图像</label>
                                <input type="file" id="file" name="avatar">
                                <p class="help-block">Example block-level help text here.</p>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default pull-left" data-dismiss="modal">关闭</button>
                        <button type="submit" class="btn btn-primary">保存</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!--角色管理模态框-->
    <div class="modal fade" id="modal-role" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">角色管理</h4>
                </div>
                <form role="form">
                    <div class="modal-body">
                        <!-- form start -->
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">用户名</label>
                                <input type="text" class="form-control" name="username" id="username"  placeholder="请输入用户名">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">邮箱</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="请输入邮箱地址">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">密码</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="请输入密码">
                            </div>
                            <div class="form-group">
                                <label>所属机构</label>
                                <select class="form-control">
                                    <option>option 1</option>
                                    <option>option 2</option>
                                    <option>option 3</option>
                                    <option>option 4</option>
                                    <option>option 5</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">上传图像</label>
                                <input type="file" id="file" name="avatar">
                                <p class="help-block">Example block-level help text here.</p>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default pull-left" data-dismiss="modal">关闭</button>
                        <button type="submit" class="btn btn-primary">保存</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection