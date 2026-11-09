<?php
namespace Database\Seeders;
use App\Models\Magazine;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MagazineSeeder extends Seeder {
    public function run(): void {
        $items = [
            ['۱۰ رمانی که زندگی‌ات را تغییر می‌دهد','معرفی کتاب','از کلاسیک‌های همیشگی تا آثار معاصر.','images/magazine/1.jpg','۵ دقیقه مطالعه','۳ روز پیش'],
            ['چرا «ملت عشق» این‌قدر محبوب است؟','نقد و بررسی','نگاهی به دلایل محبوبیت جهانی رمان ملت عشق.','images/magazine/2.jpg','۷ دقیقه مطالعه','۵ روز پیش'],
            ['راهنمای انتخاب کتاب صوتی برای مبتدیان','کتاب صوتی','اگر تازه با کتاب صوتی آشنا شده‌ای، این راهنما کمک می‌کند.','images/magazine/3.jpg','۴ دقیقه مطالعه','۱ هفته پیش'],
        ];
        foreach ($items as $x) {
            Magazine::updateOrCreate(
                ['slug' => Str::slug($x[0], '-')],
                ['title'=>$x[0],'category_label'=>$x[1],'excerpt'=>$x[2],'body'=>$x[2],'image'=>$x[3],'read_time'=>$x[4],'published_label'=>$x[5]]
            );
        }
    }
}