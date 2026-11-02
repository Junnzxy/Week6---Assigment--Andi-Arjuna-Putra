<?php
namespace App\Controllers;

use App\Models\Employee;

class EmployeeController {
    private Employee $employeeModel;

    public function __construct() {
        $this->employeeModel = new Employee();
    }

    public function index(?string $flashMessage = null, ?string $flashType = null): void {
        $employees = $this->employeeModel->getAll();
        $pageTitle = "Data Karyawan (Employees)";
        $activeTab = "employee";

        require __DIR__ . '/../../views/employee/index.php';
    }

    public function store(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama    = $_POST['nama']    ?? '';
            $jabatan = $_POST['jabatan'] ?? '';
            $usia    = $_POST['usia']    ?? '';

            if (empty($nama) || empty($jabatan) || empty($usia)) {
                $this->index("Mohon isi semua kolom data karyawan!", "danger");
                return;
            }

            $this->employeeModel->save($nama, $jabatan, (int)$usia);
            header("Location: index.php?page=employee&status=added");
            exit;
        }
    }

    public function delete(): void {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->employeeModel->delete($id);
            header("Location: index.php?page=employee&status=deleted");
            exit;
        }
    }
}

