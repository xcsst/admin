@extends('layouts.base')

@section('title', '公告列表')

@section('content')
    @include('layouts._content_header', ['items' => ['公告列表']])
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body table-responsive no-padding">
                        @include('layouts._errors')
                        <table class="table table-hover table-bordered">
                            <tr>
                                <th>ID</th>
                                <th>分类</th>
                                <th>联系人</th>
                                <th>联系电话</th>
                                <th>阅读数</th>
                                <th>服务人员</th>
                                <th>排序值</th>
                                <th>添加时间</th>
                                <th>操作</th>
                            </tr>
                            @if ($orders)
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order['id'] or 0 }}</td>
                                        <td>{{ $order['category_id'] or '-' }}</td>
                                        <td>{{ $order['contacts'] }}</td>
                                        <td>{{ $order['phone'] }}</td>
                                        <td>{{ $order['view_count'] }}</td>
                                        <td>{{ $order['service_user_id'] }}</td>
                                        <td>{{ $order['sort'] or '0' }}</td>
                                        <td>{{ $order['created_at'] or '0' }}</td>
                                        <td>
                                            {{ link_to_route('notice.show', '查看', ['id' => $order['id']]) }}
                                            |
                                            {{ link_to_route('notice.update', '修改', ['id' => $order['id']]) }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                        {!! $orders->links() !!}
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
@endsection