<?php

namespace App\Http\Controllers\Admin;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;//请求
use Illuminate\Foundation\Admin\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;//重定向
class SilderController extends Controller
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
        if(isset($request->all()['title'])){
            $name=$request->all()['title'];
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
            $where.="  title like '%$name%'";
            $count =\DB::table('silder')
                ->where('title','like','%'.$name.'%')
                ->count();
        }else{
            $where.="1=1";
            $count =\DB::table('silder')->count();
        }
        //设置每一页显示的条数
        $pageSize = 2;
        //计算偏移量
        $offset = ($pages - 1)*$pageSize;
        $sql = "select * from silder where $where limit $offset,$pageSize";
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
            $results[$key]->title=str_replace($name,"<font color='red'>$name</font>",$val->title);
        }
        //渲染
        return (['list'=>$results,'page'=>$str,'name'=>$name,'sql'=>$sql,'pages'=>$offset]);
    } 
    //添加
    public function store(Request $request){
      return view('admin.Silder.add');
    }
    //轮播图显示页面
    public  function show(Request $request){
        return view('admin.Silder.index');
    }
    public function upsilder(Request $request){
    //查询当前id对应的数据
         $silder=\DB::table('silder')->find($request->all()['id']);
          //定义id
         $id=$request->all()['id'];
         //分配数据到修改页面
        if ($_POST) {
          //获取新数据
            $silder=$request->all();
            $silder['time']=time();
          //执行修改语句
           $result=\DB::table('silder')->where(['id'=>$id])->update($silder);
           if ($result) {
             echo "yes";
           }
           else{
             echo "no";
           }
        }else{
          $silder=\DB::table('silder')->find($request->all('id'));
          //分配数据到修改页面
          return view('admin.Silder.add')->with("slider",$silder);
        }

    }
    public function add(Request $request){
      //剔除不必要的数据
         $data=$request->except("_token");
         $data=$request->except("_method");
         $data['time']=time();
           //插入数据
           if (\DB::table('silder')->insert($data)) {
            echo "ok";
            //重定向
             return redirect()->route('silder');
           }else{
            echo "no";
           }
    }
    public function status(Request $request){
       //剔除数据
       $arr=$request->except('_token');
       //修改管理员状态
       if (\DB::update("update silder set status=$arr[status] where id=$arr[id]")) {

           $array=array('status'=>1,'message'=>'修改成功');
                 return $array;
       //   return json_encode(['status'=>1,'message'=>'修改成功']);
       }else{
         //$array=array('status'=>1,'message'=>'修改成功');
         return json_encode(['status'=>0,'message'=>'修改失败']);
       }

    }
    //图片上传
    public function upload(Request $request)
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
            $savePath = public_path() . "\uploads\lun\\";
            $saveName = "silder-" . date('Y-m-d-H-i-s') . '-' . str_random(8);
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



}
