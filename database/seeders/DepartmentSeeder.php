<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            [
                'name'=>'Electronic',
                'slug'=>'electronic',
                'active'=>true,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'name'=>'Fashion',
                'slug'=>'fashion',
                'active'=>true,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'name'=>'Book',
                'slug'=>'book',
                'active'=>true,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'name'=>'Other',
                'slug'=>'other',
                'active'=>true,
                'created_at'=>now(),
                'updated_at'=>now()
            ]
            ];
            DB::table('departments')->insert($departments);
    }
}
