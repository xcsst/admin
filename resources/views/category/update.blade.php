@extends('layouts.base')

@section('title', '修改分类')

@section('content')
    @include('layouts._content_header', ['items' => ['修改分类']])
    <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">修改分类</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::model($category, ['route' => ['category.doUpdate', 'id' => $category->id], 'class' => 'form-horizontal']) !!}
            @include('layouts._errors')
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('pid', '上级分类', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-10">
                        <span class="form-control">{{ $category->pid == 0 ? '顶级分类' : $category->pidInfo->name }}</span>
                        {!! Form::hidden('pid', $category->pid) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('name', '名称', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => '请输入名称']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('icon', 'icon', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::file('icon', ['class' => 'form-control', 'accept' => 'image/*']) !!}
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
                        {!! Form::text('sort', 0, ['class' => 'form-control', 'placeholder' => '请输入排序值']) !!}
                    </div>
                </div>
                @if($category->pid > 0)
                    <div id="category-option">
                        <hr/>
                        @if(count($category->options))
                            @foreach($category->options as $option)
                                <div class="form-group">
                                    @if ($loop->first)
                                        {!! Form::label('option', '分类可选值', ['class' => 'col-sm-1 control-label']) !!}
                                        <div class="col-sm-9">
                                            {!! Form::text('option[]', $option->name, ['class' => 'form-control', 'placeholder' => '请输入可选值']) !!}
                                        </div>
                                        <div class="col-sm-1">
                                            <a href="javascript:;" onclick="addOption()"><i class="fa fa-plus"></i></a>
                                        </div>
                                    @else
                                        {!! Form::label('option', '&nbsp;', ['class' => 'col-sm-1 control-label']) !!}
                                        <div class="col-sm-9">
                                            {!! Form::text('option[]', $option->name, ['class' => 'form-control', 'placeholder' => '请输入可选值']) !!}
                                        </div>
                                        <div class="col-sm-1">
                                            <a href="javascript:;" onclick="delOption(this)"><i class="fa fa-minus"></i></a>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <div class="form-group">
                                {!! Form::label('option', '分类可选值', ['class' => 'col-sm-1 control-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('option[]', null, ['class' => 'form-control', 'placeholder' => '请输入可选值']) !!}
                                </div>
                                <div class="col-sm-1">
                                    <a href="javascript:;" onclick="addOption()"><i class="fa fa-plus"></i></a>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
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
    <script type="text/javascript">
        function addOption() {
            var str = '<div class="form-group">' +
                '<label class="col-sm-1 control-label"></label>' +
                '<div class="col-sm-9">' +
                '<input class="form-control" placeholder="请输入可选值" name="option[]" type="text">' +
                '</div>' +
                '<div class="col-sm-1">' +
                '<a href="javascript:;" onclick="delOption(this)"><i class="fa fa-minus"></i></a>' +
                '</div>' +
                '</div>';
            $("#category-option").parent().append(str);
        }

        function delOption(obj) {
            $(obj).parent().parent().remove();
        }
    </script>
@endsection