<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StudentModel;

class Students extends BaseController
{
    public function index()
    {
        $model = new StudentModel();
        $data = [
            'title' => 'Student List',
            'students' => $model->paginate(10),
            'pager' => $model->pager,
        ];
        return view('pages/students/index', $data);
    }

    public function show($id)
    {
        $model = new StudentModel();
        $student = $model->find($id);
        if (!$student) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Student not found');
        }
        return view('pages/students/show', [
            'title' => 'Student Detail',
            'student' => $student,
        ]);
    }

    public function create()
    {
        $data = [
            'title' => 'Create Student',
            'validation' => $this->validation,
            'old' => $this->request->getPost(),
        ];
        return view('pages/students/create', $data);
    }

    public function store()
    {
        $rules = [
            'name' => 'required|min_length[3]',
            'description' => 'required',
            'age' => 'required|integer',
            'course' => 'required',
        ];
        if (!$this->validate($rules)) {
            return view('pages/students/create', [
                'title' => 'Create Student',
                'validation' => $this->validation,
                'old' => $this->request->getPost(),
            ]);
        }
        $studentData = [
            'name' => $this->request->getVar('name'),
            'description' => $this->request->getVar('description'),
            'age' => $this->request->getVar('age'),
            'course' => $this->request->getVar('course'),
        ];
        $model = new StudentModel();
        $model->save($studentData);
        session()->setFlashdata('notif_success', 'Student created successfully!');
        return redirect()->to(base_url('students'));
    }

    public function edit($id)
    {
        $model = new StudentModel();
        $student = $model->find($id);
        if (!$student) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Student not found');
        }
        $data = [
            'title' => 'Edit Student',
            'student' => $student,
            'validation' => $this->validation,
            'old' => $this->request->getPost() ?: $student,
        ];
        return view('pages/students/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'name' => 'required|min_length[3]',
            'description' => 'required',
            'age' => 'required|integer',
            'course' => 'required',
        ];
        $model = new StudentModel();
        $student = $model->find($id);
        if (!$student) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Student not found');
        }
        if (!$this->validate($rules)) {
            return view('pages/students/edit', [
                'title' => 'Edit Student',
                'student' => $student,
                'validation' => $this->validation,
                'old' => $this->request->getPost(),
            ]);
        }
        $updateData = [
            'name' => $this->request->getVar('name'),
            'description' => $this->request->getVar('description'),
            'age' => $this->request->getVar('age'),
            'course' => $this->request->getVar('course'),
        ];
        $model->update($id, $updateData);
        session()->setFlashdata('notif_success', 'Student updated successfully!');
        return redirect()->to(base_url('students'));
    }

    // Hard-delete: This will permanently remove the record from the database.
    public function delete($id)
    {
        $model = new StudentModel();
        $student = $model->find($id);
        if (!$student) {
            session()->setFlashdata('notif_error', 'Student not found.');
            return redirect()->to(base_url('students'));
        }
        if ($model->delete($id)) {
            session()->setFlashdata('notif_success', 'Student deleted successfully!');
        } else {
            session()->setFlashdata('notif_error', 'Failed to delete student.');
        }
        return redirect()->to(base_url('students'));
    }
}
