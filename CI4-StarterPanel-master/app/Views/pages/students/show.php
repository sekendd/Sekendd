<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="container mt-5">
    <h2>Student Detail</h2>
    <a href="<?= base_url('students') ?>" class="btn btn-secondary mb-3">Back to List</a>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Name: <?= esc($student['name']) ?></h4>
            <p class="card-text"><strong>Description:</strong> <?= esc($student['description']) ?></p>
            <p class="card-text"><strong>Age:</strong> <?= esc($student['age']) ?></p>
            <p class="card-text"><strong>Course:</strong> <?= esc($student['course']) ?></p>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
