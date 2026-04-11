<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="container mt-5">
    <h2>Edit Student</h2>
    <?= $this->include('components/alerts'); ?>
    <form action="<?= base_url('students/update/'.$student['id']) ?>" method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= isset($old['name']) ? esc($old['name']) : '' ?>">
            <?php if (isset($validation) && $validation->hasError('name')): ?>
                <div class="text-danger small"> <?= $validation->getError('name'); ?> </div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" name="description" value="<?= isset($old['description']) ? esc($old['description']) : '' ?>">
            <?php if (isset($validation) && $validation->hasError('description')): ?>
                <div class="text-danger small"> <?= $validation->getError('description'); ?> </div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="age" class="form-label">Age</label>
            <input type="number" class="form-control" id="age" name="age" value="<?= isset($old['age']) ? esc($old['age']) : '' ?>">
            <?php if (isset($validation) && $validation->hasError('age')): ?>
                <div class="text-danger small"> <?= $validation->getError('age'); ?> </div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="course" class="form-label">Course</label>
            <input type="text" class="form-control" id="course" name="course" value="<?= isset($old['course']) ? esc($old['course']) : '' ?>">
            <?php if (isset($validation) && $validation->hasError('course')): ?>
                <div class="text-danger small"> <?= $validation->getError('course'); ?> </div>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="<?= base_url('students') ?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<?= $this->endSection() ?>
