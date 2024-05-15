<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil data dari KKSeeder
        $kkData = DB::table('kk')->get();

        $wargaData = [];

        foreach ($kkData as $kk) {
            $kk_id = $kk->kk_id;

            // Ambil nama kepala keluarga dari data KK
            $nama_kepala_keluarga = $kk->nama_kepala_keluarga;

            $agama = ['Islam', 'Kristen', 'Hindu', 'Katolik'][array_rand(['Islam', 'Kristen', 'Hindu', 'Katolik'])];

            $tgl_lahir_kepala_keluarga = $this->generateRandomDate('1960-01-01', '1980-12-31');

            // Loop untuk membuat minimal 3 data warga untuk setiap kk
            for ($j = 1; $j <= 3; $j++) {
                $warga_id = ($kk_id - 1) * 3 + $j; // Membuat warga_id unik berdasarkan kk_id
                $nik = mt_rand(1000000000000000, 9999999999999999); // Nomor NIK dengan tipe data bigint 16 digit

                // Membuat nama warga dengan nama awal dan akhir yang berbeda
                $firstName = $this->generateRandomName();
                $lastName = $this->generateRandomName();
                $nama = $firstName . ' ' . $lastName;

                $nama_warga = ($j === 1) ? $nama_kepala_keluarga : $nama;

                // Hubungan keluarga secara acak
                $hubungan_keluarga = ($j === 1) ? 'Kepala Keluarga' : (($j === 2) ? 'Istri' : 'Anak');

                // Generate tempat dan tanggal lahir
                $tempat = ['Malang', 'Surabaya', 'Blitar', 'Probolinggo', 'Banyuwangi', 'Pasuruan'][array_rand(['Malang', 'Surabaya', 'Blitar', 'Probolinggo', 'Banyuwangi', 'Pasuruan'])];

                $tempat_tgl_lahir = $tempat . ' ';

                if ($hubungan_keluarga === 'Kepala Keluarga') {
                    $tempat_tgl_lahir .= $tgl_lahir_kepala_keluarga;
                } elseif ($hubungan_keluarga === 'Istri') {
                    $tempat_tgl_lahir .= $this->generateRandomDate('1980-01-01', '1998-12-31'); // Untuk istri dan anak
                } else {
                    $tempat_tgl_lahir .= $this->generateRandomDate('2000-01-01', '2013-12-31');
                }

                // Pilih jenis kelamin secara acak (L = Laki-laki, P = Perempuan)
                $jenis_kelamin = ($j === 1) ? 'L' : 'P';

                // RT/RW dari data kk
                $rt_rw = $kk->rt_rw;

                // Data untuk kelurahan/desa, kecamatan, agama, status perkawinan, pekerjaan
                $kel_desa = 'Purwodadi';
                $kecamatan = 'Belimbing';

                // Tentukan status perkawinan berdasarkan hubungan keluarga
                $status_perkawinan = ($hubungan_keluarga === 'Kepala Keluarga' || $hubungan_keluarga === 'Istri') ? 'Kawin' : ['Belum Kawin', 'Cerai'][array_rand(['Belum Kawin', 'Cerai'])];

                $pekerjaan = ['PNS', 'Swasta', 'Wiraswasta', 'Petani', 'Buruh', 'Pelajar'][array_rand(['PNS', 'Swasta', 'Wiraswasta', 'Petani', 'Buruh', 'Pelajar'])];

                // Pilih status warga secara acak
                $status_warga = 'menetap';

                $wargaData[] = [
                    'warga_id' => $warga_id,
                    'nik' => $nik,
                    'kk_id' => $kk_id,
                    'nama_warga' => $nama_warga,
                    'tempat_tgl_lahir' => $tempat_tgl_lahir,
                    'hubungan_keluarga' => $hubungan_keluarga,
                    'jenis_kelamin' => $jenis_kelamin,
                    'rt_rw' => $rt_rw,
                    'kel_desa' => $kel_desa,
                    'kecamatan' => $kecamatan,
                    'agama' => $agama,
                    'status_perkawinan' => $status_perkawinan,
                    'pekerjaan' => $pekerjaan,
                    'status_warga' => $status_warga,
                ];
            }
        }

        // Loop untuk membuat 10 data warga dengan status sementara (kk_id = null, hubungan_keluarga = null)
        for ($k = 91; $k <= 100; $k++) {
            $warga_id = $k; // Menggunakan offset untuk membedakan warga sementara
            $nik = mt_rand(1000000000000000, 9999999999999999); // Nomor NIK dengan tipe data bigint 16 digit

            // Membuat nama warga dengan nama awal dan akhir yang berbeda
            $firstName = $this->generateRandomName();
            $lastName = $this->generateRandomName();
            $nama_warga = $firstName . ' ' . $lastName;

            // Hubungan keluarga secara acak
            $hubungan_keluarga = 'null';

            // Generate tempat dan tanggal lahir
            $tempat = ['Malang', 'Surabaya', 'Blitar', 'Probolinggo', 'Banyuwangi', 'Pasuruan'][array_rand(['Malang', 'Surabaya', 'Blitar', 'Probolinggo', 'Banyuwangi', 'Pasuruan'])];

            $tempat_tgl_lahir = $tempat . $this->generateRandomDate('1980-01-01', '2007-12-31');


            // Pilih jenis kelamin secara acak (L = Laki-laki, P = Perempuan)
            $jenis_kelamin = ($k % 2 === 0) ? 'P' : 'L';

            // RT/RW dari data kk
            $rt_rw = ['01/01', '02/06', '04/03', '02/01', '10/01', '07/08'][array_rand(['01/01', '02/06', '04/03', '02/01', '10/01', '07/08'])];

            // Data untuk kelurahan/desa, kecamatan, agama, status perkawinan, pekerjaan
            $kel_desa = ['Jorongan', 'Jatisari', 'Kademangan', 'Sumber', 'Karanganyar', 'Banyuanyar'][array_rand(['Jorongan', 'Jatisari', 'Kademangan', 'Sumber', 'Karanganyar', 'Banyuanyar'])];
            $kecamatan = ['Leces', 'Jabung', 'Triwung', 'Gondanglegi', 'Karangkates', 'Alaspati'][array_rand(['Leces', 'Jabung', 'Triwung', 'Gondanglegi', 'Karangkates', 'Alaspati'])];

            $agama = ['Islam', 'Kristen', 'Hindu', 'Katolik'][array_rand(['Islam', 'Kristen', 'Hindu', 'Katolik'])];

            // Tentukan status perkawinan berdasarkan hubungan keluarga
            $status_perkawinan = ['Belum Kawin', 'Cerai'][array_rand(['Belum Kawin', 'Cerai'])];

            $pekerjaan = ['PNS', 'Swasta', 'Wiraswasta', 'Petani', 'Buruh', 'Pelajar'][array_rand(['PNS', 'Swasta', 'Wiraswasta', 'Petani', 'Buruh', 'Pelajar'])];

            $status_warga = 'sementara';

            $wargaData[] = [
                'warga_id' => $warga_id,
                'nik' => $nik,
                'kk_id' => null, // Set kk_id menjadi null untuk status warga sementara
                'nama_warga' => $nama_warga,
                'tempat_tgl_lahir' => $tempat_tgl_lahir, // Untuk status sementara, tempat dan tanggal lahir dapat diisi null
                'hubungan_keluarga' => null, // Hubungan keluarga diisi null untuk status sementara
                'jenis_kelamin' => $jenis_kelamin,
                'rt_rw' => $rt_rw, // RT/RW diisi null untuk status sementara
                'kel_desa' => $kel_desa,
                'kecamatan' => $kecamatan,
                'agama' => $agama,
                'status_perkawinan' => $status_perkawinan, // Status perkawinan diisi null untuk status sementara
                'pekerjaan' => $pekerjaan, // Pekerjaan diisi null untuk status sementara
                'status_warga' => $status_warga,
                'level_id' => null,
            ];
        }

        // Setiap data warga ke-5 dan seterusnya akan memiliki level_id 5
        $currentLevel = 1; // Mulai dengan level 1
        foreach ($wargaData as $index => &$warga) {
            // Jika warga_id adalah 1 sampai 4, atur level_id sesuai dengan warga_id
            if ($warga['warga_id'] >= 1 && $warga['warga_id'] <= 4) {
                $warga['level_id'] = $warga['warga_id'];
            } else {
                // Jika warga_id lebih dari 4, maka beri level_id 5
                $warga['level_id'] = 5;
            }
        }

        // Insert data warga ke dalam tabel warga menggunakan DB facade
        DB::table('warga')->insert($wargaData);
    }

    /**
     * Generate nama acak.
     *
     * @return string
     */
    private function generateRandomName()
    {
        $names = ['Santi', 'Jihan', 'Yuli', 'Maulidin', 'Muhammad', 'Emily', 'Luluk', 'Dani', 'Yoga', 'Sophia'];
        return $names[array_rand($names)];
    }

    /**
     * Generate tanggal acak.
     *
     * @return string
     */
    private function generateRandomDate($startDate, $endDate)
    {
        $startTimestamp = strtotime($startDate);
        $endTimestamp = strtotime($endDate);

        // Ambil tanggal acak di antara dua tanggal
        $randomTimestamp = mt_rand($startTimestamp, $endTimestamp);

        // Format tanggal menjadi 'YYYY-MM-DD'
        return date('Y-m-d', $randomTimestamp);
    }
}
