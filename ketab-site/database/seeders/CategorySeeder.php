<?php
namespace Database\Seeders;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder {
    public function run(): void {
        $items = [
            ['رمان و ادبیات','۱۲٬۴۵۰ عنوان','#ff1f3d','images/categories/1.jpg'],
            ['کودک و نوجوان','۸٬۲۰۰ عنوان','#a8823f','images/categories/2.jpg'],
            ['علمی و آموزشی','۶٬۷۸۰ عنوان','#6d8798','images/categories/3.jpg'],
            ['روانشناسی','۵٬۶۴۰ عنوان','#86799c','images/categories/4.jpg'],
            ['تاریخ و سیاست','۴٬۳۲۰ عنوان','#a2764f','images/categories/5.jpg'],
            ['فلسفه','۳٬۱۰۰ عنوان','#7b9484','images/categories/6.jpg'],
            ['شعر و ادب','۲٬۸۹۰ عنوان','#a07a89','images/categories/7.jpg'],
            ['هنر و معماری','۱٬۹۵۰ عنوان','#77908f','images/categories/8.jpg'],
        ];
        foreach ($items as $x) {
            Category::updateOrCreate(
                ['slug' => Str::slug($x[0], '-')],
                ['name'=>$x[0],'count_label'=>$x[1],'color'=>$x[2],'image'=>$x[3]]
            );
        }
    }
}