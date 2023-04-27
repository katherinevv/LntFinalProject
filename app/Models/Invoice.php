<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_invoice',
        'kategori_barang',
        'nama_barang',
        'harga_barang',
        'kuantitas',
        'alamat_pengiriman',
        'kode_pos',
        'subtotal_harga',
        'total_harga',
    ];

    public function generateInvoiceNumber()
    {
        // kode untuk menghasilkan nomor faktur baru
        // generate nomor faktur dengan format FKT-YYYYMMDD-NNNN
        // NNNN adalah urutan nomor faktur, direset setiap hari
        $date = date('Ymd');
        $latestInvoice = self::where('nomor_invoice', 'like', 'FKT-' . $date . '-%')->latest()->first();
        $latestNumber = $latestInvoice ? substr($latestInvoice->nomor_invoice, -4) : 0;
        $newNumber = str_pad(intval($latestNumber) + 1, 4, '0', STR_PAD_LEFT);
        return 'FKT-' . $date . '-' . $newNumber;
    }

    public function calculateSubtotal()
    {
        // kode untuk menghitung subtotal harga setiap barang
        $quantity = $this->kuantitas;
        $price = $this->harga_barang;
        return $quantity * $price;
    }

    public function calculateTotalPrice()
    {
        // kode untuk menghitung total harga semua barang
        $subtotals = $this->calculateSubtotal();
        return $subtotals += $subtotals;
    }

    public function saveInvoice()
    {
        // kode untuk menyimpan data faktur ke database
        $this->nomor_invoice = $this->generateInvoiceNumber();
        $this->nomor_invoice = $this->generateInvoiceNumber();
        $this->subtotal_harga = $this->calculateSubtotal();
        $this->total_harga = $this->calculateTotalPrice();
        $this->save();
    }
}
