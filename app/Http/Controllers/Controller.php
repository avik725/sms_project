<?php

namespace App\Http\Controllers;

use App\Models\SettingsModel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\View;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs;
    public function __construct()
    {
        // Define a common variable
        $project_data = SettingsModel::first();

        // Share the variable with all views
        View::share('project_data', $project_data);

    }
}
