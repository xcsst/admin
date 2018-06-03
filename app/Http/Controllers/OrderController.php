<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

/**
 * @Controller(prefix="/order")
 * @Middleware("web")
 * @Middleware("auth")
 * Class OrderController
 * @package App\Http\Controllers
 */
class OrderController extends Controller
{
    public function __construct(Order $order)
    {
        $this->model = $order;
    }

    /**
     * @Get("/", as="order.index")
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $orders = $this->_getOrderList(1);

        return view('order.index', compact('orders'));
    }

    /**
     * @Get("/release", as="order.release")
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function release(Request $request)
    {
        $orders = $this->_getOrderList(2);

        return view('order.index', compact('orders'));
    }

    /**
     * @Get("/servicing", as="order.servicing")
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function servicing(Request $request)
    {
        $orders = $this->_getOrderList(10);

        return view('order.index', compact('orders'));
    }

    /**
     * @Get("/paying", as="order.paying")
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function paying(Request $request)
    {
        $orders = $this->_getOrderList(10);

        return view('order.index', compact('orders'));
    }

    /**
     * @Get("/success", as="order.success")
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function success(Request $request)
    {
        $orders = $this->_getOrderList(10);

        return view('order.index', compact('orders'));
    }

    /**
     * @Get("/cancel", as="order.cancel")
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cancel(Request $request)
    {
        $orders = $this->_getOrderList(10);

        return view('order.index', compact('orders'));
    }

    private function _getOrderList($status = 1)
    {
        return $this->model->where('status', $status)->orderBy('sort', 'DESC')->orderBy('id', 'DESC')->paginate();
    }
}
