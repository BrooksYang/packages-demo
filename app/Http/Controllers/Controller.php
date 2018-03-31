<?php

namespace App\Http\Controllers;

use App\Traits\UserHelper;
use BrooksYang\LaravelApiHelper\Traits\ResponseHelper;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ResponseHelper, UserHelper;
}
