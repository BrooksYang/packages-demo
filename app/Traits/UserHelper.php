<?php

namespace App\Traits;

use Tymon\JWTAuth\Facades\JWTAuth;

trait UserHelper
{
    /**
     * 获取当前用户信息
     *
     * @return mixed
     */
    public function userInfo()
    {
        $user = JWTAuth::parseToken()->authenticate();

        return $user;
    }

    /**
     * 获取当前用户id
     *
     * @return mixed
     */
    public function userId()
    {
        $user = $this->userInfo();

        return $user->id;
    }
}
