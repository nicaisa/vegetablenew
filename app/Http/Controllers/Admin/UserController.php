<?php

namespace App\Http\Controllers\Admin;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;//请求
use Illuminate\Foundation\Admin\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;//重定向

class UserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    //后台首页
    public function index(Request $request){
        //接收值
        if(isset($request->all()['username'])){
            $name=$request->all()['username'];
        }
        else{
            $name='';
        }
        //判断是否存在page
        if(isset($request->all()['pages'])) {
            $pages =intval($request->all()['pages']);
        }
        else{
            $pages=1;
        }
        //拼接搜索条件
        $where=' ';
        //模糊查询
        if(!empty($name)){
            $where.="  username like '%$name%'";
            $count =\DB::table('user')
                ->where('username','like','%'.$name.'%')
                ->count();
        }else{
            $where.="1=1";
            $count =\DB::table('user')->count();
        }
        //设置每一页显示的条数
        $pageSize = 2;
        //计算偏移量
        $offset = ($pages - 1)*$pageSize;
        $sql = "select * from user where $where limit $offset,$pageSize";
        //查询分页后的数据信息
        $results = \DB::select($sql);
        //计算总页数
        $pageSum = ceil($count/$pageSize);
        //计算上一页 下一页
        $last = $pages<=1 ? 1 : $pages-1 ;
        $next = $pages>=$pageSum ? $pageSum : $pages+1 ;
        //拼接A链接
        $str = '<ul class="pagination">';
        $str .= "<li><a href='javascript:void(0);'  onclick='sou(1)' data-page='1'>首页</a></li>";
        $str .= "<li><a href='javascript:void(0);'  onclick='sou($last)' data-page='$last'>上一页</a></li>";
        $str .= "<li><a href='javascript:void(0);'  onclick='sou($next)' data-page='$next'>下一页</a></li>";
        $str .= "<li><a href='javascript:void(0);'  onclick='sou($pageSize)' data-page='$pageSize'>尾页</a></li>";
        $str .= "<li><a href='javascript:void(0);' >第".$pages."页</a></li>";
        $str.="</ul>";
        //关键字变红
        foreach($results as $key=>$val){
            //将搜索关键字替换成红色
            $results[$key]->username=str_replace($name,"<font color='red'>$name</font>",$val->username);
        }
        //渲染
        return (['list'=>$results,'page'=>$str,'username'=>$name,'sql'=>$sql,'pages'=>$offset]);
    }


    public function show(Request $request){
        return view('admin.User.index');
    }
  public function info($id){
    //查询用户表
    $user=\DB::table('user')->where(['id'=>$id])->first();
    //dd($user);
    //查询用户详情表
    $userinfo=\DB::table('user_info')->where(['user_id'=>$id])->first();
    //清空数据
      $data=array(
        "user"=>$user,
        "userinfo"=>$userinfo,

      );
     return view('admin.User.info')->with($data);
  }
  public function ajaxstate(Request $request){
     //剔除数据
     $arr=$request->except('_token');
     //修改管理员状态
     if (\DB::update("update user set status=$arr[status] where id=$arr[id]")) {

         $array=array('status'=>1,'message'=>'修改成功');
               return $array;
     }else{
       return json_encode(['status'=>0,'message'=>'修改失败']);
     }

  }
}
