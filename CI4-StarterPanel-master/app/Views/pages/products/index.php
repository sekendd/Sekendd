<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="container mt-5">
    <h2>Product List</h2>
    <?= $this->include('components/alerts'); ?>
    <a href="<?= base_url('products/create') ?>" class="btn btn-success mb-3">Add Product</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>SKU</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= esc($product['id']) ?></td>
                <td><a href="<?= base_url('products/show/'.$product['id']) ?>"><?= esc($product['name']) ?></a></td>
                <td><?= esc($product['sku']) ?></td>
                <td><?= esc($product['price']) ?></td>
                <td><?= esc($product['stock']) ?></td>
                <td>
                    <a href="<?= base_url('products/edit/'.$product['id']) ?>" class="btn btn-primary btn-sm">Edit</a>
                    <form action="<?= base_url('products/delete/'.$product['id']) ?>" method="post" style="display:inline;">
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?= $pager->links() ?>
</div>
<?= $this->endSection() ?>
</body>
</html>
