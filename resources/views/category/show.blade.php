@extends('layouts.base')

@section('title', '查看分类')

@section('content')
    @include('layouts._content_header', ['items' => ['查看分类']])
    <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">查看分类</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::open(['class' => 'form-horizontal']) !!}
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('icon', 'icon', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-10">
                        <img src="{{ get_image_url($category->img) }}" width="50" height="50"/>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('pid', '上级分类', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('pid', $category->pid == 0 ? '顶级分类' : $category->pidInfo->name, ['class' => 'form-control', 'disabled' => true]) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('name', '名称', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('name', $category->name, ['class' => 'form-control', 'disabled' => true]) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('status', '状态', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-10">
                        {{ get_status('notice', $category->status) }}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('sort', '排序值', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('sort', $category->sort, ['class' => 'form-control', 'disabled' => true]) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('created_at', '添加时间', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('created_at', $category->created_at, ['class' => 'form-control', 'disabled' => true]) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('updated_at', '修改时间', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('updated_at', $category->updated_at, ['class' => 'form-control', 'disabled' => true]) !!}
                    </div>
                </div>

                @if($category->pid > 0 && $category->options)
                    <div class="form-group">
                        {!! Form::label('option', '可选项', ['class' => 'col-sm-1 control-label']) !!}
                        <div class="col-sm-10">
                            @foreach ($category->options as $option)
                                <button type="button" class="btn btn-default">{{ $option->name }}</button>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="col-xs-2"></div>
                <div class="col-xs-8">
                    {!! link_to_route('category.index', '返回', null, ['class' => 'btn btn-info btn-block']) !!}
                </div>
                <div class="col-xs-2"></div>
            </div>
            <!-- /.box-footer -->
            {!! Form::close() !!}
        </div>
    </div>
@endsection