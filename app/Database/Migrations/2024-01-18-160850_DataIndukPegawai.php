<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DataIndukPegawai extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_identitas'          => [
				'type'           => 'INT',
				'constraint'     => '5',
				'unsigned'       => true,
				'auto_increment' => true
			],
            'nomor_induk' => [
                'type'       => 'VARCHAR',
                'constraint' => 11,
            ],
            'jenis_kelamin' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
            ],
            'tempat_lahir' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'tanggal_lahir' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'status_kepegawaian' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'nip' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'agama' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'status_perkawinan'       => [
				'type'           => 'VARCHAR',
                'constraint' => 20,
			],
            'nama_pasangan'       => [
				'type'           => 'VARCHAR',
                'constraint' => 20,
			],
            'tanggal_lahir_pasangan'       => [
				'type'           => 'VARCHAR',
                'constraint' => 20,
			],
            'tanggal_perkawinan'       => [
				'type'           => 'VARCHAR',
                'constraint' => 20,
			],
            'keterangan_perkawinan'       => [
				'type'           => 'VARCHAR',
                'constraint' => 20,
			],
            'anak'       => [
				'type'           => 'VARCHAR',
                'constraint' => 20,
			],
            'status_anak'       => [
				'type'           => 'VARCHAR',
                'constraint' => 20,
			],
            'tempat_lahir_anak' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'tanggal_lahir_anak' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'nama_ortu_anak' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'alamat_rumah' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'status_rumah' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'nomor_telp' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'jarak_kantor' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'berat_badan' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'tinggi_badan' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'golongan_darah' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'riwayat_penyakit' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'jenjang_pendidikan' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'jurusan_pendidikan' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'tamat_tahun_pendidikan' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'jenis_training_pendidikan' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'tempat_training' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'tahun_training' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'bulan_training' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'hari_training' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'tingkat_training' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'keterangan_training' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'jenis_pekerjaan' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'tahun_pekerjaan' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'keterangan_pekerjaan' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'mapel' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'jenis_sekolah' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'kelas' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'tahun_mapel' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'nama_organisasi' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'jabatan_organisasi' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'tahun_organisasi' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'terhitung_mulai_tanggal' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'meninggalkan_sekolah' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'alasan_meninggalkan' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
			'created_at' => [
				'type'           => 'DATETIME',
				'null'       	 => true,
			],
			'updated_at' => [
				'type'           => 'DATETIME',
				'null'       	 => true,
			]

		]);
		$this->forge->addKey('id_identitas', true);
		$this->forge->addForeignKey('nomor_induk', 'users', 'nomor_induk');
		$this->forge->createTable('data_induk_pegawai', true);
    }

    public function down()
    {
        $this->forge->dropTable('data_induk_pegawai');
    }
}
