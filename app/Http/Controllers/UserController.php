<?php

namespace App\Http\Controllers;

use App\Http\Requests\WaiterRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * @Controller(prefix="/user")
 * @Middleware("web")
 * @Middleware("auth")
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * @Get("/", as="user.index")
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $users = $this->model->user()->orderBy('status', 'DESC')->paginate();

        return view('user.index', compact('users'));
    }

    /**
     * @Get("/create", as="user.create")
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view('user.create');
    }

    /**
     * @Post("/create", as="user.doCreate")
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function doCreate(WaiterRequest $request)
    {
        $data = $request->only('nickname', 'username');
        $data['password'] = Hash::make($request->get('password'));
        if ($this->model->create($data)) {
            return redirect(route('user.index'));
        } else {
            return back()->withErrors('添加用户失败，请稍后重试');
        }
    }

    /**
     * @Get("/{id}/disable", as="user.disable", where={"id": "[0-9]+"})
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function disable($id)
    {
        try {
            $model = $this->model->user()->findOrFail($id);
            $model->status = -1;
            $model->save();

            return redirect(route('user.index'));
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors('没有查询到对应的用户信息');
        }
    }

    /**
     * @Get("/{id}/enable", as="user.enable", where={"id": "[0-9]+"})
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function enable($id)
    {
        try {
            $model = $this->model->user()->findOrFail($id);
            $model->status = 1;
            $model->save();

            return redirect(route('user.index'));
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors('没有查询到对应的用户信息');
        }
    }

    /**
     * @Get("/{id}", as="user.show", where={"id": "[0-9]+"})
     * @param $id
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        try {
            $user = $this->model->user()->findOrFail($id);

            return view('user.show', compact('user'));
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors('没有查询到对应的用户信息');
        }
    }

    /**
     * @Get("/{id}/update", as="user.update", where={"id": "[0-9]+"})
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update($id, Request $request)
    {
        try {
            $user = $this->model->user()->findOrFail($id);

            return view('user.update', compact('user'));
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors('没有查询到对应的用户信息');
        }
    }

    /**
     * @Post("/{id}/update", as="user.doUpdate", where={"id": "[0-9]+"})
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function doUpdate($id, WaiterRequest $request)
    {
        try {
            $user = $this->model->user()->findOrFail($id);
            $data = $request->only('nickname', 'username');
            $data['password'] = Hash::make($request->get('password'));
            if ($user->update($data)) {
                return redirect(route('user.index'));
            } else {
                return back()->withErrors('修改用户信息失败，请稍后重试');
            }
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors('没有查询到对应的用户信息');
        }
    }
}
