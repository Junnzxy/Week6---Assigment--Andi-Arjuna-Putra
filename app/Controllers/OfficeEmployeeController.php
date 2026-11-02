<?php
namespace App\Controllers;

use App\Models\Employee;
use App\Models\Office;
use App\Models\OfficeEmployee;

class OfficeEmployeeController {
    private OfficeEmployee $officeEmployeeModel;
    private Employee       $employeeModel;
    private Office         $officeModel;

    public function __construct() {
        $this->officeEmployeeModel = new OfficeEmployee();
        $this->employeeModel       = new Employee();
        $this->officeModel         = new Office();
    }

    public function index(?string $flashMessage = null, ?string $flashType = null): void {
        $officeEmployees = $this->officeEmployeeModel->getAll();
        $employees       = $this->employeeModel->getAll();
        $offices         = $this->officeModel->getAll();

        $pageTitle = "Office Employees Relationship";
        $activeTab = "office-employees";

        require __DIR__ . '/../../views/office_employee/index.php';
    }

    public function store(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $employeeId = $_POST['employee_id'] ?? '';
            $officeId   = $_POST['office_id']   ?? '';

            if (empty($employeeId) || empty($officeId)) {
                $this->index("Silakan pilih Employee dan Office yang valid!", "danger");
                return;
            }

            $this->officeEmployeeModel->save($employeeId, $officeId);
            header("Location: index.php?page=office-employees&status=added");
            exit;
        }
    }

    public function delete(): void {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->officeEmployeeModel->delete($id);
            header("Location: index.php?page=office-employees&status=deleted");
            exit;
        }
    }
}
