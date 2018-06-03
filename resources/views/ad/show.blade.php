@extends('layouts.base')

@section('title', '查看公告')

@section('content')
    @include('layouts._content_header', ['items' => ['查看公告']])
    <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">查看公告</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::open(['class' => 'form-horizontal']) !!}
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('type', '类型', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-10">
                        {{ get_position($ad->type) }}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('img', '图片', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-10">
                        <img src="{{ get_image_url($ad->img) }}" width="200" height="50" />
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('title', '标题', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('title', $ad->title, ['class' => 'form-control', 'disabled' => true]) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('target_url', '链接地址', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('target_url', $ad->target_url, ['class' => 'form-control', 'disabled' => true]) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('status', '状态', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-10">
                        {{ get_status('notice', $ad->status) }}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('sort', '排序值', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('sort', $ad->sort, ['class' => 'form-control', 'disabled' => true]) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('created_at', '添加时间', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('created_at', $ad->created_at, ['class' => 'form-control', 'disabled' => true]) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('updated_at', '修改时间', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('updated_at', $ad->updated_at, ['class' => 'form-control', 'disabled' => true]) !!}
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="col-xs-2"></div>
                <div class="col-xs-8">
                    {!! link_to_route('ad.index', '返回', null, ['class' => 'btn btn-info btn-block']) !!}
                </div>
                <div class="col-xs-2"></div>
            </div>
            <!-- /.box-footer -->
            {!! Form::close() !!}
        </div>
    </div>
@endsection