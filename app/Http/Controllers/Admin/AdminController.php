<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Admin\AuthenticatesUsers;
use Illuminate\Http\Request;
//表单验证类
use Illuminate\Support\Facades\Validator;
use Closure;

class AdminController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Goods Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    //Request $request向页面发送请求
    public function index(Request $request){
        //接收值
        if(isset($request->all()['name'])){
            $name=$request->all()['name'];
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
            $where.="  name like '%$name%'";
            $count =\DB::table('shop_admin')
                ->where('name','like','%'.$name.'%')
                ->count();
        }else{
            $where.="1=1";
            $count =\DB::table('shop_admin')->count();
        }
        //设置每一页显示的条数
        $pageSize = 2;
        //计算偏移量
        $offset = ($pages - 1)*$pageSize;
        $sql = "select * from shop_admin where $where limit $offset,$pageSize";
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
            $results[$key]->name=str_replace($name,"<font color='red'>$name</font>",$val->name);
        }
        //渲染
        return (['list'=>$results,'page'=>$str,'name'=>$name,'sql'=>$sql,'pages'=>$offset]);

  }
  public function show(Request $request){
      return view('admin.Admin.index');
  }
    public function add(Request $request){
        return view('admin.Admin.add');
    }
    /**
     * 添加
     * [store description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request){
     //把字符串处理成数组
              parse_str($_POST['str'],$arr);
               //表单验证规则
               $rules=[
                  //用户名不能为空唯一,并且要在6-12位之间
                 'name'=>'required|unique:shop_admin|between:6,12',
                  //密码不能为空，两次输入密码要相同，并且要在6-12位之间
                 'pwd'=>'required|same:repwd|between:6,12',
               ];
               //提示信息
               $message=[
                  'name.required'=>"用户名不能为空",
                  'pwd.required'=>"密码不能为空",
                  'name.unique'=>"用户名已存在",
                  'pwd.same'=>"两次密码要一致",
                  'name.between'=>"用户名要在6-12位之间",
                  'pwd.between'=>"密码要在6-12位之间",

               ];
               //使用laravel表单验证类
               //$arr数据 $rules验证规则，$message提示信息
               $validator=\Validator::make($arr,$rules,$message);
               //判断验证是否通过
               if ($validator->passes()) {
                 //移除不需要的数据确认密码
                 unset($arr['repwd']);
                 //添加时间为当前时间
                 $arr['time']=time();
                 $arr['status']=1;
                 $arr['lasttime']=time();
                 $arr['sum']=0;
                     //判断数据是否插入
                  $res = \DB::table('shop_admin')->insert($arr);
                     if ($res) {
                          $array=array('code'=>1,'message'=>'添加成功');
                          return $array;
                     }else{
                          $array=array('code'=>0,'message'=>'添加失败');
                          return $array;
                     }
                     
               }else{
                 //具体看laravel核心类
                 return $validator->getMessageBag()->getMessages();
               }
    }

    /**
     * 删除
     * [destory description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function del(Request $request){
         if (\DB::table('shop_admin')->delete($request->all()['id'])){
           $array=array('code'=>1,'message'=>'修改成功');
                 return $array;
         }
         else{
           $array=array('code'=>0,'message'=>'修改失败');
                 return $array;
         }

    }
    public function ajaxstatus(Request $request){
       //剔除数据
       $arr=$request->except('_token');
       //修改管理员状态
       if (\DB::update("update shop_admin set status=$arr[status] where id=$arr[id]")) {

           $array=array('status'=>1,'message'=>'修改成功');
                 return $array;
       //   return json_encode(['status'=>1,'message'=>'修改成功']);
       }else{
         //$array=array('status'=>1,'message'=>'修改成功');
         return json_encode(['status'=>0,'message'=>'修改失败']);
       }

    }
    public function like(Request $request){


    }
}
