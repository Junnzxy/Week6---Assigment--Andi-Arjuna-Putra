<?php
namespace App\Models;

use App\Database\Storage;

class Employee {
    private Storage $storage;

    public function __construct() {
        $this->storage = new Storage();
    }

    public function getAll(): array {
        return $this->storage->getAll('employees');
    }

    public function getById(string $id): ?array {
        return $this->storage->getById('employees', $id);
    }

    public function save(string $nama, string $jabatan, int $usia): array {
        $employeeData = [
            'nama'    => trim($nama),
            'jabatan' => trim($jabatan),
            'usia'    => (int) $usia
        ];
        return $this->storage->insert('employees', $employeeData);
    }

    public function delete(string $id): bool {
        return $this->storage->delete('employees', $id);
    }
}

