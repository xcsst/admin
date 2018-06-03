@extends('layouts.base')

@section('title', '服务人员列表')

@section('content')
    @include('layouts._content_header', ['items' => ['服务人员列表']])
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">
                            {{ link_to_route('waiter.create', '添加服务人员') }}
                        </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        @include('layouts._errors')
                        <table class="table table-hover table-bordered">
                            <tr>
                                <th>ID</th>
                                <th>昵称</th>
                                <th>登录帐号</th>
                                <th>服务项目</th>
                                <th>状态</th>
                                <th>添加时间</th>
                                <th>操作</th>
                            </tr>
                            @if ($waiters)
                                @foreach($waiters as $waiter)
                                    <tr>
                                        <td>{{ $waiter['id'] or 0 }}</td>
                                        <td>{{ $waiter['nickname'] or '-' }}</td>
                                        <td>{{ $waiter['username'] or '-' }}</td>
                                        <td>
                                            @if(count($waiter->categorys))
                                                @foreach ($waiter->categorys as $option)
                                                    <button type="button" class="btn btn-default">{{ $option->category->name }}</button>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>{{ get_status('user', $waiter['status']) }}</td>
                                        <td>{{ $waiter['created_at'] or '0' }}</td>
                                        <td>
                                            @if ($waiter['status'] == 1)
                                                {{ link_to_route('waiter.disable', '禁用', ['id' => $waiter['id']]) }}
                                            @else
                                                {{ link_to_route('waiter.enable', '启用', ['id' => $waiter['id']]) }}
                                            @endif
                                            |
                                            {{ link_to_route('waiter.show', '查看', ['id' => $waiter['id']]) }}
                                            |
                                            {{ link_to_route('waiter.update', '修改', ['id' => $waiter['id']]) }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                        {!! $waiters->withPath(route('waiter.index'))->links() !!}
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
@endsection