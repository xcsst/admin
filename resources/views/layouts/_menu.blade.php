<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview menu-open">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>控制面板</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="" class="admin.index"><i class="fa fa-cog"></i>系统设置</a></li>
                    <li><a href="{{ route('notice.index') }}" class="notice.index"><i class="fa fa-info"></i>公告设置</a></li>
                    <li><a href="{{ route('ad.index') }}" class="ad.index"><i class="fa fa-bullhorn"></i>广告位设置</a></li>
                    <li><a href="{{ route('help.index') }}" name="help.index"><i class="fa fa-hand-paper-o"></i>帮助中心</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>服务管理</span>
                    <span class="pull-right-container">
              <span class="fa fa-angle-left pull-right"></span>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{ route('category.index') }}" class="admin.index"><i class="fa fa-tags"></i>分类设置</a></li>
                    <li><a href="{{ route('waiter.index') }}" class="waiter.index"><i class="fa fa-male"></i>服务人员设置</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>用户管理</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('user.index') }}"><i class="fa fa-users"></i> 用户列表</a></li>
                    <li><a href=""><i class="fa fa-circle-o"></i> 添加用户</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>订单管理</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('order.index') }}"><i class="fa fa-circle-o"></i> 待审核列表</a></li>
                    <li><a href="{{ route('order.release') }}"><i class="fa fa-circle-o"></i> 发布中订单</a></li>
                    <li><a href="{{ route('order.servicing') }}"><i class="fa fa-circle-o"></i> 服务中订单</a></li>
                    <li><a href="{{ route('order.paying') }}"><i class="fa fa-circle-o"></i> 付款中订单</a></li>
                    <li><a href="{{ route('order.success') }}"><i class="fa fa-circle-o"></i> 已完成订单</a></li>
                    <li><a href="{{ route('order.cancel') }}"><i class="fa fa-circle-o"></i> 已作废订单</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
<script type="text/javascript">
    $(function() {
        var route = '{{ Route::currentRouteName() }}';
        var routeArr= route.split('.');
        var menuName = routeArr[0] + '.index';

        $(".sidebar ul.sidebar-menu").find('li.active').removeClass('menu-open');
        $(".sidebar ul.sidebar-menu").find('li.active').removeClass('active');
        switch (routeArr[0]) {
            case 'admin':
            case 'notice':
            case 'help':
                $(".sidebar ul.sidebar-menu").children('li').eq(1).addClass('active menu-open');
                break;
            case 'category':
            case 'waiter':
                $(".sidebar ul.sidebar-menu").children('li').eq(2).addClass('active menu-open');
                break;
            case 'user':
                $(".sidebar ul.sidebar-menu").children('li').eq(3).addClass('active menu-open');
                break;
        }
    });
</script>