<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Course;
class StudentCourseSeeder extends Seeder
{
/**
* Run the database seeds.
*/
public function run(): void
{
// Tạo 3 môn học
$courses = Course::factory()->count(3)->create();
// Tạo 10 sinh viên
Student::factory()->count(10)->create()->each(function ($student) use
($courses) {
// Gán ngẫu nhiên 1–3 môn học cho mỗi sinh viên
$student->courses()->attach(
$courses->random(rand(1,3))->pluck('id')->toArray()
);
});
}
}

