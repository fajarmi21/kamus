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
        $array = array();
        $sql = $this->builder->table('kamus')
            ->join('jenis', 'kamus.jenis = jenis.id_jenis');
        if ($this->request->getPost('find') !== null || $this->request->getPost('find') != "") {
            $array['jenis'] = $sql
                ->select('jenis.b_ing, jenis.b_ind')
                ->like('kamus.b_inggris', $this->request->getPost('find'), 'both')
                ->orLike('kamus.b_indo', $this->request->getPost('find'), 'both')
                ->get()->getResultArray();
            $array['kamus'] = $sql
                ->select('kamus.b_inggris, kamus.b_indo')
                ->like('kamus.b_inggris', $this->request->getPost('find'), 'both')
                ->orLike('kamus.b_indo', $this->request->getPost('find'), 'both')
                ->get()->getResultArray();
        } else {
            $array = $sql->get()->getResultArray();

        }
        echo json_encode($array);
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
