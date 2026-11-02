<?php
namespace App\Database;

class Storage {
    private string $filePath;
    private array  $data = [];

    public function __construct() {
        $dataDir = __DIR__ . '/../../data';
        if (!is_dir($dataDir)) {
            mkdir($dataDir, 0777, true);
        }
        $this->filePath = $dataDir . '/storage.json';
        $this->loadData();
    }

    private function loadData(): void {
        if (!file_exists($this->filePath)) {
            $this->data = $this->getDefaultData();
            $this->saveData();
        } else {
            $content = file_get_contents($this->filePath);
            $parsed  = json_decode($content, true);
            if (!is_array($parsed)) {
                $this->data = $this->getDefaultData();
                $this->saveData();
            } else {
                $this->data = array_merge($this->getDefaultData(), $parsed);
            }
        }
    }

    private function getDefaultData(): array {
        return [
            'employees' => [
                [
                    'id'         => 'emp_1',
                    'nama'       => 'Galih',
                    'jabatan'    => 'Admin',
                    'usia'       => 20,
                    'created_at' => date('Y-m-d H:i:s')
                ],
                [
                    'id'         => 'emp_2',
                    'nama'       => 'Rama',
                    'jabatan'    => 'Super Admin',
                    'usia'       => 19,
                    'created_at' => date('Y-m-d H:i:s')
                ],
                [
                    'id'         => 'emp_3',
                    'nama'       => 'Reynaldi',
                    'jabatan'    => 'Developer',
                    'usia'       => 22,
                    'created_at' => date('Y-m-d H:i:s')
                ]
            ],
            'offices' => [
                [
                    'id'          => 'off_1',
                    'nama_kantor' => 'UC Surabaya',
                    'alamat'      => 'CitraLand Surabaya, Made, Sambikerep',
                    'kota'        => 'Surabaya',
                    'telepon'     => '031-7451699',
                    'created_at'  => date('Y-m-d H:i:s')
                ],
                [
                    'id'          => 'off_2',
                    'nama_kantor' => 'UC Makassar',
                    'alamat'      => 'Ciputra City Losari Makassar',
                    'kota'        => 'Makassar',
                    'telepon'     => '0411-8111999',
                    'created_at'  => date('Y-m-d H:i:s')
                ]
            ],
            'office_employees' => [
                [
                    'id'          => 'rel_1',
                    'employee_id' => 'emp_1',
                    'office_id'   => 'off_1',
                    'created_at'  => date('Y-m-d H:i:s')
                ],
                [
                    'id'          => 'rel_2',
                    'employee_id' => 'emp_2',
                    'office_id'   => 'off_2',
                    'created_at'  => date('Y-m-d H:i:s')
                ],
                [
                    'id'          => 'rel_3',
                    'employee_id' => 'emp_3',
                    'office_id'   => 'off_1',
                    'created_at'  => date('Y-m-d H:i:s')
                ]
            ]
        ];
    }

    private function saveData(): void {
        file_put_contents($this->filePath, json_encode($this->data, JSON_PRETTY_PRINT));
    }

    public function getAll(string $collection): array {
        return $this->data[$collection] ?? [];
    }

    public function getById(string $collection, string $id): ?array {
        $items = $this->getAll($collection);
        foreach ($items as $item) {
            if ($item['id'] === $id) {
                return $item;
            }
        }
        return null;
    }

    public function insert(string $collection, array $record): array {
        if (!isset($record['id'])) {
            $record['id'] = uniqid($collection . '_');
        }
        if (!isset($record['created_at'])) {
            $record['created_at'] = date('Y-m-d H:i:s');
        }
        $this->data[$collection][] = $record;
        $this->saveData();
        return $record;
    }

    public function delete(string $collection, string $id): bool {
        if (!isset($this->data[$collection])) {
            return false;
        }

        $initialCount = count($this->data[$collection]);
        $this->data[$collection] = array_values(array_filter(
            $this->data[$collection],
            fn($item) => $item['id'] !== $id
        ));

        // Cleanup orphan office_employees relations
        if ($collection === 'employees') {
            $this->data['office_employees'] = array_values(array_filter(
                $this->data['office_employees'],
                fn($rel) => $rel['employee_id'] !== $id
            ));
        } elseif ($collection === 'offices') {
            $this->data['office_employees'] = array_values(array_filter(
                $this->data['office_employees'],
                fn($rel) => $rel['office_id'] !== $id
            ));
        }

        $deleted = count($this->data[$collection]) < $initialCount;
        if ($deleted) {
            $this->saveData();
        }
        return $deleted;
    }
}

