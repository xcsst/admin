@extends('layouts.base')

@section('title', '查看用户信息')

@section('content')
    @include('layouts._content_header', ['items' => ['查看用户信息']])
    <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">查看用户信息</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::open(['class' => 'form-horizontal']) !!}
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('nickname', '姓名', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('nickname', $user->nickname, ['class' => 'form-control', 'disabled' => true]) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('username', '登录帐号', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('username', $user->username, ['class' => 'form-control', 'disabled' => true]) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('status', '状态', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-10">
                        {{ get_status('user', $user->status) }}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('created_at', '添加时间', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('created_at', $user->created_at, ['class' => 'form-control', 'disabled' => true]) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('updated_at', '修改时间', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('updated_at', $user->updated_at, ['class' => 'form-control', 'disabled' => true]) !!}
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="col-xs-2"></div>
                <div class="col-xs-8">
                    {!! link_to_route('user.index', '返回', null, ['class' => 'btn btn-info btn-block']) !!}
                </div>
                <div class="col-xs-2"></div>
            </div>
            <!-- /.box-footer -->
            {!! Form::close() !!}
        </div>
    </div>
@endsection