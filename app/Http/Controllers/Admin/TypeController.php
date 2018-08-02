<?php

namespace App\Http\Controllers\Admin;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;//请求
use Illuminate\Foundation\Admin\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;//重定向

class TypeController extends Controller
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
    //后台首页显示页面
    public function index(Request $request){
        return view('admin.Type.index');
    }
    public function show(Request $request){
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
            $count =\DB::table('shop_type')
                ->where('name','like','%'.$name.'%')
                ->count();
        }else{
            $where.="1=1";
            $count =\DB::table('shop_type')->count();
        }
        //设置每一页显示的条数
        $pageSize = 2;
        //计算偏移量
        $offset = ($pages - 1)*$pageSize;
        $sql = "select * from shop_type where $where limit $offset,$pageSize";
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
    //添加
    public function addtype(Request $request){
          //剔除不必要的数据
          $data=$request->except("_token");
          $data=$request->except("_method");
          $data['addtime']=time();
          //插入数据
          if (\DB::table('shop_type')->insert($data)) {
           echo "ok";
           //重定向
            //return redirect()->route('addtype');
          }else{
           echo "no";
          }
    }
    public function store(Request $request){
       return view('admin.Type.add');      
    }
    //删除
    public function destory($id){
     //$user=user::find($id);  return DB::table($this->tableName)->where(['id'=>$id])->delete();
     $type=\DB::table('shop_type')->where(['id'=>$id])->delete();
     if ($type>0){
      echo "ok";
      //return redirect()->route('type','删除成功');
     }else{
      echo "no";
      //return redirect()->route('type');
     }
    }
    //商品类型修改
    public function uptype(Request $request){
      //查询当前id对应的数据
      $data=\DB::table('shop_type')->find($request->all()['id']);
       //定义id
      $id=$request->all()['id'];
      //分配数据到修改页面
      if ($_POST) {
        //获取新数据
          $data=$request->all(); 
        //执行修改语句
         $result=\DB::table('shop_type')->where(['id'=>$id])->update($data);
         if ($result) {
           echo "yes";
         }
         else{
           echo "no";
         }
      }else{
        $data=\DB::table('shop_type')->find($request->all('id'));
        //分配数据到修改页面
        return view('admin.Type.edit')->with("data",$data);
      }
      
    }
    /*
       修改商品类型状态
     */
    public function typestatus(Request $request){
          //剔除数据
          $arr=$request->except('_token');
          //修改管理员状态
          if (\DB::update("update shop_type set status=$arr[status] where id=$arr[id]")) {

              $array=array('status'=>1,'message'=>'修改成功');
                    return $array;
          //   return json_encode(['status'=>1,'message'=>'修改成功']);
          }else{
            //$array=array('status'=>1,'message'=>'修改成功');
            return json_encode(['status'=>0,'message'=>'修改失败']);
          }

       }
}
