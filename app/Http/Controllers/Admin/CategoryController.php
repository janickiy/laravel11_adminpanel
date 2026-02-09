<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\CategoryRepository;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\EditRequest;
use App\Http\Requests\Admin\Category\DeleteRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Exception;

class CategoryController extends Controller
{
    public function __construct(
        private CategoryRepository $categoryRepository,
    )
    {
        parent::__construct();
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view('admin.category.index')->with('title', 'Категория подписчиков');
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('admin.category.create_edit')->with('title', 'Добавление категории');
    }

    /**
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        try {
            $this->categoryRepository->create($request->all());
        } catch (Exception $e) {
            report($e);

            return redirect()
                ->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }

        return redirect()->route('admin.category.index')->with('success', 'Информация успешно добавлена');
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $row = $this->categoryRepository->find($id);

        if (!$row) abort(404);

        return view('admin.category.create_edit', compact('row'))->with('title', 'Редактирование категории');
    }

    /**
     * @param EditRequest $request
     * @return RedirectResponse
     */
    public function update(EditRequest $request): RedirectResponse
    {
        try {
            $this->categoryRepository->update($request->id, $request->all());
        } catch (Exception $e) {
            report($e);

            return redirect()
                ->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }

        return redirect()->route('admin.category.index')->with('success', 'Данные обновлены');
    }

    /**
     * @param DeleteRequest $request
     * @return void
     */
    public function destroy(DeleteRequest $request): void
    {
        $this->categoryRepository->delete($request->id);
    }
}
