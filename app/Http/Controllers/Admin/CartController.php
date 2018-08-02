<?php

namespace App\Http\Controllers\Admin;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;//请求
use Illuminate\Foundation\Admin\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;//重定向

class CartController extends Controller
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
    public function show(Request $request){
        //接收值
        if(isset($request->all()['user_id'])){
            $name=$request->all()['user_id'];
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
            $where=" u.username like '%$name%'";
            $count =\DB::table('shop_cart')
                ->where('name','like','%'.$name.'%')
                ->count();
        }else{
            $where="1=1";
            $count =\DB::table('shop_cart')->count();
        }
        //设置每一页显示的条数
        $pageSize = 2;
        //计算偏移量
        $offset = ($pages - 1)*$pageSize;
        $sql = "SELECT
                    s.`id`,
                    u.`username` as 'username',
                    c.`goods_img`,
                    c.`num`,
                    s.`name` as 'goodname',
                    c.`shop_rule`,
                    c.`price`,
                    c.`add_time`
                FROM
                    shop_cart c
                LEFT JOIN user u ON u.id = c.user_id
                INNER JOIN shop_goods s ON s.id = c.goods_id
                WHERE $where limit $offset,$pageSize";
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
        return (['list'=>$results,'page'=>$str,'name'=>$name,'sql'=>$sql,'pages'=>$offset]);
    }
    public function  index(Request $request){
        return view('admin.Cart.index');
    }
    //加入购物车操作
    public function add_cart(Request $request){
        $user_id=session()->all()['user']['user_id'];
        $arr=$request->all();
        $arr['user_id']=session()->all()['user']['user_id'];
        $arr['add_time']=time();
        //查询购物车表数据
        $cart=\DB::table('shop_cart')
            ->where('user_id','=',$user_id)
            ->where('goods_id', '=', $arr['goods_id'])
            ->first();
        //判断数据是否存在
        if(empty($cart)){
            //如果不存在直接添加数据
            if ( $res = \DB::table('shop_cart')->insert($arr)) {
                $array=array('code'=>1,'message'=>'添加成功');
                return $array;
            }else{
                $array=array('code'=>0,'message'=>'添加失败');
                return $array;
            }
            //如果存在就直接修改数量，不增加数据
        }else{
            //声明空数组来装需要修改的信息
            $arr=[];
            $arr['num']=++$cart->num;
            $arr['id']=$cart->id;
            //执行修改语句
            \DB::table("shop_cart")->where('id',$cart->id)->update($arr);
        }
    }

}
