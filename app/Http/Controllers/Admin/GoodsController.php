<?php

namespace App\Http\Controllers\Admin;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;//请求
use Illuminate\Foundation\Admin\AuthenticatesUsers;

class GoodsController extends Controller
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
    //后台商品首页
    //Request $request向页面发送请求
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
            $where=" s.name like '%$name%'";
            $count =\DB::table('shop_goods')
                ->where('name','like','%'.$name.'%')
                ->count();
        }else{
            $where="1=1";
            $count =\DB::table('shop_goods')->count();
        }
        //设置每一页显示的条数
        $pageSize = 2;
        //计算偏移量
        $offset = ($pages - 1)*$pageSize;
        $sql = "SELECT
                    s.`id`,
                    s.`name`,
                    s.`price`,
                    s.`status`,
                    s.`img`,
                    t.`name` as `typename`,
                    z.`name` as `sizename`
                FROM
                    shop_goods s
                LEFT JOIN shop_size z ON z.id = s.rule
                INNER JOIN shop_type t ON t.id = s.type_id
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
            $results[$key]->name=str_replace($name,"<font color='red'>$name</font>",$val->name);
        }
        //渲染
        return (['list'=>$results,'page'=>$str,'name'=>$name,'sql'=>$sql,'pages'=>$offset]);
    }
    public function index(Request $request){
        return view('admin.Goods.index');
    }
    //插入操作
    //admin/admin  post
    public function store(Request $request){
            //查询对应的商品类型名称
            $type=\DB::table('shop_type')
                    ->get();
            //查询对应的商品规格名称
            $size=\DB::table('shop_size')
                   ->get();
             //赋值到页面
            return view('admin.Goods.add')->with('type',$type)->with('size',$size);
}
    public function addgoods(Request $request){
               $data=$request->except("_token");
               $data=$request->except("_method");
               //添加商品时间
               $data['addtime']=time();
               $data['sales']=0;
               $data['volume']=0;
                 //插入数据
                 if (\DB::table('shop_goods')->insert($data)) {
                   echo "ok";
                   return redirect()->route('goods');
                 }else{
                  echo "no";
                 }
    }
    public function goodstatus(Request $request){
       //剔除数据
       $arr=$request->except('_token');
       //修改管理员状态
       if (\DB::update("update shop_goods set status=$arr[status] where id=$arr[id]")) {

           $array=array('status'=>1,'message'=>'修改成功');
                 return $array;
       //   return json_encode(['status'=>1,'message'=>'修改成功']);
       }else{
         //$array=array('status'=>1,'message'=>'修改成功');
         return json_encode(['status'=>0,'message'=>'修改失败']);
       }

    }
    //图片上传
    public function goodsimg(Request $request)
    {
        //dd($request->all());
        //判断是否上传成功$newname = "Imag".date('Y-m-d-H-i-s').'-'.str_random(8).'jpg'.".".$name;  //图片名
        if ($request) {
            $date = date('Ymd');
            $files = $_FILES;
            if (empty($files)) {
                $this->jsonReturn('未上传文件');
            }
            if (count($files) != 1) {
                $this->jsonReturn('仅支持单文件上传');
            }
            $file = current($files);
            if ($file['error'] != 0) {
                $this->jsonReturn('文件上传失败');
            }
            if (!preg_match('/png|jpg|jpeg|bmp|gif/i', pathinfo($file['name'], PATHINFO_EXTENSION))) {
                $this->jsonReturn('仅支持上传png|jpg|jpeg|bmp|gif格式');
            }
            $savePath = public_path() . "\uploads\goods\\";
            $saveName = "goods-" . date('Y-m-d-H-i-s') . '-' . str_random(8);
            $saveExt = pathinfo($file['name'], PATHINFO_EXTENSION);
            $saveUrl = $savePath . $saveName . '.' . $saveExt;
            //若保存目录不存在, 递归创建目录
            if (!is_dir($savePath)) {
                mkdir($savePath, 0755, true);
            }

            if (!move_uploaded_file($file['tmp_name'], $saveUrl)) {
                $this->jsonReturn('文件移动失败');
            }

            $this->jsonReturn(['status' => 1, 'url' => $saveUrl]);
        }

    }
    public function upgoods(Request $request){
        $request->all();
        $id=$request->all()['id'];
        //查询对应的商品类型名称
        $type=\DB::table('shop_type')
                   ->get();
        //查询对应的商品规格名称
        $size=\DB::table('shop_size')
                  ->get();
        //查询当前id对应的数据
        $data=\DB::table('shop_goods')->find($id);
        //分配数据到修改页面
        if ($_POST) {
            //获取新数据
            $data=$request->all();
            //执行修改语句
            $result=\DB::table('shop_goods')->where(['id'=>$id])->update($data);
            if ($result) {
                echo "yes";
            }
            else{
                echo "no";
            }
        }else{
            $data=\DB::table('shop_goods')->find($request->all('id'));
            //分配数据到修改页面
            return view('admin.Goods.add')->with("data",$data)->with('types',$type)->with('sizes',$size);
        }

    }

}
