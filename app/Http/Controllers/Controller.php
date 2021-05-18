<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $headers_for_forum = [
        'XF-Api-Key' => 'i6R3z6e8k4wkpFyxHY9zxyQri_hlriSz',
        'Content-Type' => 'application/x-www-form-urlencoded'
    ];
}
