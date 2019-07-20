<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class adminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        $routeName = $this->route()->getName();

        switch($routeName) {
            case 'admin.login':
                $rules = [
                    'email'=>'required|email',
                    'password'=>'required|min:6'
                ];
                break;
            case 'admin.signup':
                $rules = [
                    'email'=>'required|email|unique:admin_users',
                    'password'=>'required|min:6',
                    'name'  => 'required|max:8'
                ];
                break;
            case 'admin.forget':
                $rules = [
                    'email'=>'required|email|exists:admin_users',
                ];
                break;
            case 'admin.reset_action':
                $rules = [
                    'password' => 'required',
                    'confirm_password' => 'required|same:password',
                    'token'    => 'required|exists:password_resets'
                ];
                break;

        }

        return $rules;
    }


    public function attributes()
    {
        return [
            'email' => '邮箱',
            'password' => '密码',
            'name'  => '昵称'
        ];
    }

    public function messages()
    {
        return [
            'email.required'    => '邮箱必填！',
            'email.email'       => '请输入邮箱！',
            'email.exists'      => '邮箱不存在！',
            'password.required' => '密码必填！',
            'password.min'      => '密码必须不少于6个字符！',
            'name.required'     => '昵称必填',
            'name.max'          => '昵称不能超过8个字符',
            'confirm_password.required'      => '验证密码必填！',
            'confirm_password.same'          => '验证密码必需和密码一致！',
            'token.required'          => '非法操作！',
        ];
    }
}
