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
        Schema::create('lulusbutuh', function (Blueprint $table) {
            $table->integer('nrp');
            $table->integer('serah_hardcopy')->nullable();
            $table->string('catatan_serah_hardcopy')->nullable();
            $table->tinyInteger('serah_cd_softcopy');
            $table->string('deskripsi_terima_bebas_perpustakaan')->nullable();
            $table->tinyInteger('terima_bebas_perpustakaan');
            $table->tinyInteger('status_perpustakaan');
            $table->string('penanda_tangan_perpustakaan');
            $table->string('penanda_tangan');
            $table->tinyInteger('pembayaran_lunas_sidang_ulang');
            $table->string('paraf_pembayaran_lunas_sidang_ulang')->nullable();
            $table->string('catatan_pembayaran_lunas_sidang_ulang')->nullable();
            $table->tinyInteger('pembayaran_lunas_dana_pendidikan');
            $table->tinyInteger('pembayaran_lunas_dana_skripsi');
            $table->tinyInteger('pembayaran_wisuda');
            $table->string('deskripsi_terima_bebas_bakeu')->nullable();
            $table->tinyInteger('terima_bebas_bakeu');
            $table->tinyInteger('status_bakeu');
            $table->string('penanda_tangan_bakeu');
            $table->tinyInteger('penyelesaian_bebas_tanggungan');
            $table->string('paraf_penyelesaian_bebas_tanggungan')->nullable();
            $table->string('catatan_penyelesaian_bebas_tanggungan')->nullable();
            $table->tinyInteger('status_hrod');
            $table->string('penanda_tangan_hrod');
            $table->tinyInteger('terima_lolos_akun_akses');
            $table->string('paraf_terima_lolos_akun_akses')->nullable();
            $table->string('catatan_terima_lolos_akun_akses')->nullable();
            $table->string('deskripsi_penyelesaian_lainnya')->nullable();
            $table->tinyInteger('penyelesaian_lainnya');
            $table->tinyInteger('status_ict');
            $table->string('penanda_tangan_ict');
            $table->tinyInteger('terima_lolos_nilai_skk');
            $table->string('paraf_terima_lolos_nilai_skk')->nullable();
            $table->string('catatan_terima_lolos_nilai_skk')->nullable();
            $table->string('deskripsi_penyelesaian_lainnya_2')->nullable();
            $table->tinyinteger('penyelesaian_lainnya_2');
            $table->tinyInteger('status_bak');
            $table->string('penanda_tangan_bak');
            $table->tinyInteger('terima_lolos_sertifikasi_bahasa');
            $table->string('paraf_terima_lolos_sertifikasi_bahasa')->nullable();
            $table->string('catatan_terima_lolos_sertifikasi_bahasa')->nullable();
            $table->tinyInteger('terima_lolos_sertifikasi_lain');
            $table->tinyInteger('status_sertifikasi');
            $table->string('penanda_tangan_sertifikasi');
            $table->tinyInteger('terima_krs_semester');
            $table->string('paraf_terima_krs_semester')->nullable();
            $table->string('catatan_terima_krs_semester')->nullable();
            $table->tinyInteger('terima_rekap_transkrip');
            $table->tinyInteger('terima_lolos_sertifikasi_prodi');
            $table->string('deskripsi_publikasi_karya_ilmiah')->nullable();
            $table->tinyInteger('publikasi_karya_ilmiah');
            $table->string('deskripsi_terima_lolos_surat_keterangan')->nullable();
            $table->tinyInteger('terima_lolos_surat_keterangan');
            $table->tinyInteger('status_prodi');
            $table->string('penanda_tangan_prodi');
            $table->tinyInteger('eligible_pin');
            $table->string('paraf_eligible_pin')->nullable();
            $table->string('catatan_eligible_pin')->nullable();
            $table->string('jumlah_sks_terakhir')->nullable();
            $table->string('ipk_terakhir')->nullable();
            $table->tinyInteger('validasi_skpi');
            $table->tinyInteger('terima_lolos_yusidium');
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
        Schema::dropIfExists('lulusbutuh');
    }
};
