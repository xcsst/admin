@extends('layouts.base')

@section('title', '添加分类')

@section('content')
    @include('layouts._content_header', ['items' => ['添加分类']])
    <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">添加分类</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::open(['route' => 'category.doCreate', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
            @include('layouts._errors')
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('pid', '上级分类', ['class' => 'col-sm-1 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::select('pid', $categoryArr, null, ['class' => 'form-control', 'id' => 'pid']) !!}
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
                <div id="category-option" style="display:none;">
                    <hr/>
                    <div class="form-group">
                        {!! Form::label('option', '分类可选值', ['class' => 'col-sm-1 control-label']) !!}
                        <div class="col-sm-9">
                            {!! Form::text('option[]', null, ['class' => 'form-control', 'placeholder' => '请输入可选值']) !!}
                        </div>
                        <div class="col-sm-1">
                            <a href="javascript:;" onclick="addOption()"><i class="fa fa-plus"></i></a>
                        </div>
                    </div>
                </div>
            </div>
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
        $("#pid").change(function () {
            var val = $(this).val();
            if (val == 0) {
                $("#category-option").hide();
            } else {
                $("#category-option").show();
            }
        });

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