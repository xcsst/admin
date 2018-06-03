<?php

namespace App\Http\Controllers;

use App\Http\Requests\Notice\CreateRequest;
use App\Http\Requests\Notice\UpdateRequest;
use App\Models\Notice;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

/**
 * @Controller(prefix="/notice")
 * @Middleware("web")
 * @Middleware("auth")
 * Class NoticeController
 * @package App\Http\Controllers
 */
class NoticeController extends Controller
{
    /**
     * @Get("/", as="notice.index")
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $notices = Notice::orderBy('status', 'DESC')->orderBy('sort', 'DESC')->paginate();

        return view('notice.index', compact('notices'));
    }

    /**
     * @Get("/create", as="notice.create")
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view('notice.create');
    }

    /**
     * @Post("/create", as="notice.doCreate")
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function doCreate(CreateRequest $request)
    {
        if (Notice::create($request->only('title', 'content', 'sort', 'status'))) {
            return redirect(route('notice.index'));
        } else {
            return back()->withErrors('添加公告失败，请稍后重试');
        }
    }

    /**
     * @Get("/{id}/disable", as="notice.disable", where={"id": "[0-9]+"})
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function disable($id)
    {
        try {
            $model = Notice::findOrFail($id);
            $model->status = -1;
            $model->save();

            return redirect(route('notice.index'));
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors('没有查询到对应的公告信息');
        }
    }

    /**
     * @Get("/{id}/enable", as="notice.enable", where={"id": "[0-9]+"})
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function enable($id)
    {
        try {
            $model = Notice::findOrFail($id);
            $model->status = 1;
            $model->save();

            return redirect(route('notice.index'));
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors('没有查询到对应的公告信息');
        }
    }

    /**
     * @Get("/{id}", as="notice.show", where={"id": "[0-9]+"})
     * @param $id
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        try {
            $notice = Notice::findOrFail($id);

            return view('notice.show', compact('notice'));
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors('没有查询到对应的公告信息');
        }
    }

    /**
     * @Get("/{id}/update", as="notice.update", where={"id": "[0-9]+"})
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update($id, Request $request)
    {
        try {
            $notice = Notice::findOrFail($id);

            return view('notice.update', compact('notice'));
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors('没有查询到对应的公告信息');
        }
    }

    /**
     * @Post("/{id}/update", as="notice.doUpdate", where={"id": "[0-9]+"})
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function doUpdate($id, UpdateRequest $request)
    {
        try {
            Notice::findOrFail($id);
            if (Notice::find($id)->update($request->only('title', 'content', 'sort', 'status'))) {
                return redirect(route('notice.index'));
            } else {
                return back()->withErrors('修改公告失败，请稍后重试');
            }
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors('没有查询到对应的公告信息');
        }
    }
}
