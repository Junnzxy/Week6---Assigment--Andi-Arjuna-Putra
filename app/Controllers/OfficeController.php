<?php
namespace App\Controllers;

use App\Models\Office;

class OfficeController {
    private Office $officeModel;

    public function __construct() {
        $this->officeModel = new Office();
    }

    public function index(?string $flashMessage = null, ?string $flashType = null): void {
        $offices   = $this->officeModel->getAll();
        $pageTitle = "Data Kantor (Offices)";
        $activeTab = "office";

        require __DIR__ . '/../../views/office/index.php';
    }

    public function store(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $namaKantor = $_POST['nama_kantor'] ?? '';
            $alamat     = $_POST['alamat']      ?? '';
            $kota       = $_POST['kota']        ?? '';
            $telepon    = $_POST['telepon']     ?? '';

            if (empty($namaKantor) || empty($alamat) || empty($kota) || empty($telepon)) {
                $this->index("Mohon isi semua data kantor!", "danger");
                return;
            }

            $this->officeModel->save($namaKantor, $alamat, $kota, $telepon);
            header("Location: index.php?page=office&status=added");
            exit;
        }
    }

    public function delete(): void {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->officeModel->delete($id);
            header("Location: index.php?page=office&status=deleted");
            exit;
        }
    }
}
