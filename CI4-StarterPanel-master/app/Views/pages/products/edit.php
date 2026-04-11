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
    <h2>Edit Product</h2>
    <?= $this->include('components/alerts'); ?>
    <form action="<?= base_url('products/update/'.$product['id']) ?>" method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= isset($old['name']) ? esc($old['name']) : '' ?>">
            <?php if (isset($validation) && $validation->hasError('name')): ?>
                <div class="text-danger small"> <?= $validation->getError('name'); ?> </div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="sku" class="form-label">SKU</label>
            <input type="text" class="form-control" id="sku" name="sku" value="<?= isset($old['sku']) ? esc($old['sku']) : '' ?>">
            <?php if (isset($validation) && $validation->hasError('sku')): ?>
                <div class="text-danger small"> <?= $validation->getError('sku'); ?> </div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="text" class="form-control" id="price" name="price" value="<?= isset($old['price']) ? esc($old['price']) : '' ?>">
            <?php if (isset($validation) && $validation->hasError('price')): ?>
                <div class="text-danger small"> <?= $validation->getError('price'); ?> </div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" class="form-control" id="stock" name="stock" value="<?= isset($old['stock']) ? esc($old['stock']) : '' ?>">
            <?php if (isset($validation) && $validation->hasError('stock')): ?>
                <div class="text-danger small"> <?= $validation->getError('stock'); ?> </div>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="<?= base_url('products') ?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<?= $this->endSection() ?>
</body>
</html>
