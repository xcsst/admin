@extends('layouts.base')

@section('title', '添加服务人员')

@section('content')
    @include('layouts._content_header', ['items' => ['添加服务人员']])
    <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">添加服务人员</h3>
            </div>
            <!-- /.box-header -->
            {!! Form::open(['route' => ['waiter.doCreate'], 'class' => 'form-horizontal']) !!}
            @include('layouts._errors')
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('nickname', '姓名', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('nickname', null, ['class' => 'form-control', 'placeholder' => '请输入服务人员姓名', 'maxlength' => 20]) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('username', '登录帐号', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => '请输入服务人员的登录帐号', 'maxlength' => 20]) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('password', '登录密码', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => '请输入服务人员的登录密码']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('category', '服务项目', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-10">
                        @foreach($categoryArr as $id => $category)
                        {!! Form::checkbox('category[]', $id) !!}{{ $category }}
                        @endforeach
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