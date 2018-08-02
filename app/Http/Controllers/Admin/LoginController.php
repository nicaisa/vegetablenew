<?php
namespace App\Http\Controllers\Admin;
header("content-type:text/html chartset=utf-8");
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;//请求
use Illuminate\Foundation\Admin\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;//重定向
//引用对应的命名空间
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use Illuminate\Support\Facades\Cookie;
use Redirect;


class LoginController extends Controller
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
        //登陆显示页面
   public function login(){
         return view('admin.login.index');
        }
   // 验证码
   public function code($tmp)
       {
              $phrase = new PhraseBuilder;
              // 设置验证码位数
              $code = $phrase->build(4);
              // 生成验证码图片的Builder对象，配置相应属性
              $builder = new CaptchaBuilder($code, $phrase);
              // 设置背景颜色
              $builder->setBackgroundColor(255, 255, 255);
              $builder->setMaxAngle(10);
              $builder->setMaxBehindLines(0);
              $builder->setMaxFrontLines(0);
              // 可以设置图片宽高及字体
              $builder->build($width = 100, $height = 40, $font = null);
              // 获取验证码的内容
              $phrase = $builder->getPhrase();
              // 把内容存入session
              Cookie::queue('captcha',  $phrase);
              //Session::flash('captcha', $phrase);
               //清除缓存
              ob_clean();
              //返回图片
              return response($builder->output())->header('Content-type','image/jpeg');
       }
  public function check(Request $request){
      //获取用户输入的数据
       $code=$request->input('code');
       $name=$request->input('name');
       $pwd=$request->input('pwd');
       $true_code = Cookie::get('captcha');
       //判断用户输入的验证码与生成的验证码是否一致
        if ( $true_code== $code) {
          //查找数据
           $data=\DB::table("shop_admin")->where([['name','=',$name],['status','=',1]])->first();
          //验证数据是否存在
           if ($data) {
            //验证密码是否正确
            //需要解密的密码\Crypt::decrypt($data->pwd);
              if ($pwd==$data->pwd){
                  Cookie::queue('name', $data->name);
                  Cookie::queue('id',$data->id);
                 //声明空数组来装需要修改的信息
                 $arr=[];
                 $arr['lasttime']=time();
                 $arr['sum']=++$data->sum;
                 $arr['id']=$data->id;
                 //执行修改语句
                 \DB::table("shop_admin")->where('id',$data->id)->update($arr);
                  header("Location: http://120.78.164.47/fvheart/public/index.php/admin");
                  return json_encode(['code' => 1, 'message' => '登录成功']);

              }else{
                  return json_encode(['code' => 0, 'message' => '密码错误']);
              }
        }else{
               return json_encode(['code' => 0, 'message' => '用户名不存在或者已经被禁用']);
            }

      } else {
            return json_encode(['code' => 0, 'message' => '验证码错误']);

        }


  }
  // 退出登录
public function logout(Request $request){
     $request->session()->flush();
     return redirect('adminlogin');
}

}
  
