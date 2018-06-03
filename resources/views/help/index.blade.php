@extends('layouts.base')

@section('title', '帮助信息列表')

@section('content')
    @include('layouts._content_header', ['items' => ['帮助信息列表']])
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">
                            {{ link_to_route('help.create', '添加帮助信息') }}
                        </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        @include('layouts._errors')
                        <table class="table table-hover table-bordered">
                            <tr>
                                <th>ID</th>
                                <th>问题</th>
                                <th>状态</th>
                                <th>排序值</th>
                                <th>添加时间</th>
                                <th>操作</th>
                            </tr>
                            @if ($helps)
                                @foreach($helps as $help)
                                    <tr>
                                        <td>{{ $help['id'] or 0 }}</td>
                                        <td>{{ $help['question'] or '-' }}</td>
                                        <td>{{ get_status('help', $help['status']) }}</td>
                                        <td>{{ $help['sort'] or '0' }}</td>
                                        <td>{{ $help['created_at'] or '0' }}</td>
                                        <td>
                                            @if ($help['status'] == 1)
                                                {{ link_to_route('help.disable', '禁用', ['id' => $help['id']]) }}
                                            @else
                                                {{ link_to_route('help.enable', '启用', ['id' => $help['id']]) }}
                                            @endif
                                            |
                                            {{ link_to_route('help.show', '查看', ['id' => $help['id']]) }}
                                            |
                                            {{ link_to_route('help.update', '修改', ['id' => $help['id']]) }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                        {!! $helps->withPath(route('help.index'))->links() !!}
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
@endsection