<?php

namespace UdaraJay\Dunbar\Http\Controllers;

use Dunbar;
use Request;
use Illuminate\Routing\Controller;

class RequestController extends Controller
{
    public function handle($url = ''){
        return Dunbar::makeRequest(Request::method(), Request::all(), $url);
    }
}
