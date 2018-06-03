@extends('layouts.base')

@section('title', '修改服务人员信息')

@section('content')
    @include('layouts._content_header', ['items' => ['修改服务人员信息']])
    <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">修改服务人员信息</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::model($user, ['route' => ['waiter.doUpdate', 'id' => $user->id], 'class' => 'form-horizontal']) !!}
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
                            {!! Form::checkbox('category[]', $id, in_array($id, $serviceItems)) !!}{{ $category }}
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