<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * @Controller(prefix="/")
 * @Middleware("web")
 * @Middleware("auth")
 * Class IndexController
 * @package App\Http\Controllers
 */
class IndexController extends Controller
{
    /**
     * @Get("/", as="index.index")
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('index.index');
    }
}
