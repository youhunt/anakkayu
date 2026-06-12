<?php

namespace App\Models;

use CodeIgniter\Model;

abstract class AnakKayuModel extends Model
{
    protected $returnType    = 'array';
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function published(int $limit = 12): array
    {
        return $this->where('status', 'published')
            ->orderBy('is_featured', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->findAll($limit);
    }

    public function findPublishedBySlug(string $slug): ?array
    {
        return $this->where(['slug' => $slug, 'status' => 'published'])->first();
    }
}
