<?php

namespace App\Http\Requests\Demo;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
        return [
            'name'     => 'required|alpha_dash',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'     => '用户名不能为空',
            'name.alpha_dash'   => '用户名仅支持字母或数字',
            'email.required'    => '邮箱不能为空',
            'email.email'       => '邮箱格式不正确',
            'email.unique'      => '该邮箱已注册',
            'password.required' => '密码不能为空',
            'password.min'      => '密码至少为6个字符',
        ];
    }
}
