<?php

namespace App\Models;

use CodeIgniter\Model;

class Jual extends Model
{
    protected $table            = 'jual';
    protected $primaryKey       = false;
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['no_transaksi', 'barang_id', 'jumlah_jual', 'harga_jual'];

    // Dates
    protected $useTimestamps = false;

    public function insert_data_jual($data)
    {
        $this->db->table($this->table)->insertBatch($data);
    }
}
