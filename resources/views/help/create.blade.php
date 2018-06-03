@extends('layouts.base')

@section('title', '添加帮助信息')

@section('content')
    @include('layouts._content_header', ['items' => ['添加帮助信息']])
    <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">添加帮助信息</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::open(['route' => ['help.doCreate'], 'class' => 'form-horizontal']) !!}
            @include('layouts._errors')
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('question', '问题', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('question', null, ['class' => 'form-control', 'placeholder' => '请输入问题']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('answer', '答案', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::textarea('answer', null, ['class' => 'form-control', 'placeholder' => '请输入答案']) !!}
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