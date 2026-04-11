            // Hard-delete: This will permanently remove the record from the database.
            public function delete($id)
            {
                $model = new \App\Models\ProductModel();
                $product = $model->find($id);
                if (!$product) {
                    session()->setFlashdata('notif_error', 'Product not found.');
                    return redirect()->to(base_url('products'));
                }
                if ($model->delete($id)) {
                    session()->setFlashdata('notif_success', 'Product deleted successfully!');
                } else {
                    session()->setFlashdata('notif_error', 'Failed to delete product.');
                }
                return redirect()->to(base_url('products'));
            }
        public function edit($id)
        {
            $model = new \App\Models\ProductModel();
            $product = $model->find($id);
            if (!$product) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Product not found');
            }
            $data = [
                'title' => 'Edit Product',
                'product' => $product,
                'validation' => $this->validation,
                'old' => $this->request->getPost() ?: $product,
            ];
            return view('pages/products/edit', $data);
        }

        public function update($id)
        {
            $rules = [
                'name' => 'required|min_length[3]',
                'sku' => 'required|alpha_numeric',
                'price' => 'required|decimal',
                'stock' => 'required|integer',
            ];
            $model = new \App\Models\ProductModel();
            $product = $model->find($id);
            if (!$product) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Product not found');
            }
            if (!$this->validate($rules)) {
                return view('pages/products/edit', [
                    'title' => 'Edit Product',
                    'product' => $product,
                    'validation' => $this->validation,
                    'old' => $this->request->getPost(),
                ]);
            }
            $updateData = [
                'name' => $this->request->getVar('name'),
                'sku' => $this->request->getVar('sku'),
                'price' => $this->request->getVar('price'),
                'stock' => $this->request->getVar('stock'),
            ];
            $model->update($id, $updateData);
            session()->setFlashdata('notif_success', 'Product updated successfully!');
            return redirect()->to(base_url('products'));
        }
    public function index()
    {
        $model = new \App\Models\ProductModel();
        $data = [
            'title' => 'Product List',
            'products' => $model->paginate(10),
            'pager' => $model->pager,
        ];
        return view('pages/products/index', $data);
    }

    public function show($id)
    {
        $model = new \App\Models\ProductModel();
        $product = $model->find($id);
        if (!$product) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Product not found');
        }
        return view('pages/products/show', [
            'title' => 'Product Detail',
            'product' => $product,
        ]);
    }
<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ApplicationModel;

class Products extends BaseController
{
    public function create()
    {
        $data = [
            'title' => 'Create Product',
            'validation' => $this->validation,
            'old' => $this->request->getPost(),
        ];
        return view('pages/products/create', $data);
    }

    public function store()
    {
        $rules = [
            'name' => 'required|min_length[3]',
            'sku' => 'required|alpha_numeric',
            'price' => 'required|decimal',
            'stock' => 'required|integer',
        ];
        if (!$this->validate($rules)) {
            return view('pages/products/create', [
                'title' => 'Create Product',
                'validation' => $this->validation,
                'old' => $this->request->getPost(),
            ]);
        }
        $productData = [
            'name' => $this->request->getVar('name'),
            'sku' => $this->request->getVar('sku'),
            'price' => $this->request->getVar('price'),
            'stock' => $this->request->getVar('stock'),
        ];
        $model = new ApplicationModel();
        $model->createProduct($productData);
        session()->setFlashdata('notif_success', 'Product created successfully!');
        return redirect()->to(base_url('products'));
    }
}
