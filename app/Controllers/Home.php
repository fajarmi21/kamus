<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }

    public function all()
    {
        $sql = $this->builder->table('kamus')
        ->join('jenis', 'kamus.jenis = jenis.id_jenis')
        ->get()->getResultArray();
        echo json_encode($sql);
    }

    public function find()
    {
        $sql = $this->builder->table('kamus')
        ->join('jenis', 'kamus.jenis = jenis.id_jenis')
        ->like('kamus.b_inggris', $this->request->getPost('find'))
        ->orLike('kamus.b_indo', $this->request->getPost('find'))
        ->get()->getResultArray();
        echo json_encode($sql);
    }
}
