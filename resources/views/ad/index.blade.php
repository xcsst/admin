@extends('layouts.base')

@section('title', '广告列表')

@section('content')
    @include('layouts._content_header', ['items' => ['广告列表']])
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">
                            {{ link_to_route('ad.create', '添加广告') }}
                        </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        @include('layouts._errors')
                        <table class="table table-hover table-bordered">
                            <tr>
                                <th>ID</th>
                                <th>类别</th>
                                <th>图片</th>
                                <th>标题</th>
                                <th>链接地址</th>
                                <th>状态</th>
                                <th>添加时间</th>
                                <th>操作</th>
                            </tr>
                            @if ($ads)
                                @foreach($ads as $ad)
                                    <tr>
                                        <td>{{ $ad['id'] or 0 }}</td>
                                        <td>{{ get_position($ad['type']) }}</td>
                                        <td>
                                            <img src="{{ get_image_url($ad['img']) }}" width="200" height="50" />
                                        </td>
                                        <td>{{ $ad['title'] or '-' }}</td>
                                        <td>{{ $ad['target_url'] or '-' }}</td>
                                        <td>{{ get_status('ad', $ad['status']) }}</td>
                                        <td>{{ $ad['created_at'] or '0' }}</td>
                                        <td>
                                            @if ($ad['status'] == 1)
                                                {{ link_to_route('ad.disable', '禁用', ['id' => $ad['id']]) }}
                                            @else
                                                {{ link_to_route('ad.enable', '启用', ['id' => $ad['id']]) }}
                                            @endif
                                            |
                                            {{ link_to_route('ad.show', '查看', ['id' => $ad['id']]) }}
                                            |
                                            {{ link_to_route('ad.update', '修改', ['id' => $ad['id']]) }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                        {!! $ads->withPath(route('ad.index'))->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection