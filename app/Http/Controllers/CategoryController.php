<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    public function __construct(
        protected CategoryRepository $repository
    ) {
        parent::__construct();
    }
    // category table DB show to admin category list page
    public function index()
    {
        // will show on url to see correct current page
        $this->data['page']['title'] = 'Categories';

        $this->data['categories'] = $this->repository->getAll();

        return view('admin.categories.index', $this->data);
    }

    // admin add new category
    public function create()
    {
        $this->data['page']['title'] = 'New Category';

        return view('admin.categories.add', $this->data);
    }

    // category added to DB table
    public function store(CategoryRequest $request)
    {
        $data = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ];

        // return to admin category list page
        if ($this->repository->create($data)) {
            return redirect('admin/categories')->with('message', 'Category created successfully');
        }

        return redirect('admin/categories/add');
    }
    
    // edit category
    public function edit(int $id)
    {
        $this->data['page']['title'] = 'Edit Category';

        $this->data['category'] = $this->repository->getById($id);

        return view('admin.categories.edit', $this->data);
    }

    // confirm edit-update category
    public function update(CategoryRequest $request, int $id)
    {
        $data = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ];

        if ($this->repository->update($id, $data)) {
            return redirect('admin/categories')->with('message', 'Category updated successfully');
        }

        return redirect('admin/categories/' . $id);
    }
}