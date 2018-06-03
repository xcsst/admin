@extends('layouts.base')

@section('title', '添加公告')

@section('content')
    @include('layouts._content_header', ['items' => ['添加公告']])
    <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">添加公告</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::open(['route' => ['notice.doCreate'], 'class' => 'form-horizontal']) !!}
            @include('layouts._errors')
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('title', '标题', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => '请输入标题']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('content', '内容', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => '请输入内容']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('status', '状态', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::radio('status', 1, true) !!} 显示
                        {!! Form::radio('status', -1, false) !!} 隐藏
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('sort', '排序值', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('sort', null, ['class' => 'form-control', 'placeholder' => '请输入排序值']) !!}
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