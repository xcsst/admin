@extends('layouts.base')

@section('title', '修改用户信息')

@section('content')
    @include('layouts._content_header', ['items' => ['修改用户信息']])
    <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">修改用户信息</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::model($user, ['route' => ['user.doUpdate', 'id' => $user->id], 'class' => 'form-horizontal']) !!}
            @include('layouts._errors')
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('nickname', '姓名', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('nickname', null, ['class' => 'form-control', 'placeholder' => '请输入姓名']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('username', '登录帐号', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => '请输入登录帐号']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('password', '登录密码', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => '请输入登录密码']) !!}
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="col-xs-2"></div>
                <div class="col-xs-8">
                    {!! Form::submit('提交', ['class' => 'btn btn-info btn-block']) !!}
                </div>
                <div class="col-xs-2"></div>
            </div>
            <!-- /.box-footer -->
            {!! Form::close() !!}
        </div>
    </div>
@endsection