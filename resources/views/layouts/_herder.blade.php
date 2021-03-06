<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">饿了吧</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{route('menuclass.index')}}">菜品分类 <span class="sr-only">(current)</span></a></li>
                <li><a href="{{route('menu.index')}}">菜品列表</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">功能<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('addoreder.index')}}">订单管理</a></li>
                        <li><a href="#">订单量统计</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
            </ul>
            <form class="navbar-form navbar-left">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Link</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">菜单 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        @if(\Illuminate\Support\Facades\Auth::user())<li><a href="{{route('logut')}}">退出</a></li>@endif
                       @if(\Illuminate\Support\Facades\Auth::user()) <li><a href="{{route('revise')}}">修改密码</a></li>@endif
                        @if(!\Illuminate\Support\Facades\Auth::user())<li><a href="{{route('goodsaccount.create')}}">注册</a></li>@endif
                        <li role="separator" class="divider"></li>
                        @if(!\Illuminate\Support\Facades\Auth::user())<li><a href="{{route('login')}}">登录</a></li>@endif
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>