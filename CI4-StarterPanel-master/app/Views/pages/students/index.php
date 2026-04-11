<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="container mt-5">
    <h2>Student List</h2>
    <?= $this->include('components/alerts'); ?>
    <a href="<?= base_url('students/create') ?>" class="btn btn-success mb-3">Add Student</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Age</th>
                <th>Course</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($students as $student): ?>
            <tr>
                <td><?= esc($student['id']) ?></td>
                <td><a href="<?= base_url('students/show/'.$student['id']) ?>"><?= esc($student['name']) ?></a></td>
                <td><?= esc($student['description']) ?></td>
                <td><?= esc($student['age']) ?></td>
                <td><?= esc($student['course']) ?></td>
                <td>
                    <a href="<?= base_url('students/edit/'.$student['id']) ?>" class="btn btn-primary btn-sm">Edit</a>
                    <form action="<?= base_url('students/delete/'.$student['id']) ?>" method="post" style="display:inline;">
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this student?')">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?= $pager->links() ?>
</div>
<?= $this->endSection() ?>
