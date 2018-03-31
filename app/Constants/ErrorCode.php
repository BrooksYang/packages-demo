<?php

namespace App\Constants;

class ErrorCode
{
    /**
     * 系统错误 1 - 1000
     */

    // TOKEN
    const TOKEN_NOT_PROVIDED = ['code' => 1, 'msg' => '未提供token'];
    const TOKEN_INVALID = ['code' => 2, 'msg' => '无效的token'];
    const TOKEN_EXPIRED = ['code' => 3, 'msg' => 'token已过期'];
    const TOKEN_COULD_NOT_CREATE = ['code' => 4, 'msg' => '无法生成token'];

    // 参数
    const VALIDATION_FAILED = ['code' => 11, 'msg' => '表单验证失败'];
    const OPERATION_NOT_ALLOWED = ['code' => 12, 'msg' => '无权限操作'];
    const ID_IS_REQUIRED = ['code' => 13, 'msg' => '此接口ID参数为必填项'];
    const OBJECT_NOT_FOUND = ['code' => 14, 'msg' => '该对象不存在'];
    const CONFIG_ERROR = ['code' => 15, 'msg' => '配置错误，配置了不存在的选项'];

    // 非法错误
    const PARAM_ILLEGAL = ['code' => 21, 'msg' => '非法参数'];
    const NAME_ILLEGAL = ['code' => 22, 'msg' => '名称不合法'];
    const OPERATION_ILLEGAL = ['code' => 23, 'msg' => '非法操作'];

    // 操作错误
    const OPERATION_FAILED = ['code' => 31, 'msg' => '操作失败'];
    const ADD_FAILED = ['code' => 32, 'msg' => '添加失败'];
    const EDIT_FAILED = ['code' => 33, 'msg' => '修改失败'];
    const DELETE_FAILED = ['code' => 34, 'msg' => '删除失败'];

    // 数据库异常
    const CONNECT_FAILED = ['code' => 41, 'msg' => '网络连接失败，请稍后再试'];

    /**
     * 用户认证模块 100000 - 109999
     */
    const ACCOUNT_INVALID = ['code' => 100001, 'msg' => '账户不可用'];
    const USER_NOT_FOUND = ['code' => 100002, 'msg' => '该用户不存在'];
    const SUPER_USER_DELETE_FORBIDDEN = ['code' => 100002, 'msg' => '超级管理员无法删除'];
    const PASSWORD_RESET_FAILED = ['code' => 100003, 'msg' => '重置密码失败'];
    const PASSWORD_RESET = ['code' => 100004, 'msg' => '该邮箱已验证'];
    const SIGNATURE_INVALID = ['code' => 100005, 'msg' => '签名错误'];
    const ACCOUNT_NOT_FOUND = ['code' => 100006, 'msg' => '账号或密码错误'];
    const ANOTHER_LOGIN = ['code' => 100007, 'msg' => '您的账号已在别处登录'];
    const OLD_PASSWORD_ERROR = ['code' => 100008, 'msg' => '登陆密码错误'];
    const USER_VERIFYED = ['code' => 100009, 'msg' => '用户已经通过任务'];
    const USER_NOT_VERIFIED = ['code' => 100010, 'msg' => '未实名认证'];

    /**
     * 系统配置模块 110000 - 119999
     */

    /**
     * 项目模块 120000 - 129999
     */
    const PROJECT_NOT_FOUND = ['code' => 120001, 'msg' => '项目不存在'];
    const PROJECT_AMOUNT_NOT_ENOUGH = ['code' => 120002, 'msg' => '项目认购额度不足'];
    const PROJECT_IN_PROGRESS_OR_ENDED = ['code' => 120003, 'msg' => '项目进行中或已结束'];
    const AMOUNT_EXCEED_THE_LIMIT = ['code' => 120004, 'msg' => '认购额度超限'];
    const CURRENCY_NOT_FOUND = ['code' => 120011, 'msg' => '代币不存在'];
    const WALLET_NOT_FOUND = ['code' => 120021, 'msg' => '钱包不存在'];
    const ALREADY_HAVE_PRIMARY_WALLET = ['code' => 120022, 'msg' => '已有主钱包地址'];
    const ORDER_NOT_FOUND = ['code' => 120031, 'msg' => '订单不存在'];
    const WITHDRAW_NOT_FOUND = ['code' => 120041, 'msg' => '提币信息不存在'];

    /**
     * 聊天模块 130000 - 139999
     */
    const TWILIO_USER_ALREADY_EXISTS = ['code' => 130001, 'msg' => 'Twilio用户已存在'];
    const TWILIO_USER_NOT_EXISTS = ['code' => 130002, 'msg' => 'Twilio用户不存在'];
    const CHANNEL_ALREADY_EXISTS = ['code' => 130003, 'msg' => '系统中已存在Channel'];
    const ALREADY_IN_CHANNEL = ['code' => 130004, 'msg' => '您已在该频道中，无法重复加入'];
    const TWILIO_USER_CREATE_FAILED = ['code' => 130005, 'msg' => '无法创建用户，或用户已存在，请稍后再试'];
}
