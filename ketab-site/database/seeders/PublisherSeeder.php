<?php
namespace Database\Seeders;
use App\Models\Publisher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PublisherSeeder extends Seeder {
    public function run(): void {
        $items = [
            ['نشر نیلوفر','۲٬۴۵۰ عنوان','images/publishers/1.jpg'],
            ['نشر ققنوس','۳٬۸۰۰ عنوان','images/publishers/2.jpg'],
            ['نشر مرکز','۱٬۹۶۰ عنوان','images/publishers/3.jpg'],
            ['نشر چشمه','۵٬۲۳۰ عنوان','images/publishers/4.jpg'],
            ['نشر هرمس','۲٬۱۰۰ عنوان','images/publishers/5.jpg'],
            ['نشر آگه','۱٬۴۵۰ عنوان','images/publishers/6.jpg'],
        ];
        foreach ($items as $x) {
            Publisher::updateOrCreate(
                ['slug' => Str::slug($x[0], '-')],
                ['name'=>$x[0],'count_label'=>$x[1],'logo'=>$x[2]]
            );
        }
    }
}