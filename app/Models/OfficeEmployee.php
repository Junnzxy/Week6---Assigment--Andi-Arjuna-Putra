<?php
namespace App\Models;

use App\Database\Storage;

class OfficeEmployee {
    private Storage  $storage;
    private Employee $employeeModel;
    private Office   $officeModel;

    public function __construct() {
        $this->storage       = new Storage();
        $this->employeeModel = new Employee();
        $this->officeModel   = new Office();
    }

    public function getAll(): array {
        $rawRelations = $this->storage->getAll('office_employees');
        $result = [];

        foreach ($rawRelations as $rel) {
            $emp = $this->employeeModel->getById($rel['employee_id']);
            $off = $this->officeModel->getById($rel['office_id']);

            $result[] = [
                'id'               => $rel['id'],
                'employee_id'      => $rel['employee_id'],
                'office_id'        => $rel['office_id'],
                'employee_name'    => $emp ? $emp['nama']        : 'Unknown Employee',
                'employee_jabatan' => $emp ? $emp['jabatan']     : '-',
                'office_name'      => $off ? $off['nama_kantor'] : 'Unknown Office',
                'office_city'      => $off ? $off['kota']        : '-',
                'created_at'       => $rel['created_at'] ?? ''
            ];
        }

        return $result;
    }

    public function save(string $employeeId, string $officeId): array {
        $relData = [
            'employee_id' => $employeeId,
            'office_id'   => $officeId
        ];
        return $this->storage->insert('office_employees', $relData);
    }

    public function delete(string $id): bool {
        return $this->storage->delete('office_employees', $id);
    }
}

