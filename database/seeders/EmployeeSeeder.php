<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Division;
use App\Models\Employee;
use Ramsey\Uuid\Uuid;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisions = Division::all();

        $employees = [
            [
                'id' => Uuid::uuid4()->toString(),
                'name' => 'Isallkun',
                'phone' => '123456789',
                'division_id' => 1,
                'position' => 'Developer',
                'image' => asset('images/employee/avatar.jpg'),
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'name' => 'Ridha',
                'phone' => '987654321',
                'division_id' => 6,
                'position' => 'Designer',
                'image' => asset('images/employee/avatar.jpg'),
            ],
        ];

        foreach ($employees as $employee) {
            Employee::create($employee);
        }
    }
}
