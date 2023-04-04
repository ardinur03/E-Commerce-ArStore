<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiPenjualan extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'transaksi_penjualan';
    protected $primaryKey       = 'no_transaksi';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama', 'no_hp', 'alamat', 'kecamatan', 'kota', 'total_transaksi', 'tanggal'];
    protected $useTimestamps = false;
}
