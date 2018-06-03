<?php

namespace App\Http\Controllers;

use App\Http\Requests\WaiterRequest;
use App\Models\Category;
use App\Models\User;
use App\Models\UserCategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * @Controller(prefix="/waiter")
 * @Middleware("web")
 * @Middleware("auth")
 * Class WaiterController
 * @package App\Http\Controllers
 */
class WaiterController extends Controller
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * @Get("/", as="waiter.index")
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $waiters = $this->model->waiter()->orderBy('status', 'DESC')->paginate();

        return view('waiter.index', compact('waiters'));
    }

    /**
     * @Get("/create", as="waiter.create")
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $categoryArr = $this->_getCategoryList();
        if (!$categoryArr) {
            return back()->withErrors('没有对应服务项目，请先添加服务项目');
        }

        return view('waiter.create', compact('categoryArr'));
    }

    /**
     * @Post("/create", as="waiter.doCreate")
     * @param AdRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function doCreate(WaiterRequest $request)
    {
        $data = $request->only('nickname', 'username');
        $data['password'] = Hash::make($request->get('password'));
        $data['type'] = 2;
        if ($user = User::create($data)) {
            if (is_array($request->get('category'))) {
                foreach ($request->get('category') as $category) {
                    $optionModel = new UserCategory(['category_id' => $category]);
                    $user->categorys()->save($optionModel);
                }
            }

            return redirect(route('waiter.index'));

        } else {
            return back()->withErrors('添加服务人员失败，请稍后重试');
        }
    }

    /**
     * @Get("/{id}/disable", as="waiter.disable", where={"id": "[0-9]+"})
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function disable($id)
    {
        try {
            $model = $this->model->waiter()->findOrFail($id);
            $model->status = -1;
            $model->save();

            return redirect(route('waiter.index'));
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors('没有查询到对应的服务人员信息');
        }
    }

    /**
     * @Get("/{id}/enable", as="waiter.enable", where={"id": "[0-9]+"})
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function enable($id)
    {
        try {
            $model = $this->model->waiter()->findOrFail($id);
            $model->status = 1;
            $model->save();

            return redirect(route('waiter.index'));
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors('没有查询到对应的服务人员信息');
        }
    }

    /**
     * @Get("/{id}", as="waiter.show", where={"id": "[0-9]+"})
     * @param $id
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        try {
            $user = $this->model->waiter()->findOrFail($id);

            return view('waiter.show', compact('user'));
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors('没有查询到对应的服务人员信息');
        }
    }

    /**
     * @Get("/{id}/update", as="waiter.update", where={"id": "[0-9]+"})
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update($id, Request $request)
    {
        try {
            $user = $this->model->waiter()->findOrFail($id);
            $categoryArr = $this->_getCategoryList();
            $serviceItems = $user->categorys->toArray();
            $serviceItems = count($serviceItems) ? array_column($serviceItems, 'category_id') : [];

            return view('waiter.update', compact('user', 'serviceItems', 'categoryArr'));
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors('没有查询到对应的服务人员信息');
        }
    }

    /**
     * @Post("/{id}/update", as="waiter.doUpdate", where={"id": "[0-9]+"})
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function doUpdate($id, WaiterRequest $request)
    {
        try {
            $user = $this->model->waiter()->findOrFail($id);
            $data = $request->only('nickname', 'username');
            $data['password'] = Hash::make($request->get('password'));
            $user->categorys()->delete();
            if ($user->update($data)) {
                if (is_array($request->get('category'))) {
                    foreach ($request->get('category') as $category) {
                        $optionModel = new UserCategory(['category_id' => $category]);
                        $user->categorys()->save($optionModel);
                    }
                }

                return redirect(route('waiter.index'));

            } else {
                return back()->withErrors('修改服务人员失败，请稍后重试');
            }
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors('没有查询到对应的分类信息');
        }
    }

    private function _getCategoryList()
    {
        $data = Category::where('pid', '>', 0)->where('status', 1)->get();

        return array_column($data->toArray(), 'name', 'id');
    }
}
