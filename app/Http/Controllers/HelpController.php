<?php

namespace App\Http\Controllers;

use App\Http\Requests\HelpRequest;
use App\Models\Help;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

/**
 * @Controller(prefix="/help")
 * @Middleware("web")
 * @Middleware("auth")
 * Class HelpController
 * @package App\Http\Controllers
 */
class HelpController extends Controller
{
    /**
     * @Get("/", as="help.index")
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $helps = Help::orderBy('status', 'DESC')->orderBy('sort', 'DESC')->paginate();

        return view('help.index', compact('helps'));
    }

    /**
     * @Get("/create", as="help.create")
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view('help.create');
    }

    /**
     * @Post("/create", as="help.doCreate")
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function doCreate(HelpRequest $request)
    {
        if (Help::create($request->only('question', 'answer', 'sort', 'status'))) {
            return redirect(route('help.index'));
        } else {
            return back()->withErrors('添加帮助信息失败，请稍后重试');
        }
    }

    /**
     * @Get("/{id}/disable", as="help.disable", where={"id": "[0-9]+"})
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function disable($id)
    {
        try {
            $model = Help::findOrFail($id);
            $model->status = -1;
            $model->save();

            return redirect(route('help.index'));
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors('没有查询到对应的帮助信息');
        }
    }

    /**
     * @Get("/{id}/enable", as="help.enable", where={"id": "[0-9]+"})
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function enable($id)
    {
        try {
            $model = Help::findOrFail($id);
            $model->status = 1;
            $model->save();

            return redirect(route('help.index'));
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors('没有查询到对应的帮助信息');
        }
    }

    /**
     * @Get("/{id}", as="help.show", where={"id": "[0-9]+"})
     * @param $id
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        try {
            $help = Help::findOrFail($id);

            return view('help.show', compact('help'));
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors('没有查询到对应的帮助信息');
        }
    }

    /**
     * @Get("/{id}/update", as="help.update", where={"id": "[0-9]+"})
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update($id, Request $request)
    {
        try {
            $help = Help::findOrFail($id);

            return view('help.update', compact('help'));
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors('没有查询到对应的帮助信息');
        }
    }

    /**
     * @Post("/{id}/update", as="help.doUpdate", where={"id": "[0-9]+"})
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function doUpdate($id, HelpRequest $request)
    {
        try {
            Help::findOrFail($id);
            if (Help::find($id)->update($request->only('question', 'answer', 'sort', 'status'))) {
                return redirect(route('help.index'));
            } else {
                return back()->withErrors('修改帮助信息失败，请稍后重试');
            }
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors('没有查询到对应的帮助信息');
        }
    }
}
