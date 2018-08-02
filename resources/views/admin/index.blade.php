 <!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <title>果真蔬心</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Loading Bootstrap -->
    <link href="{{asset('/style/admin/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('/style/admin/css/dataTables.bootstrap.css')}}" rel="stylesheet">
    <!-- Loading Stylesheets -->
    <link href="{{asset('/style/admin/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('/style/admin/css/style.css')}}" rel="stylesheet" type="text/css">
    <!-- Loading Custom Stylesheets -->
    <link href="{{asset('style/admin/css/custom.css')}}" rel="stylesheet">
    <link rel="shortcut icon" href="{{asset('style/admin/images/favicon.ico')}}">
<style>
a{ cursor:pointer}
</style>
</head>
<body>
  <div class="site-holder">
    <nav class="navbar" role="navigation">
        <div class="navbar-header">
          <span class="navbar-brand">
              <i class="fa fa-list btn-nav-toggle-responsive text-white"></i> 
                <span class="logo">果真蔬心<i class="fa fa-hand-o-left"></i></span>
            </span>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav user-menu navbar-right ">
              <li><a href="{{route('adminlogin')}}" class="user dropdown-toggle" data-toggle="dropdown"><span class="username"><img src="{{asset('style/admin/img/headimg/head.jpg')}}" class="user-avatar" alt="">
                          {{ request()->cookie('name') }}</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('adminlogin')}}" target="main"><i class="fa fa-cogs"></i> 修改密码</a></li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{route('logout')}}" class="text-danger" onclick=" if (!confirm('确认退出吗？')) { window.event.returnValue = false; }">
                                <i class="fa fa-lock"></i> 退出系统
                            </a>
                        </li>
                     </ul>
                 </li>
            </ul>
        </div>
    </nav>
    <div class="box-holder">
        <div class="left-sidebar">
            <div class="sidebar-holder">
                <ul class="nav  nav-list">
                    <li class="nav-toggle">
                        <button class="btn  btn-nav-toggle text-primary"><i class="fa fa-angle-double-left toggle-left"></i> 
                        </button>
                    </li>
                    <li><a data-original-title="Dashboard"><i class="fa fa-male"></i>
                        <span class="hidden-minibar">用户管理 </span></a>
                        <ul>
                            <li style="margin-left:35px">
                                <a href="{{route('usershow')}}" data-original-title="Dynamic" target="main">
                                    <i class="fa fa-eye"></i><span> 查看用户列表</span>
                                </a>
                            </li>
                        </ul> 
                    </li>
                    <li><a data-original-title="Dashboard"><i class="fa fa-road"></i>
                            <span class="hidden-minibar">广告信息管理</span></a>
                        <ul>
                            <li style="margin-left:35px;">
                                <a href="{{route('showadv')}}" data-original-title="Dynamic" target="main">
                                    <i class="fa fa-eye"></i>广告信息
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li><a data-original-title="Dashboard"><i class="fa fa-road"></i>
                        <span class="hidden-minibar">轮播图管理</span></a>
                      <ul>
                         <li style="margin-left:35px;">
                            <a href="{{url('Silder/show')}}" data-original-title="Dynamic" target="main">
                                <i class="fa fa-eye"></i>轮播图信息
                            </a>
                          </li>
                      </ul>  
                    </li>
                    <li><a data-original-title="Dashboard"><i class="fa fa-road"></i>
                        <span class="hidden-minibar">商品类型管理</span></a>
                      <ul>
                          <li style="margin-left:35px">
                              <a href="{{route('type')}}" data-original-title="Dynamic" target="main">
                                <i class="fa fa-glass"></i><span>查看商品类型</span>
                              </a>
                          </li> 
                      </ul>  
                    </li>
                    <li><a data-original-title="Dashboard"><i class="fa fa-road"></i>
                        <span class="hidden-minibar">商品管理</span></a>
                      <ul>
                          <li style="margin-left:35px">
                              <a href="admin/Goods/index" data-original-title="Dynamic" target="main">
                                <i class="fa fa-glass"></i><span>查看商品</span>
                              </a>
                          </li> 
                      </ul>  
                    </li>
                    <li><a data-original-title="Dashboard"><i class="fa fa-eye"></i>
                        <span class="hidden-minibar">商
                        品规格管理</span></a>
                      <ul>
                          <li style="margin-left:35px">
                              <a href="{{route('showsize')}}" data-original-title="Dynamic" target="main">
                                <i class="fa fa-search-plus"></i><span>查看商品规格</span>
                              </a>
                          </li> 
                      </ul>  
                    </li>
                    <li><a data-original-title="Dashboard"><i class="fa fa-search-plus"></i>
                        <span class="hidden-minibar">商品订单管理</span></a>
                      <ul>
                          <li style="margin-left:35px">
                              <a href="{{url('Order/index')}}" data-original-title="Dynamic" target="main">
                                <i class="glyphicon glyphicon-plus"></i><span>查看订单</span>
                              </a>
                          </li> 
                      </ul>  
                    </li>
                    <li><a data-original-title="Dashboard"><i class="glyphicon glyphicon-shopping-cart"></i>
                        <span class="hidden-minibar">购物车管理</span></a>
                      <ul>
                          <li style="margin-left:35px">
                              <a href="{{route('cartindex')}}" data-original-title="Dynamic" target="main">
                                <i class="fa fa-search-plus"></i><span>查看购物车</span>
                              </a>
                          </li> 
                      </ul>  
                    </li>
                    <li><a data-original-title="Dashboard"><i class="fa fa-road"></i>
                        <span class="hidden-minibar">管理员管理</span></a>
                      <ul>
                          <li style="margin-left:35px">
                              <a href="{{url('admin/show')}}" data-original-title="Dynamic" target="main">
                                <i class="fa fa-search-plus"></i><span>查看管理员</span>
                              </a>
                          </li> 
                      </ul>  
                    </li>

                </ul>
            </div>
        </div>
        <!-- /.left-sidebar -->
    
        <!-- .content -->
        <div class="content">
            <div class="row">
                <div class="col-mod-12">
                    <div class="form-group hiddn-minibar pull-right">
                        <span class="input-icon fui-search"></span>
                    </div>
                    <h3 class="page-header">
                    <i class="fa   fa-female"></i><i class="fa fa-male"></i> 
                    <i>www.FV_heart.com</i></h3>
    
                </div>
            </div>
            <style>
            ::-webkit-scrollbar{
                overflow: hidden;
            }
            </style>
            <div class="row">
           
                <div class="col-md-12">
                    <div class="panel">
                    
                        <div class="panel-body">
                        <iframe name="main" width="103%" height="586px" frameborder="0" style=" margin-left:-10px;margin-top:-27px" src="{{route('welcome')}}"></iframe>
                        </div>
                        
                    </div>
                </div>
                
            </div>
            <div class="footer">
                © 2018 <a href="#">果真蔬心管理系统</a>
            </div>
    
        </div>
        <div class="right-sidebar right-sidebar-hidden">
            <div class="right-sidebar-holder">
                <a href="screens.html" class="btn btn-danger btn-block">Logout </a>
                <h4 class="page-header text-primary text-center">
                            Theme Options
                            <a  href="#"  class="theme-panel-close text-primary pull-right"><strong><i class="fa fa-times"></i></strong></a>
                        </h4>
    
                <ul class="list-group theme-options">
                    <li class="list-group-item" href="#">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="fixedNavbar" value="">Fixed Top Navbar
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="fixedNavbarBottom" value="">Fixed Bottom Navbar
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="boxed" value="">Boxed Version
                            </label>
                        </div>
    
                        <div class="form-group backgroundImage hidden">
                            <label class="control-label">Paste Image Url and then hit enter</label>
                            <input type="text" class="form-control" id="backgroundImageUrl" />
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    </div>
  
    <!-- Load JS here for Faster site load =============================-->
  
    <script src="{{asset('style/admin/js/jquery-1.11.1.min.js')}}"></script>
    <script src="{{asset('style/admin/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('style/admin/js/jquery-ui-1.10.3.custom.min.js')}}"></script>
    <script src="{{asset('style/admin/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('style/admin/js/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('style/admin/js/bootstrap-select.js')}}"></script>
    <script src="{{asset('style/admin/js/bootstrap-switch.js')}}"></script>
    <script src="{{asset('style/admin/js/jquery.placeholder.js')}}"></script>
    <script src="{{asset('style/admin/js/bootstrap-typeahead.js')}}"></script>
    <script src="{{asset('style/admin/js/application.js')}}"></script>
    <script src="{{asset('style/admin/js/moment.min.js')}}"></script>
    <script src="{{asset('style/admin/js/jquery.sortable.js')}}"></script>
    <script type="text/javascript" src="{{asset('style/admin/js/jquery.gritter.js')}}"></script>
    <script src="{{asset('style/admin/js/jquery.nicescroll.min.js')}}"></script>
    <script src="{{asset('style/admin/js/prettify.min.js')}}"></script>
    <script src="{{asset('style/admin/js/jquery.noty.js')}}"></script>
    <script src="{{asset('style/admin/js/jquery.accordion.js')}}"></script>
    <script src="{{asset('style/admin/js/skylo.js')}}"></script>

    <script src="{{asset('style/admin/js/theme-options.js')}}"></script>

    <!-- Core Jquery File  =============================-->
    <script src="{{asset('style/admin/js/core.js')}}"></script>

</body>

</html>