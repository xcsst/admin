<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\CategoryOption;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

/**
 * @Controller(prefix="/category")
 * @Middleware("web")
 * @Middleware("auth")
 * Class CategoryController
 * @package App\Http\Controllers
 */
class CategoryController extends Controller
{
    /**
     * @Get("/", as="category.index")
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $categorys = Category::orderBy('status', 'DESC')->orderBy('sort', 'DESC')->paginate();

        return view('category.index', compact('categorys'));
    }

    /**
     * @Get("/create", as="category.create")
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $categoryArr = $this->_getCategoryList();

        return view('category.create', compact('categoryArr'));
    }

    /**
     * @Post("/create", as="category.doCreate")
     * @param AdRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function doCreate(CategoryRequest $request)
    {
        $data = $request->only('pid', 'name', 'sort', 'status');
        if ($request->hasFile('icon') && $request->file('icon')->isValid()) {
            $data['img'] = $request->icon->store('category', 'public');
        }
        if ($category = Category::create($data)) {
            if ($data['pid'] != 0 && is_array($request->get('option'))) {
                foreach ($request->get('option') as $option) {
                    if ($option) {
                        $optionModel = new CategoryOption(['name' => $option]);
                        $category->options()->save($optionModel);
                    }
                }
            }

            return redirect(route('category.index'));

        } else {
            return back()->withErrors('添加分类失败，请稍后重试');
        }
    }

    /**
     * @Get("/{id}/disable", as="category.disable", where={"id": "[0-9]+"})
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function disable($id)
    {
        if (Category::where('pid', $id)->where('status', 1)->first()) {
            return back()->withErrors('存在正常状态下的子分类，不能禁用该父级分类');
        }

        try {
            $model = Category::findOrFail($id);
            $model->status = -1;
            $model->save();

            return redirect(route('category.index'));
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors('没有查询到对应的分类信息');
        }
    }

    /**
     * @Get("/{id}/enable", as="category.enable", where={"id": "[0-9]+"})
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function enable($id)
    {
        try {
            $model = Category::findOrFail($id);
            if ($model->pid) {
                $pidInfo = Category::find($model->pid);
                if (!$pidInfo) {
                    return back()->withErrors('上级分类不存在');
                }
                if ($pidInfo->status !== 1) {
                    return back()->withErrors('上级分类已冻结，不能启用该分类');
                }
            }

            $model->status = 1;
            $model->save();

            return redirect(route('category.index'));
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors('没有查询到对应的分类信息');
        }
    }

    /**
     * @Get("/{id}", as="category.show", where={"id": "[0-9]+"})
     * @param $id
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        try {
            $category = Category::findOrFail($id);

            return view('category.show', compact('category'));
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors('没有查询到对应的分类信息');
        }
    }

    /**
     * @Get("/{id}/update", as="category.update", where={"id": "[0-9]+"})
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update($id, Request $request)
    {
        try {
            $category = Category::findOrFail($id);

            return view('category.update', compact('category'));
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors('没有查询到对应的分类信息');
        }
    }

    /**
     * @Post("/{id}/update", as="category.doUpdate", where={"id": "[0-9]+"})
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function doUpdate($id, CategoryRequest $request)
    {
        try {
            Category::findOrFail($id);
            $data = $request->only('name', 'sort', 'status');
            if ($request->hasFile('icon') && $request->file('icon')->isValid()) {
                $data['img'] = $request->icon->store('category', 'public');
            }
            if (Category::find($id)->update($data)) {
                $category = Category::find($id);
                $category->options()->delete();
                if (is_array($request->get('option'))) {
                    foreach ($request->get('option') as $option) {
                        if ($option) {
                            $optionModel = new CategoryOption(['name' => $option]);
                            $category->options()->save($optionModel);
                        }
                    }
                }
                return redirect(route('category.index'));
            } else {
                return back()->withErrors('修改分类失败，请稍后重试');
            }
        } catch (ModelNotFoundException $exception) {
            return back()->withErrors('没有查询到对应的分类信息');
        }
    }

    private function _getCategoryList()
    {
        $default = ['顶级分类'];
        $categoryList = Category::select('id', 'name')->where('status', 1)->where('pid', 0)->get();

        return $categoryList ? $default + array_column($categoryList->toArray(), 'name', 'id') : $default;
    }
}
