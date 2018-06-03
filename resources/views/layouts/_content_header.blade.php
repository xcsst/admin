<section class="content-header" style="height:40px;">
    <ol class="breadcrumb" style="float:left;position: initial;">
        <li><a href="#"><i class="fa fa-home"></i> 控制面板</a></li>
        @if ($items)
            @foreach ($items as $item)
                <li class="active">{{ $item }}</li>
            @endforeach
        @endif
    </ol>
</section>