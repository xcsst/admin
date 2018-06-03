@extends('layouts.base')

@section('title', '用户列表')

@section('content')
    @include('layouts._content_header', ['items' => ['用户列表']])
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">
                            {{ link_to_route('notice.create', '添加用户') }}
                        </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        @include('layouts._errors')
                        <table class="table table-hover table-bordered">
                            <tr>
                                <th>ID</th>
                                <th>姓名</th>
                                <th>登录帐号</th>
                                <th>状态</th>
                                <th>添加时间</th>
                                <th>操作</th>
                            </tr>
                            @if ($users)
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user['id'] or 0 }}</td>
                                        <td>{{ $user['nickname'] or '-' }}</td>
                                        <td>{{ $user['username'] or '-' }}</td>
                                        <td>{{ get_status('user', $user['status']) }}</td>
                                        <td>{{ $user['created_at'] or '0' }}</td>
                                        <td>
                                            @if ($user['status'] == 1)
                                                {{ link_to_route('user.disable', '禁用', ['id' => $user['id']]) }}
                                            @else
                                                {{ link_to_route('user.enable', '启用', ['id' => $user['id']]) }}
                                            @endif
                                            |
                                            {{ link_to_route('user.show', '查看', ['id' => $user['id']]) }}
                                            |
                                            {{ link_to_route('user.update', '修改', ['id' => $user['id']]) }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                        {!! $users->withPath(route('user.index'))->links() !!}
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
@endsection