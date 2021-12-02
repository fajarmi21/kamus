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
        ->join('jenis', 'kamus.jenis = jenis.id_jenis');
        if ($this->request->getPost('find') != null || $this->request->getPost('find') != "") {
            $sql->like('kamus.b_inggris', $this->request->getPost('find'), 'both')
                ->orLike('kamus.b_indo', $this->request->getPost('find'), 'both');
        }
        echo json_encode($sql->get()->getResultArray());
    }

    public function find()
    {
        $sql = $this->builder->table('kamus')
        ->join('jenis', 'kamus.jenis = jenis.id_jenis')
        ->like('kamus.b_inggris', $this->request->getPost('find'), 'both')
        ->orLike('kamus.b_indo', $this->request->getPost('find'), 'both')
        ->get()->getResultArray();
        echo json_encode($sql);
    }
}
