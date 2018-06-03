<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdRequest;
use App\Http\Requests\AdUpdateRequest;
use App\Models\Ad;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

/**
 * @Controller(prefix="/ad")
 * @Middleware("web")
 * @Middleware("auth")
 * Class AdController
 * @package App\Http\Controllers
 */
class AdController extends Controller
{
    /**
     * @Get("/", as="ad.index")
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $ads = Ad::orderBy('status', 'DESC')->orderBy('sort', 'DESC')->paginate();

        return view('ad.index', compact('ads'));
    }

    /**
     * @Get("/create", as="ad.create")
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view('ad.create');
    }

    /**
     * @Post("/create", as="ad.doCreate")
     * @param AdRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function doCreate(AdRequest $request)
    {
        if ($request->hasFile('pic') && $request->file('pic')->isValid()) {
            $data = $request->only('type', 'title', 'target_url', 'sort', 'status');
            $data['img'] = $request->pic->store('ad', 'public');
            if (Ad::create($data)) {
                return redirect(route('ad.index'));
            } else {
                return back()->withErrors('添加广告失败，请稍后重试');
            }
        }

        return back()->withErrors('请选择正确的图片上传');
    }

    /**
     * @Get("/{id}/disable", as="ad.disable", where={"id": "[0-9]+"})
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function disable($id)
    {
        try {
            $model = Ad::findOrFail($id);
            $model->status = -1;
            $model->save();

            return redirect(route('ad.index'));
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors('没有查询到对应的广告信息');
        }
    }

    /**
     * @Get("/{id}/enable", as="ad.enable", where={"id": "[0-9]+"})
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function enable($id)
    {
        try {
            $model = Ad::findOrFail($id);
            $model->status = 1;
            $model->save();

            return redirect(route('ad.index'));
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors('没有查询到对应的广告信息');
        }
    }

    /**
     * @Get("/{id}", as="ad.show", where={"id": "[0-9]+"})
     * @param $id
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        try {
            $ad = Ad::findOrFail($id);

            return view('ad.show', compact('ad'));
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors('没有查询到对应的广告信息');
        }
    }

    /**
     * @Get("/{id}/update", as="ad.update", where={"id": "[0-9]+"})
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update($id, Request $request)
    {
        try {
            $ad = Ad::findOrFail($id);

            return view('ad.update', compact('ad'));
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors('没有查询到对应的广告信息');
        }
    }

    /**
     * @Post("/{id}/update", as="ad.doUpdate", where={"id": "[0-9]+"})
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function doUpdate($id, AdUpdateRequest $request)
    {
        try {
            Ad::findOrFail($id);
            $data = $request->only('type', 'title', 'target_url', 'sort', 'status');
            if ($request->hasFile('pic') && $request->file('pic')->isValid()) {
                $data['img'] = $request->pic->store('ad', 'public');
            }

            if (Ad::find($id)->update($data)) {
                return redirect(route('ad.index'));
            } else {
                return back()->withErrors('修改广告失败，请稍后重试');
            }
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors('没有查询到对应的广告信息');
        }
    }
}
