<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $db = \Config\Database::connect();
        $currentDb = $db->database;
        $userModel = new \App\Models\UserModel();
        $users = $userModel->findAll();
        $data = array_merge($this->data, [
            'title' => 'Dashboard Page',
            'users' => $users,
            'currentDb' => $currentDb
        ]);
        return view('pages/commons/dashboard', $data);
    }

    public function dashboardV2(): string
    {
        $data = array_merge($this->data, [
            'title' => 'Dashboard v2 Page'
        ]);
        return view('pages/commons/dashboard_v2', $data);
    }

    public function dashboardV3(): string
    {
        $data = array_merge($this->data, [
            'title' => 'Dashboard v3 Page'
        ]);
        return view('pages/commons/dashboard_v3', $data);
    }
}
