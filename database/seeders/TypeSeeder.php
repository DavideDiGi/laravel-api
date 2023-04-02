<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models
use App\Models\Type;

//Helpers
use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'Sito Web',
            'App',
            'Gestionale',
            'E-Commerce'
        ];

        foreach ($types as $type) {
            $newType = Type::create([
                'name' => $type,
                'slug' => Str::slug($type),
            ]);
        }
    }
}
