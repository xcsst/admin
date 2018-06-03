@extends('layouts.base')

@section('title', '分类列表')

@section('content')
    @include('layouts._content_header', ['items' => ['分类列表']])
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">
                            {{ link_to_route('category.create', '添加分类') }}
                        </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        @include('layouts._errors')
                        <table class="table table-hover table-bordered">
                            <tr>
                                <th>ID</th>
                                <th>上级分类</th>
                                <th>标题</th>
                                <th>状态</th>
                                <th>排序值</th>
                                <th>添加时间</th>
                                <th>操作</th>
                            </tr>
                            @if ($categorys)
                                @foreach($categorys as $category)
                                    <tr>
                                        <td>{{ $category['id'] or 0 }}</td>
                                        <td>
                                            @if ($category['pid'] > 0)
                                                |-- {{ $category->pidInfo->name }}
                                            @else
                                            顶级分类
                                            @endif
                                        </td>
                                        <td>{{ $category['name'] or '-' }}</td>
                                        <td>{{ get_status('category', $category['status']) }}</td>
                                        <td>{{ $category['sort'] or '0' }}</td>
                                        <td>{{ $category['created_at'] or '0' }}</td>
                                        <td>
                                            @if ($category['status'] == 1)
                                                {{ link_to_route('category.disable', '禁用', ['id' => $category['id']]) }}
                                            @else
                                                {{ link_to_route('category.enable', '启用', ['id' => $category['id']]) }}
                                            @endif
                                            |
                                            {{ link_to_route('category.show', '查看', ['id' => $category['id']]) }}
                                            |
                                            {{ link_to_route('category.update', '修改', ['id' => $category['id']]) }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                        {!! $categorys->withPath(route('category.index'))->links() !!}
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
@endsection