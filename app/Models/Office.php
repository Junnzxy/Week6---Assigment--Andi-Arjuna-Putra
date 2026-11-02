<?php
namespace App\Models;

use App\Database\Storage;

class Office {
    private Storage $storage;

    public function __construct() {
        $this->storage = new Storage();
    }

    public function getAll(): array {
        return $this->storage->getAll('offices');
    }

    public function getById(string $id): ?array {
        return $this->storage->getById('offices', $id);
    }

    public function save(string $namaKantor, string $alamat, string $kota, string $telepon): array {
        $officeData = [
            'nama_kantor' => trim($namaKantor),
            'alamat'      => trim($alamat),
            'kota'        => trim($kota),
            'telepon'     => trim($telepon)
        ];
        return $this->storage->insert('offices', $officeData);
    }

    public function delete(string $id): bool {
        return $this->storage->delete('offices', $id);
    }
}
