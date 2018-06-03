@extends('layouts.base')

@section('title', '查看帮助信息')

@section('content')
    @include('layouts._content_header', ['items' => ['查看帮助信息']])
    <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">查看帮助信息</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::open(['class' => 'form-horizontal']) !!}
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('question', '问题', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('question', $help->question, ['class' => 'form-control', 'disabled' => true]) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('answer', '答案', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::textarea('answer', $help->answer, ['class' => 'form-control', 'disabled' => true]) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('status', '状态', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-10">
                        {{ get_status('help', $help->status) }}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('sort', '排序值', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('sort', $help->sort, ['class' => 'form-control', 'disabled' => true]) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('created_at', '添加时间', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('created_at', $help->created_at, ['class' => 'form-control', 'disabled' => true]) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('updated_at', '修改时间', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('updated_at', $help->updated_at, ['class' => 'form-control', 'disabled' => true]) !!}
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="col-xs-2"></div>
                <div class="col-xs-8">
                    {!! link_to_route('help.index', '返回', null, ['class' => 'btn btn-info btn-block']) !!}
                </div>
                <div class="col-xs-2"></div>
            </div>
            <!-- /.box-footer -->
            {!! Form::close() !!}
        </div>
    </div>
@endsection