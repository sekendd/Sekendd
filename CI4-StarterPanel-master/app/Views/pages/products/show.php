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
    <h2>Product Detail</h2>
    <a href="<?= base_url('products') ?>" class="btn btn-secondary mb-3">Back to List</a>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Name: <?= esc($product['name']) ?></h4>
            <p class="card-text"><strong>SKU:</strong> <?= esc($product['sku']) ?></p>
            <p class="card-text"><strong>Price:</strong> <?= esc($product['price']) ?></p>
            <p class="card-text"><strong>Stock:</strong> <?= esc($product['stock']) ?></p>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
</body>
</html>
