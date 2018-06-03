@extends('layouts.base')

@section('title', '公告列表')

@section('content')
    @include('layouts._content_header', ['items' => ['公告列表']])
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">
                            {{ link_to_route('notice.create', '添加公告') }}
                        </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        @include('layouts._errors')
                        <table class="table table-hover table-bordered">
                            <tr>
                                <th>ID</th>
                                <th>标题</th>
                                <th>状态</th>
                                <th>排序值</th>
                                <th>添加时间</th>
                                <th>操作</th>
                            </tr>
                            @if ($notices)
                                @foreach($notices as $notice)
                                    <tr>
                                        <td>{{ $notice['id'] or 0 }}</td>
                                        <td>{{ $notice['title'] or '-' }}</td>
                                        <td>{{ get_status('notice', $notice['status']) }}</td>
                                        <td>{{ $notice['sort'] or '0' }}</td>
                                        <td>{{ $notice['created_at'] or '0' }}</td>
                                        <td>
                                            @if ($notice['status'] == 1)
                                                {{ link_to_route('notice.disable', '禁用', ['id' => $notice['id']]) }}
                                            @else
                                                {{ link_to_route('notice.enable', '启用', ['id' => $notice['id']]) }}
                                            @endif
                                            |
                                            {{ link_to_route('notice.show', '查看', ['id' => $notice['id']]) }}
                                            |
                                            {{ link_to_route('notice.update', '修改', ['id' => $notice['id']]) }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                        {!! $notices->withPath(route('notice.index'))->links() !!}
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
@endsection