<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder{
    public function run(): void{
        $this->call(TipoActoSeeder::class);
        $this->call(ActosSeeder::class);
        $this->call(PersonasSeeder::class);
        $this->call(TipoUsuariosSeeder::class);
        $this->call(PonenteSeeder::class);
    }
}
