<?php

namespace App\Controllers;

class C_Admin extends BaseController
{
    public function index()
    {
        return $this->render('admin/index', [
            'title' => 'Home',
        ]);
    }
}
