<?php
namespace Database\Seeders;
use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder {
    public function run(): void {
        $items = [
            ['سارا محمدی','تهران',5,'کتاب صوتی «ملت عشق» رو تو مسیر کار گوش دادم. کیفیت صدا فوق‌العاده بود.'],
            ['علی رضایی','اصفهان',5,'ارسال سریع، بسته‌بندی عالی و قیمت‌ها منصفانه.'],
            ['مریم کریمی','شیراز',5,'کتاب الکترونیک PDF رو بلافاصله بعد از خرید دانلود کردم.'],
        ];
        foreach ($items as $x) {
            Review::updateOrCreate(
                ['name'=>$x[0],'city'=>$x[1]],
                ['rating'=>$x[2],'text'=>$x[3]]
            );
        }
    }
}