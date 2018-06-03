<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;

/**
 * @Controller(prefix="/config")
 * @Middleware("web")
 * @Middleware("auth")
 * Class ConfigController
 * @package App\Http\Controllers
 */
class ConfigController extends Controller
{
    public function __construct(Config $config)
    {
        $this->model = $config;
    }

    /**
     * @Get("/", as="config.index")
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $configs = $this->model->all();

        return view('config.index', compact('configs'));
    }
}
