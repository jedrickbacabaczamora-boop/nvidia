<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Package;
use App\Models\Purchase;
use App\Models\User;
use App\Models\UserLedger;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
