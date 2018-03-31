<?php

namespace App\Http\Controllers\Demo;

use App\Constants\ErrorCode;
use App\Http\Requests\Demo\RegisterRequest;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Tymon\JWTAuth\Facades\JWTAuth;

class DemoController extends Controller
{
    /**
     * 用户登录
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        // 获取参数
        $email = Input::get('email'); // 邮箱
        $password = Input::get('password'); //密码

        // 验证账户
        $token = JWTAuth::attempt(compact('email', 'password'));
        if (empty($token)) {
            return $this->errorResponse(ErrorCode::ACCOUNT_INVALID);
        }

        // 返回当前登录用户信息
        JWTAuth::setToken($token);
        $user = JWTAuth::toUser();

        // 认证成功，返回token
        return $this->jsonResponse(compact('user', 'token'));
    }

    /**
     * 用户注册
     *
     * @param RegisterRequest $request
     * @return mixed
     */
    public function register(RegisterRequest $request)
    {
        // 获取参数
        $name = $request->input('name'); // 用户名
        $email = $request->input('email'); // 邮箱
        $password = bcrypt($request->input('password')); // 密码

        // 注册用户
        $user = User::create(compact('name', 'email', 'password'));

        // 生成token
        $token = JWTAuth::fromUser($user);

        return $this->jsonResponse(compact('user', 'token'));
    }

    /**
     * 刷新token
     *
     * @return mixed
     */
    public function refresh()
    {
        // 判断是否提供原始token
        $old = JWTAuth::getToken();
        if (empty($old)) {
            return $this->errorResponse(ErrorCode::TOKEN_NOT_PROVIDED);
        }

        // 刷新token
        $token = JWTAuth::refresh($old);

        return $this->jsonResponse(compact('token'));
    }

    /**
     * 用户信息
     *
     * @return string
     */
    public function test()
    {
        $user = $this->userInfo();
        $userId = $this->userId();

        return $this->jsonResponse($user);
    }

    /**
     * 用户退出
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return $this->msgResponse('已退出');
    }

    /**
     * AES解密测试
     */
    public function aesDecrypt()
    {
        $data = Input::get('secret');

        $text = config('conf.encrypt_key');
        $key = md5($text);
        $iv='1234567812345678';
        $data = base64_decode(str_replace(' ', '+', $data));
        $decode = openssl_decrypt($data, 'AES-256-CBC', $key, 1, $iv);

        return $this->jsonResponse(compact('secret', 'decode'));
    }

    /**
     * AES加密测试
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function aesEncrypt()
    {
        $data = Input::get('data'); // 加密数据

        $key = utf8_encode(md5($data));
        $iv='1234567812345678';
        $secret = openssl_encrypt($data, 'AES-256-CBC', $key, 0, $iv);
        $decode = openssl_decrypt(base64_decode(str_replace(' ', '+', $secret)), 'AES-256-CBC', md5($data), 1, $iv);

        return $this->jsonResponse(compact('secret', 'decode'));
    }

    /**
     * 文件上传
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request)
    {
        $upload = $request->file('upload'); // 上传文件
        $path = $request->input('path') ?: 'public/demo'; // 文件存放路径，默认public/demo
        $file = '';
        if (!empty($upload)) {
            $file = $upload->store($path);
            $file = str_replace('public', 'storage', $file);
        }

        return $this->jsonResponse($file);
    }
}
