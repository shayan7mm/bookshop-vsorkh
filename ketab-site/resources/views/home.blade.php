@extends('layouts.app')
@section('title', 'کاغذوسرخ | فروشگاه آنلاین کتاب')

@push('styles')
<style>
.hero{padding:60px 0 50px}
.hero .wrap{display:grid;grid-template-columns:1.1fr 1fr;gap:40px;align-items:center}
.pill{display:inline-flex;gap:8px;align-items:center;padding:6px 16px;border-radius:99px;background:#fff;border:1px solid var(--line);font-size:.8rem;color:var(--red)}
.pill:before{content:"";width:7px;height:7px;border-radius:50%;background:#7d9b84;box-shadow:0 0 0 3px #7d9b8433;animation:blink 1.6s infinite;flex-shrink:0}
@keyframes blink{50%{opacity:.3}}
h1{font-size:clamp(2rem,5.4vw,4.2rem);line-height:1.3;margin:20px 0;letter-spacing:-1px}
h1 span{color:var(--red)}
.hero p{color:var(--mut);max-width:480px;font-size:1.02rem}
.btns{display:flex;gap:14px;margin:30px 0;flex-wrap:wrap}
.btn{padding:14px 28px;border-radius:99px;font-weight:var(--fwh);transition:.3s;display:inline-block;text-align:center;font-size:.95rem}
.btn.p{color:#fff;background:var(--red);box-shadow:0 10px 30px #ff1f3d38}
.btn.p:hover{transform:translateY(-3px);box-shadow:0 16px 40px #ff1f3d55}
.btn.g{border:1px solid #26231f26;background:#fff;color:var(--ink)}
.btn.g:hover{background:var(--bg2)}
.trust{display:flex;gap:10px;flex-wrap:wrap;font-size:.82rem}
.trust span{display:inline-flex;align-items:center;gap:8px;padding:2px 14px;border:1px solid var(--line);border-radius:99px;background:#fff;color:var(--mut)}
.trust span:before{content:"";width:6px;height:6px;border-radius:2px;background:var(--red);flex-shrink:0}
.stage{position:relative;height:440px;perspective:1000px}
.stage .cv{position:absolute;width:190px;animation:fl 6s ease-in-out infinite}
.stage .cv:nth-child(1){top:60px;right:4%;transform:rotateY(-18deg) rotate(-6deg)}
.stage .cv:nth-child(2){top:0;right:34%;width:215px;z-index:2;animation-delay:-2s}
.stage .cv:nth-child(3){top:90px;right:64%;transform:rotateY(18deg) rotate(6deg);animation-delay:-4s}
@keyframes fl{50%{translate:0 -18px}}
.mq{overflow:hidden;border-block:1px solid var(--line);padding:16px 0;background:var(--card);direction:ltr}
.mq div{display:flex;gap:50px;width:max-content;animation:mq 30s linear infinite;color:var(--mut);font-size:1rem;direction:rtl;align-items:center}
.mq span:after{content:"";display:inline-block;width:8px;height:8px;margin-right:50px;background:var(--red);transform:rotate(45deg)}
@keyframes mq{to{transform:translateX(-50%)}}
.stats{display:grid;grid-template-columns:repeat(4,1fr);gap:16px}
.stat{padding:24px;border-radius:var(--r);background:var(--card);border:1px solid var(--line);text-align:center;box-shadow:0 10px 30px #26231f0d}
.stat b{display:block;font-size:clamp(1.4rem,3vw,2.2rem);color:var(--red)}
.stat span{color:var(--mut);font-size:.85rem}
.sh{display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:34px;gap:20px;flex-wrap:wrap}
.sh h2{font-size:clamp(1.4rem,3.2vw,2.3rem)}
.sh small{display:block;color:var(--red);font-size:.8rem;letter-spacing:1px}
.tabs{display:flex;gap:8px;flex-wrap:wrap}
.tabs button{padding:8px 18px;border-radius:99px;border:1px solid var(--line);background:#fff;color:var(--mut);font-size:.85rem;transition:.25s}
.tabs button.on,.tabs button:hover{background:var(--ink);color:#fff;border-color:var(--ink)}
.cats{display:grid;grid-template-columns:repeat(4,1fr);gap:16px}
.cat{padding:22px 18px;border-radius:var(--r);background:var(--card);border:1px solid var(--line);position:relative;overflow:hidden;transition:.35s}
.cat:before{content:"";position:absolute;inset:0;background:linear-gradient(135deg,var(--c),transparent 70%);opacity:.13;transition:.35s}
.cat:hover{transform:translateY(-6px);border-color:var(--c)}
.cat:hover:before{opacity:.24}
.cat .ph{position:relative;width:80px;height:80px;border-radius:18px;margin-bottom:12px;border:1px solid var(--line)}
.cat .sz{font-size:.58rem;padding:2px}
.cat .sz em{font-size:.6rem}
.cat h3{position:relative;font-size:1rem}
.cat p{position:relative;color:var(--mut);font-size:.8rem}
.deal{border-radius:26px;padding:36px;background:#f4eee4;border:1px solid var(--line);display:flex;justify-content:space-between;align-items:center;gap:24px;flex-wrap:wrap}
.deal h2{font-size:clamp(1.3rem,3vw,2rem)}
.deal p{color:var(--mut)}
.cd{display:flex;gap:10px;direction:ltr;flex-wrap:wrap}
.cd div{width:76px;padding:12px 0;border-radius:16px;background:#fff;text-align:center;border:1px solid var(--line);box-shadow:0 8px 20px #26231f0f}
.cd b{font-size:1.6rem;display:block;line-height:1.2}
.cd span{font-size:.68rem;color:var(--mut)}
.bnr-sec{padding:0}
.bnr{display:grid;grid-template-columns:1.1fr .9fr;border-radius:26px;overflow:hidden;background:var(--card);border:1px solid var(--line);box-shadow:0 18px 44px #26231f14}
.bnr.tint{background:#fdf3f4}
.bnr .bn-txt{padding:40px;display:flex;flex-direction:column;justify-content:center;align-items:flex-start}
.bnr small{color:var(--red);font-size:.78rem;letter-spacing:1px}
.bnr h2{font-size:clamp(1.25rem,2.5vw,1.95rem);line-height:1.4;margin:6px 0}
.bnr p{color:var(--mut);font-size:.92rem;max-width:420px}
.bnr .btns{margin:18px 0 0}
.bnr .ph{min-height:250px;height:100%}
.aud{display:grid;grid-template-columns:1fr 1fr;gap:40px;align-items:center}
.aud h2{font-size:clamp(1.8rem,4vw,2.4rem);margin:14px 0}
.aud p{color:var(--mut)}
.pl{background:var(--card);border:1px solid var(--line);border-radius:26px;padding:22px;display:flex;gap:18px;align-items:center;box-shadow:0 26px 60px #26231f1a;min-width:0}
.pl .cv{width:100px;flex-shrink:0}
.pl .sz{font-size:.55rem}
.pl .sz em{font-size:.65rem}
.pc{flex:1;min-width:0}
.wv{display:flex;align-items:center;gap:3px;height:46px;margin:10px 0;direction:ltr}
.wv i{flex:1;background:var(--mut);border-radius:3px;height:var(--h);opacity:.3;transition:.3s}
.wv i.on{background:var(--red);opacity:1}
.pl.play .wv i.on{animation:eq .8s ease-in-out infinite alternate}
@keyframes eq{to{transform:scaleY(.35)}}
.ctl{display:flex;align-items:center;justify-content:space-between;font-size:.78rem;color:var(--mut);gap:8px}
.pp{padding:7px 20px;border-radius:99px;background:var(--ink);color:#fff;font-size:.82rem;font-weight:var(--fwh);white-space:nowrap}
.col{display:grid;grid-template-columns:repeat(3,1fr);gap:18px}
.cl{border-radius:var(--r);background:var(--card);border:1px solid var(--line);overflow:hidden;transition:.4s;box-shadow:0 10px 30px #26231f0d;display:block}
.cl:hover{transform:scale(1.03) rotate(-.6deg)}
.cl .ph{aspect-ratio:4/3}
.cl div:last-child{padding:16px 20px;border-top:1px solid var(--line)}
.cl h3{font-size:1.15rem}
.cl p{color:var(--mut);font-size:.82rem}
.pubs{display:grid;grid-template-columns:repeat(6,1fr);gap:14px}
.pub{padding:12px;border-radius:var(--r);background:var(--card);border:1px solid var(--line);text-align:center;transition:.3s}
.pub:hover{transform:translateY(-5px);border-color:var(--red)}
.pub .ph{height:70px;border-radius:10px;margin-bottom:10px}
.pub .ph img{object-fit:contain}
.pub .sz{font-size:.58rem}
.pub .sz em{font-size:.7rem}
.pub h3{font-size:.88rem}
.pub p{color:var(--mut);font-size:.72rem}
.mg{display:grid;grid-template-columns:repeat(3,1fr);gap:18px}
.ar{border-radius:var(--r);background:var(--card);border:1px solid var(--line);overflow:hidden;transition:.3s;box-shadow:0 10px 30px #26231f0d;display:block}
.ar:hover{transform:translateY(-6px)}
.ar .ph{aspect-ratio:16/10}
.ar div:last-child{padding:16px 18px}
.ar small{color:var(--red);font-size:.75rem}
.ar h3{margin:4px 0;font-size:1rem;line-height:1.5}
.ar p{color:var(--mut);font-size:.78rem}
.rv{display:grid;grid-template-columns:repeat(3,1fr);gap:18px}
.rv blockquote{padding:24px;border-radius:var(--r);background:var(--card);border:1px solid var(--line);box-shadow:0 10px 30px #26231f0d}
.rv q{display:block;color:#4a423a;margin:10px 0 16px;quotes:"«" "»";font-size:.95rem;line-height:1.7}
.rv cite{font-style:normal;display:block}
.rv small{color:var(--mut);display:block;font-size:.78rem}
.st{color:var(--gold);font-size:.8rem}
.faq{max-width:800px;margin:auto}
details{border:1px solid var(--line);border-radius:16px;background:var(--card);margin-bottom:12px;padding:0 20px;transition:.3s}
details[open]{border-color:var(--red)}
summary{padding:18px 0;cursor:pointer;list-style:none;display:flex;justify-content:space-between;align-items:center;gap:12px;font-size:.95rem}
summary::-webkit-details-marker{display:none}
summary:after{content:"";width:14px;height:14px;flex-shrink:0;background:linear-gradient(var(--red),var(--red)) center/100% 2px no-repeat,linear-gradient(var(--red),var(--red)) center/2px 100% no-repeat;transition:.3s}
details[open] summary:after{transform:rotate(90deg);background-size:100% 2px,2px 0}
details p{color:var(--mut);padding-bottom:18px;font-size:.9rem}
.nl{text-align:center;padding:48px 24px;border-radius:30px;background:radial-gradient(circle at 50% 0,#f2ebe0,transparent 62%),#fff;border:1px solid var(--line)}
.nl h2{font-size:clamp(1.4rem,3vw,2rem)}
.nl p{color:var(--mut);margin:8px 0 24px}
.nl form{display:flex;gap:10px;max-width:480px;margin:auto}
.nl input{flex:1;padding:13px 20px;border-radius:99px;border:1px solid #26231f26;background:#fff;color:var(--ink);font:inherit;min-width:0}
.nl input:focus{outline:2px solid var(--red)}
.rev{opacity:0;transform:translateY(36px);transition:opacity .8s,transform .8s}
.rev.in{opacity:1;transform:none}
@media(max-width:900px){.hero .wrap,.aud{grid-template-columns:1fr;gap:36px}.stage{height:360px}.stats,.cats{grid-template-columns:repeat(2,1fr)}.col,.mg,.rv{grid-template-columns:1fr}.bnr{grid-template-columns:1fr}.bnr .ph{order:-1;min-height:220px}.bnr .bn-txt{padding:30px 26px}.deal{padding:26px}}
@media(max-width:640px){h1{font-size:clamp(1.7rem,7vw,2.4rem)}.hero{padding:32px 0 24px}.hero p{font-size:.95rem}.btn{padding:12px 22px;font-size:.88rem}.stage{height:300px}.stage .cv:nth-child(1){width:130px;top:60px;right:2%}.stage .cv:nth-child(2){width:150px;right:32%}.stage .cv:nth-child(3){width:130px;top:80px;right:62%}.stats{gap:10px}.stat{padding:16px 10px}.deal{padding:22px 18px;text-align:center;justify-content:center}.cd{justify-content:center;width:100%}.cd div{width:66px;padding:10px 0}.cd b{font-size:1.35rem}.cd span{font-size:.62rem}.bnr .bn-txt{padding:24px 20px}.bnr .ph{min-height:180px}.pl{padding:16px;gap:12px}.pl .cv{width:80px}.nl form{flex-direction:column}.nl input{width:100%}.nl .btn{width:100%}}
@media(max-width:420px){.stats,.cats{grid-template-columns:1fr}.pubs{grid-template-columns:repeat(2,1fr)}}
</style>
@endpush

@section('content')
<section class="hero"><div class="wrap">
  <div>
    <span class="pill">جشنواره‌ی فروش — تا ۶۰٪ تخفیف</span>
    <h1>هر کتاب، <span>یک دنیای تازه</span></h1>
    <p>بیش از ۲۰۰٬۰۰۰ عنوان کتاب چاپی، صوتی و الکترونیک با بهترین ترجمه‌ها و ارسال سریع به سراسر ایران.</p>
    <div class="btns"><a class="btn p" href="#best">شروع خرید</a><a class="btn g" href="#deal">مشاهده تخفیف‌ها</a></div>
    <div class="trust"><span>ارسال سریع</span><span>ضمانت اصالت</span><span>پرداخت امن</span><span>۷ روز مرجوعی</span></div>
  </div>
  <div class="stage">
    @foreach($heroBooks as $hb)
      <div class="cv">
        <span class="sz"><em>۶۰۰ × ۹۰۰</em>جای عکس جلد</span>
        <img src="{{ asset($hb->image) }}" alt="{{ $hb->title }}" width="600" height="900" loading="lazy" onerror="this.remove()">
      </div>
    @endforeach
  </div>
</div></section>

<div class="mq"><div>
  @for($i=0;$i<2;$i++)
    @foreach(['رمان','فلسفه','روانشناسی','تاریخ','شعر','کودک','هنر','کتاب صوتی','علمی','نشر نیلوفر','نشر ققنوس','نشر مرکز','نشر چشمه'] as $w)
      <span>{{ $w }}</span>
    @endforeach
  @endfor
</div></div>

<section><div class="wrap stats rev">
  <div class="stat"><b data-n="200000">۰</b><span>عنوان کتاب</span></div>
  <div class="stat"><b data-n="850000">۰</b><span>مشتری راضی</span></div>
  <div class="stat"><b data-n="1200">۰</b><span>ناشر همکار</span></div>
  <div class="stat"><b data-n="31">۰</b><span>استان تحت پوشش</span></div>
</div></section>

<section class="bnr-sec" id="banner-1"><div class="wrap rev">
  <div class="bnr">
    <div class="bn-txt">
      <small>پیشنهاد ویژه</small>
      <h2>باشگاه کتاب‌خوان‌ها؛ هر ماه یک کتاب هدیه</h2>
      <p>با عضویت در باشگاه، هر ماه یک کتاب چاپی دلخواه هدیه بگیر و از ۲۰٪ تخفیف دائمی روی همه‌ی سفارش‌ها استفاده کن.</p>
      <div class="btns"><a class="btn p" href="#best">عضویت در باشگاه</a><a class="btn g" href="#faq">بیشتر بدانید</a></div>
    </div>
    <div class="ph"><span class="sz"><em>۱۲۰۰ × ۴۵۰</em>تصویر بنر</span><img src="{{ asset('images/banners/1.jpg') }}" alt="بنر" onerror="this.remove()"></div>
  </div>
</div></section>

<section id="best"><div class="wrap rev">
  <div class="sh"><div><small>BEST SELLERS</small><h2>پرفروش‌ترین‌های این هفته</h2></div>
    <div class="tabs" id="tabs"><button class="on" data-f="all">همه</button><button data-f="p">چاپی</button><button data-f="a">صوتی</button><button data-f="e">الکترونیک</button></div></div>
  <div class="grid" id="grid">
    @foreach($books as $book)
      <div class="bk rev" data-i="{{ $book->id }}" data-t="{{ $book->type }}">
        <a class="tilt" href="{{ route('book.show', $book) }}" style="display:block">
          <div class="cv">
            @if($book->tag)<span class="tag">{{ $book->tag }}</span>@endif
            <span class="sz"><em>۶۰۰ × ۹۰۰</em>جای عکس جلد</span>
            <img src="{{ asset($book->image) }}" alt="{{ $book->title }}" width="600" height="900" loading="lazy" onerror="this.remove()">
          </div>
        </a>
        <div class="info">
          <h3>{{ $book->title }}</h3>
          <p>{{ $book->author }} · {{ ['p'=>'چاپی','a'=>'صوتی','e'=>'PDF'][$book->type] }}</p>
          <div class="pr">
            <span><b>{{ number_format($book->price) }} هزار</b>@if($book->old_price)<s>{{ number_format($book->old_price) }} هزار</s>@endif</span>
            <button class="add" data-id="{{ $book->id }}" data-t="{{ $book->title }}">افزودن</button>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div></section>

<section id="cats"><div class="wrap rev">
  <div class="sh"><div><small>CATEGORIES</small><h2>دسته‌بندی‌ها</h2></div></div>
  <div class="cats">
    @foreach($categories as $c)
      <a class="cat" style="--c:{{ $c->color }}" href="{{ route('shop', ['category'=>$c->id]) }}">
        <div class="ph"><span class="sz"><em>۱۶۰×۱۶۰</em></span><img src="{{ asset($c->image) }}" alt="{{ $c->name }}" width="160" height="160" loading="lazy" onerror="this.remove()"></div>
        <h3>{{ $c->name }}</h3><p>{{ $c->count_label }}</p>
      </a>
    @endforeach
  </div>
</div></section>

<section id="deal"><div class="wrap rev"><div class="deal">
  <div><h2>تخفیف‌های ویژه‌ی امروز</h2><p>تا ۶۰٪ تخفیف؛ فقط تا پایان امروز</p></div>
  <div class="cd"><div><b id="h">00</b><span>ساعت</span></div><div><b id="m">00</b><span>دقیقه</span></div><div><b id="s">00</b><span>ثانیه</span></div></div>
</div></div></section>

<section id="audio"><div class="wrap aud rev">
  <div><span class="pill">کتاب صوتی</span><h2>گوش بده، راه برو</h2>
    <p>کتاب‌های صوتی با صدای گویندگان حرفه‌ای، کیفیت استودیویی و ادامه از همان‌جایی که رها کردی.</p>
    <div class="btns"><a class="btn p" href="{{ route('audiobooks') }}">مشاهده کتاب‌های صوتی</a></div></div>
  @if($audioBook)
  <div class="pl" id="pl">
    <div class="cv"><span class="sz"><em>۶۰۰ × ۹۰۰</em></span><img src="{{ asset($audioBook->image) }}" alt="{{ $audioBook->title }}" onerror="this.remove()"></div>
    <div class="pc"><b>{{ $audioBook->title }}</b><div style="color:var(--mut);font-size:.8rem">{{ $audioBook->author }} · فصل ۳</div>
      <div class="wv" id="wv"></div>
      <div class="ctl"><span>۱۲:۳۴</span><button class="pp" id="pp">پخش</button><span>۴۵:۲۰</span></div></div>
  </div>
  @endif
</div></section>

<section id="col"><div class="wrap rev">
  <div class="sh"><div><small>COLLECTIONS</small><h2>مجموعه‌های ویژه</h2></div></div>
  <div class="col">
    <a class="cl" href="{{ route('shop') }}"><div class="ph"><span class="sz"><em>۸۰۰ × ۶۰۰</em>تصویر مجموعه</span><img src="{{ asset('images/collections/1.jpg') }}" alt="کلاسیک" onerror="this.remove()"></div><div><h3>کتاب‌های کلاسیک</h3><p>بهترین رمان‌های قرن بیستم · ۴۵ عنوان</p></div></a>
    <a class="cl" href="{{ route('shop') }}"><div class="ph"><span class="sz"><em>۸۰۰ × ۶۰۰</em>تصویر مجموعه</span><img src="{{ asset('images/collections/2.jpg') }}" alt="فلسفه" onerror="this.remove()"></div><div><h3>جهان فلسفه</h3><p>متفکران بزرگ جهان · ۳۲ عنوان</p></div></a>
    <a class="cl" href="{{ route('audiobooks') }}"><div class="ph"><span class="sz"><em>۸۰۰ × ۶۰۰</em>تصویر مجموعه</span><img src="{{ asset('images/collections/3.jpg') }}" alt="صوتی" onerror="this.remove()"></div><div><h3>کتاب‌های صوتی</h3><p>بشنو برای ذهن آرام · ۲۸ عنوان</p></div></a>
  </div>
</div></section>

<section id="pubs"><div class="wrap rev">
  <div class="sh"><div><small>PUBLISHERS</small><h2>ناشران محبوب</h2></div></div>
  <div class="pubs">
    @foreach($publishers as $p)
      <a class="pub" href="{{ route('shop', ['publisher'=>$p->id]) }}">
        <div class="ph"><span class="sz"><em>۲۰۰ × ۱۰۰</em>لوگو</span><img src="{{ asset($p->logo) }}" alt="{{ $p->name }}" onerror="this.remove()"></div>
        <h3>{{ $p->name }}</h3><p>{{ $p->count_label }}</p>
      </a>
    @endforeach
  </div>
</div></section>

<section id="mag"><div class="wrap rev">
  <div class="sh"><div><small>MAGAZINE</small><h2>مجله‌ی کاغذوسرخ</h2></div></div>
  <div class="mg">
    @foreach($magazines as $m)
      <a class="ar" href="{{ route('magazine.show', $m) }}"><div class="ph"><span class="sz"><em>۸۰۰ × ۵۰۰</em>تصویر مقاله</span><img src="{{ asset($m->image) }}" alt="{{ $m->title }}" onerror="this.remove()"></div><div><small>{{ $m->category_label }}</small><h3>{{ $m->title }}</h3><p>{{ $m->published_label }} · {{ $m->read_time }}</p></div></a>
    @endforeach
  </div>
</div></section>

<section class="bnr-sec" id="banner-2"><div class="wrap rev">
  <div class="bnr tint">
    <div class="ph"><span class="sz"><em>۱۲۰۰ × ۴۵۰</em>تصویر بنر</span><img src="{{ asset('images/banners/2.jpg') }}" alt="ارسال رایگان" onerror="this.remove()"></div>
    <div class="bn-txt">
      <small>ارسال رایگان</small>
      <h2>خرید بالای ۵۰۰ هزار تومان، ارسال رایگان</h2>
      <p>سفارش‌های بالای ۵۰۰ هزار تومان در سراسر ایران، بدون هزینه‌ی ارسال و با بسته‌بندی ایمن.</p>
      <div class="btns"><a class="btn p" href="#best">شروع خرید</a></div>
    </div>
  </div>
</div></section>

<section><div class="wrap rev">
  <div class="sh"><div><small>REVIEWS</small><h2>نظر مشتریان</h2></div></div>
  <div class="rv">
    @foreach($reviews as $r)
      <blockquote><span class="st">امتیاز {{ $r->rating }} از ۵</span><q>{{ $r->text }}</q><cite>{{ $r->name }}</cite><small>{{ $r->city }}</small></blockquote>
    @endforeach
  </div>
</div></section>

<section id="faq"><div class="wrap rev">
  <div class="sh"><div><small>FAQ</small><h2>سوالات متداول</h2></div></div>
  <div class="faq">
    <details><summary>تفاوت کتاب چاپی، صوتی و الکترونیک چیه؟</summary><p>کتاب چاپی فیزیکی و ارسال می‌شه. کتاب صوتی فایل شنیداری با صدای گوینده است. کتاب الکترونیک فایل PDF یا EPUB برای خواندن روی موبایل، تبلت یا کامپیوتر.</p></details>
    <details><summary>ارسال چقدر طول می‌کشه؟</summary><p>تهران ۱ تا ۲ روز کاری، شهرستان‌ها ۳ تا ۵ روز کاری. برای خرید بالای ۵۰۰ هزار تومان ارسال رایگانه.</p></details>
    <details><summary>کتاب الکترونیک رو چطور دانلود کنم؟</summary><p>بلافاصله بعد از پرداخت، لینک دانلود در صفحه سفارش و ایمیل شما فعال می‌شه.</p></details>
    <details><summary>امکان مرجوعی وجود داره؟</summary><p>برای کتاب چاپی تا ۷ روز با شرط سالم بودن. برای کتاب صوتی و الکترونیک مرجوعی ممکن نیست.</p></details>
  </div>
</div></section>

<section><div class="wrap rev"><div class="nl">
  <h2>عضو خانواده‌ی کاغذوسرخ شو</h2>
  <p>تخفیف‌های ویژه و معرفی کتاب‌های تازه، هر هفته در ایمیلت.</p>
  <form onsubmit="event.preventDefault(); window.toast('عضویت شما ثبت شد')"><input type="email" required placeholder="ایمیل شما"><button class="btn p">عضویت</button></form>
</div></div></section>
@endsection

@push('scripts')
<script>
const fa=n=>String(n).replace(/\d/g,d=>"۰۱۲۳۴۵۶۷۸۹"[d]);
document.querySelectorAll(".bk").forEach(c=>{
  const t=c.querySelector(".tilt"); if(!t) return;
  if(window.matchMedia("(hover:hover)").matches){
    c.addEventListener("pointermove",e=>{const r=c.getBoundingClientRect();t.style.setProperty("--y",((e.clientX-r.left)/r.width-.5)*18+"deg");t.style.setProperty("--x",(.5-(e.clientY-r.top)/r.height)*18+"deg")});
    c.addEventListener("pointerleave",()=>{t.style.setProperty("--x","0deg");t.style.setProperty("--y","0deg")});
  }
});
document.getElementById("tabs")?.addEventListener("click",e=>{
  const b=e.target.closest("button"); if(!b) return;
  const f=b.dataset.f;
  document.querySelectorAll("#tabs button").forEach(x=>x.classList.toggle("on",x===b));
  document.querySelectorAll(".bk").forEach(bk=>bk.classList.toggle("hide",f!=="all"&&bk.dataset.t!==f));
});
document.getElementById("grid")?.addEventListener("click",e=>{
  const b=e.target.closest(".add"); if(!b) return;
  window.toast("«"+b.dataset.t+"» به سبد اضافه شد");
});
setInterval(()=>{
  const d=new Date(),e=new Date(d);e.setHours(23,59,59,999);
  const s=Math.floor((e-d)/1e3),p=x=>fa(String(x).padStart(2,"0"));
  const hh=document.getElementById("h"),mm=document.getElementById("m"),ss=document.getElementById("s");
  if(hh){hh.textContent=p(Math.floor(s/3600));mm.textContent=p(Math.floor(s%3600/60));ss.textContent=p(s%60);}
},1000);
const wv=document.getElementById("wv");
if(wv){
  for(let i=0;i<44;i++) wv.insertAdjacentHTML("beforeend",`<i class="${i<16?"on":""}" style="--h:${20+Math.abs(Math.sin(i*1.3))*80}%;animation-delay:${i*.04}s"></i>`);
  document.getElementById("pp").onclick=()=>{const p=document.getElementById("pl").classList.toggle("play");document.getElementById("pp").textContent=p?"توقف":"پخش";};
}
const io=new IntersectionObserver(es=>es.forEach(e=>{
  if(!e.isIntersecting) return;
  e.target.classList.add("in");
  io.unobserve(e.target);
  e.target.querySelectorAll("[data-n]").forEach(el=>{
    const to=+el.dataset.n,t0=performance.now();
    (function s(t){const k=Math.min((t-t0)/1500,1);el.textContent=fa(Math.round(to*(1-Math.pow(1-k,3))).toLocaleString("en"))+"+";if(k<1)requestAnimationFrame(s);})(t0);
  });
}),{threshold:.12});
document.querySelectorAll(".rev").forEach(el=>io.observe(el));
</script>
@endpush