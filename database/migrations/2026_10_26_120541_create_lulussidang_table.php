<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lulussidang', function (Blueprint $table) {
        $table->integer('nrp');
  $table->tinyInteger('terima_bebas_tanggungan');
  $table->string('paraf_terima_bebas_tanggungan')->nullable();
  $table->string('catatan_terima_bebas_tanggungan')->nullable();
  $table->tinyInteger('pembayaran_lainnya');
  $table->string('deskripsi_pembayaran_lainnya')->nullable();
  $table->tinyInteger('status_perpustakaan');
  $table->string('penanda_tangan_perpustakaan');
  $table->string('penanda_tangan');
  $table->tinyInteger('pembayaran_lunas_data_pembangunan');
  $table->string('paraf_pembayaran_lunas_data_pembangunan')->nullable();
  $table->string('catatan_pembayaran_lunas_data_pembangunan')->nullable();
  $table->tinyInteger('pembayaran_lunas_biaya_pendidikan');
  $table->tinyInteger('pembayaran_lunas_biaya_skripsi');
  $table->tinyInteger('terima_bebas_tanggungan_bakeu');
  $table->string('deskripsi_terima_bebas_tanggungan_bakeu')->nullable();
  $table->tinyInteger('status_bakeu');
  $table->string('penanda_tangan_bakeu');
  $table->tinyInteger('penyelesaian_bebas_tanggungan');
  $table->string('paraf_penyelesaian_bebas_tanggungan')->nullable();
  $table->string('catatan_penyelesaian_bebas_tanggungan')->nullable();
  $table->tinyInteger('status_hrod');
  $table->string('penanda_tangan_hrod');
  $table->tinyInteger('terima_bebas_tanggungan_ict');
  $table->string('paraf_terima_bebas_tanggungan_ict')->nullable();
  $table->string('catatan_terima_bebas_tanggungan_ict')->nullable();
  $table->tinyInteger('penyelesaian_lainnya_2');
  $table->string('deskripsi_penyelesaian_lainnya_2')->nullable();
  $table->tinyInteger('status_ict');
  $table->string('penanda_tangan_ict');
  $table->tinyInteger('terima_lolos_nilai_skk');
  $table->string('paraf_terima_lolos_nilai_skk')->nullable();
  $table->string('catatan_terima_lolos_nilai_skk')->nullable();
  $table->tinyInteger('penyelesaian_lainnya_3');
  $table->string('deskripsi_penyelesaian_lainnya_3')->nullable();
  $table->tinyInteger('status_bak');
  $table->string('penanda_tangan_bak');
  $table->tinyInteger('terima_lolos_sertifikasi_bahasa');
  $table->string('paraf_terima_lolos_sertifikasi_bahasa')->nullable();
  $table->string('catatan_terima_lolos_sertifikasi_bahasa')->nullable();
  $table->tinyInteger('terima_lolos_sertifikasi_lain');
  $table->tinyInteger('status_sertifikasi');
  $table->string('penanda_tangan_sertifikasi');
  $table->tinyInteger('terima_lolos_krs_semester');
  $table->string('paraf_terima_lolos_krs_semester')->nullable();
  $table->string('catatan_terima_lolos_krs_semester')->nullable();
  $table->tinyInteger('terima_rekap_transkrip');
  $table->tinyInteger('terima_lolos_sertifikasi_prodi');
  $table->tinyInteger('terima_lolos_surat_keterangan');
  $table->tinyInteger('status_prodi');
  $table->string('penanda_tangan_prodi');
  $table->string('kesesuaian_jumlah_sks');
  $table->string('paraf_kesesuaian_jumlah_sks')->nullable();
  $table->string('catatan_kesesuaian_jumlah_sks')->nullable();
  $table->string('kelulusan_mata_kuliah');
  $table->tinyInteger('status_baa');
  $table->string('penanda_tangan_baa');
  $table->string('qr_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lulussidang');
    }
};
