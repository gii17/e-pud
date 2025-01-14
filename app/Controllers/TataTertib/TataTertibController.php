<?php

namespace App\Controllers\TataTertib;

use App\Controllers\BaseController;
use App\Models\TataTertib\TataTertibItemModel;
use App\Models\TataTertib\TataTertibModel;

class TataTertibController extends BaseController
{

    public function index()
    {
        $tataTertibModel = new TataTertibModel();
        $tataTertibItemModel = new TataTertibItemModel();
        $tataTertibList = $tataTertibModel->find();

        foreach ($tataTertibList as $item) {
            $item->items = $tataTertibItemModel->where('tata_tertib_id',$item->id)->findAll();
        }
        $data['tataTertibList'] = $tataTertibList;
        return view('page/tata_tertib/index',$data);
    }

    public function store()
    {
        $judul = $this->request->getPost('judul');
        $daftar_aturan = $this->request->getPost('daftar_aturan');
        $tataTertibModel = new TataTertibModel();
        $tataTertibItemModel = new TataTertibItemModel();
        $tataTertibModel->insert([
            "judul" => $judul,
        ]);

        $id =$tataTertibModel->getInsertID();
        foreach ($daftar_aturan as $item) {
            $tataTertibItemModel->insert([
                "tata_tertib_id" => $id,
                "deskripsi" => $item['text'],
            ]);
        }

        return $this->response->setJSON([
            'status' => true,
            'message' => "Tata tertib berhasil di buat!",
        ]);

    }

    public function update($id)
    {
        $judul = $this->request->getPost('judul');
        $daftar_aturan = $this->request->getPost('daftar_aturan');
        $tataTertib = new TataTertibModel();
        $tataTertib->update($id, [
            "judul" => $judul
        ]);

        $tataTertibItem = new TataTertibItemModel();
        $tataTertibItemList = $tataTertibItem->where('tata_tertib_id',$id)->findAll();

        foreach ($tataTertibItemList as $item) {
            $tataTertibItem->delete($item->id);
        }

        foreach ($daftar_aturan as $aturan) {
            $tataTertibItem->insert([
                "tata_tertib_id" => $id,
                "deskripsi" => $aturan['text'],
            ]);
        }

        return $this->response->setJSON([
            'status' => true,
            'message' => "Tata tertib berhasil di ubah!",
        ]);
    }

    public function detail($id)
    {
        $tataTertib = new TataTertibModel();
        $tataTertibItem = new TataTertibItemModel();
        $data = $tataTertib->where('id',$id)->first();
        $data->items = $tataTertibItem->where('tata_tertib_id',$id)->findAll();
        return $this->response->setJSON([
            'status' => true,
            'data' => $data,
        ]);
    }

    public function delete($id)
    {

        $tataTertib = new TataTertibModel();

        $tataTertib->delete($id);

        return $this->response->setJSON([
            'status' => true,
            'message' => "Tata Tertib Berhasil di hapus!",
        ]);
    }

}