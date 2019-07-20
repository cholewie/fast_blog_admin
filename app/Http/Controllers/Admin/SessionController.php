<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\adminRequest;
use App\Models\AdminModel;
use App\Models\ResetPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SessionController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest',[
            'only'=>'loginForm'
        ]);
    }


    public function loginForm()
    {
        return view('admin.loginForm');
    }

    /**
     * @param adminRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @auth xiaowei
     * @date 2019/7/8
     * @desc 注册
     */
    public function signup(adminRequest $request)
    {
        if ( !env('IS_OPEN_ADMIN_REGISTER',false) ) {
            session()->flash('info', '暂未开启注册管理员！');
            return redirect()->route('admin.login_form');
        }

        $adminUser = AdminModel::query()->create([
            'email'=>$request->input('email'),
            'name' => $request->input('name'),
            'password' => bcrypt($request->input('password'))
        ]);

        $this->sendConfirmEmail($adminUser);
        session()->flash('success', '验证邮件已发送到你的注册邮箱上，请注意查收。');
        return redirect()->route('admin.login_form');
    }

    /**
     * @param $user
     * @auth xiaowei
     * @date 2019/7/8
     * @desc 发生邮箱验证
     */
    public function sendConfirmEmail($user)
    {
        $view = 'confirm.confirm';
        $data = compact('user');
        $from = env('MAIL_FROM_ADDRESS','13177839316@163.com');
        $name = env('MAIL_FROM_NAME','我的践行屋');
        $to = $user->email;
        $subject = "感谢注册《我的践行屋》！请确认你的邮箱。";

        Mail::send($view, $data, function ($message) use ($from, $name, $to, $subject) {
            $message->to($to)->subject($subject);
        });
    }

    /**
     * @param adminRequest $request
     * @auth xiaowei
     * @date 2019/7/9
     * @desc 忘记密码
     */
    public function forget(adminRequest $request)
    {
        //生成一个token
        $token = Str::random(60);
        //发送修改密码路由至邮箱中
        $email = $request->input('email');

        $reset = ResetPassword::query()->create([
            'email'=>$email,
            'token'=>$token,
            'created_at'=>now()
        ]);

        $this->sendResetEmail($reset);

        session()->flash('success', '重设密码邮件已发送到你的注册邮箱上，请注意查收。');
        return redirect()->route('admin.login_form');
    }

    public function sendResetEmail($reset)
    {
        $view = 'confirm.resetView';
        $data = compact('reset');
        $from = env('MAIL_FROM_ADDRESS','13177839316@163.com');
        $name = env('MAIL_FROM_NAME','我的践行屋');
        $to = $reset->email;
        $subject = "{$name}，密码找回";

        Mail::send($view, $data, function ($message) use ($from, $name, $to, $subject) {
            $message->to($to)->subject($subject);
        });
    }

    /**
     * @auth xiaowei
     * @date 2019/7/9
     * @desc 重置密码页面
     */
    public function resetView($token)
    {
        return view('confirm.resetForm',['token'=>$token]);
    }

    public function resetAction(adminRequest $request)
    {
        $token = $request->input('token');
        $password = bcrypt($request->input('password'));
        $email = ResetPassword::query()->where('token',$token)->first();

        if (!$email) {
            session()->flash('danger', '异常操作！');
            return redirect()->route('admin.login_form');
        }

        AdminModel::query()->where('email',$email->email)->update([
            'password'=>$password,
            'updated_at' => now()
        ]);

        //删除重置token
        ResetPassword::query()->where('token',$token)->delete();

        session()->flash('success', '修改成功，请重新登录！');
        return redirect()->route('admin.login_form');
    }

    /**
     * @param adminRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @auth xiaowei
     * @date 2019/7/8
     * @desc 登录
     */
    public function login(adminRequest $request)
    {
        $cre = $request->only('email','password');

        if ( Auth::attempt($cre) ) {
            if (Auth::user()->activated) {
                session()->flash('success','欢迎回来！');
                return redirect()->route('admin.home');
            } else {
                Auth::logout();
                session()->flash('warning', '你的账号未激活，请检查邮箱中的注册邮件进行激活。');
                return redirect()->back()->withInput();
            }

        } else {
            session()->flash('danger','邮箱与密码不匹配！');
            return redirect()->back()->withInput();
        }
    }

    /**
     * @param $token
     *
     * @return \Illuminate\Http\RedirectResponse
     * @auth xiaowei
     * @date 2019/7/8
     * @desc 邮箱验证
     */
    public function confirmEmail($token)
    {
        $user = AdminModel::query()->where('activation_token', $token)->firstOrFail();

        $user->activated = true;
        $user->activation_token = null;
        $user->save();

        Auth::login($user);
        session()->flash('success', '恭喜你，激活成功！');
        return redirect()->route('admin.home');
    }

    
}
