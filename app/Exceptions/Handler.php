<?php

namespace App\Exceptions;

use App\Constants\ErrorCode;
use BrooksYang\LaravelApiHelper\Traits\ResponseHelper;
use Exception;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\ValidationException;
use PDOException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class Handler extends ExceptionHandler
{
    use ResponseHelper;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param Exception $exception
     * @return mixed
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        $res = parent::report($exception);

        return $res;
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param Exception $exception
     * @return $this|\Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Exception $exception)
    {
        // 数据库查询异常处理
        if ($exception instanceof QueryException && App::environment() == 'production') {
            return $this->errorResponse(ErrorCode::CONNECT_FAILED);
        }

        // 数据库PDO连接异常处理
        if ($exception instanceof PDOException && App::environment() == 'production') {
            return $this->errorResponse(ErrorCode::CONNECT_FAILED);
        }

        // JWT token不正确
        if ($exception instanceof UnauthorizedHttpException) {
            return $this->errorResponse(ErrorCode::TOKEN_INVALID);
        }

        // JWT token过期处理
        if ($exception instanceof TokenExpiredException) {
            return $this->errorResponse(ErrorCode::TOKEN_EXPIRED);
        }

        // JWT 异常处理
        if ($exception instanceof TokenInvalidException) {
            return $this->errorResponse(ErrorCode::TOKEN_INVALID);
        }

        // JWT 无法生成token
        if ($exception instanceof JWTException) {
            return $this->errorResponse(ErrorCode::TOKEN_COULD_NOT_CREATE);
        }

        // 表单验证异常处理
        if ($exception instanceof ValidationException) {
            return response()->json(['code' => 11, 'msg' => Arr::first($exception->errors())[0], 'data' => null]);
        }

        // Guzzle Request
        if ($exception instanceof RequestException) {
            return back()->with('params', $exception->getMessage())->withInput();
        }

        return parent::render($request, $exception);
    }
}
