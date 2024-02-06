<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Produk;
use App\Models\Wallet;
use App\Models\Kategori;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $namekian = User::factory()->create([
            'name' => 'Namekian',
            'email' => 'namekian@gmail.com',
            'role' => 'customer',
            'password' => bcrypt('namekian')
        ]);
        $namekian3 = User::factory()->create([
            'name' => 'NamekianToji',
            'email' => 'toji@gmail.com',
            'role' => 'customer',
            'password' => bcrypt('namekian')
        ]);
        User::factory()->create([
            'name' => 'NamekianPiccolo',
            'email' => 'piccolo@gmail.com',
            'role' => 'bank',
            'password' => bcrypt('namekian')
        ]);
        $namekian2=   User::factory()->create([
            'name' => 'NamekianDende',
            'email' => 'dende@gmail.com',
            'role' => 'kantin',
            'password' => bcrypt('namekian')
        ]);
        $gsCollector = Kategori::factory()->create([
            'nama_kategori' => 'skin',
        ]);
        $makanan = Kategori::factory()->create([
            'nama_kategori' => 'makanan',
        ]);
        // $table->id();
        // $table->string('nama_produk');
        // $table->foreignId('id_kategori');
        // $table->decimal('harga', 10, 2);
        // $table->unsigned('stok');
        // $table->timestamps();
        Produk::factory()->create([
            'nama_produk' => 'Gusion Collector',
            'id_kategori' => $gsCollector->id,
            'img' => 'gusioncollector.jpg',
            'harga' => 1000000,
            'stok' => 10
        ]);
        Produk::factory()->create([
            'nama_produk' => 'Gusion 11.11',
            'id_kategori' => $gsCollector->id,
            'img' => 'gusion11.11.jpg',
            'harga' => 1000000,
            'stok' => 10
        ]);
        Produk::factory()->create([
            'nama_produk' => 'nasi',
            'id_kategori' => $makanan->id,
            'img' => 'nasi.jpeg',
            'harga' => 10000,
            'stok' => 10
        ]);

        Wallet::factory()->create([
            'id_user' => $namekian->id,
            'saldo' => 30000000,
            'rekening' =>12345678
        ]);
        Wallet::factory()->create([
            'id_user' => $namekian3->id,
            'saldo' => 20000000,
            'rekening' =>98765432     ]);
    }
}
