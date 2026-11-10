<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'کاغذوسرخ | فروشگاه آنلاین کتاب')</title>
<style>html{visibility:hidden}html.loaded{visibility:visible}</style>
<style>
@font-face{font-family:"Yekan Bakh";src:local("Yekan Bakh Regular"),local("YekanBakh-Regular"),url(fonts/YekanBakh-Regular.woff2) format("woff2");font-weight:400;font-display:swap}
@font-face{font-family:"Yekan Bakh";src:local("Yekan Bakh SemiBold"),local("YekanBakh-SemiBold"),url(fonts/YekanBakh-SemiBold.woff2) format("woff2");font-weight:500;font-display:swap}
@font-face{font-family:"Yekan Bakh";src:local("Yekan Bakh SemiBold"),local("YekanBakh-SemiBold"),url(fonts/YekanBakh-SemiBold.woff2) format("woff2");font-weight:600;font-display:swap}
:root{--fw:500;--fwh:600;--bg:#f8f6f2;--bg2:#efeae2;--card:#ffffff;--ink:#26231f;--mut:#79736b;--line:#26231f1a;--red:#ff1f3d;--gold:#9a7a46;--vio:#6b6a80;--r:22px}
*{margin:0;padding:0;box-sizing:border-box}
html{scroll-behavior:smooth;-webkit-text-size-adjust:100%}
body{font-family:"Yekan Bakh","IRANYekan",Yekan,BYekan,Vazirmatn,Tahoma,system-ui,sans-serif;font-weight:var(--fw);background:var(--bg);color:var(--ink);line-height:1.8;overflow-x:hidden}
h1,h2,h3,h4,b,strong,summary,cite{font-weight:var(--fwh)}
a{color:inherit;text-decoration:none}button{font:inherit;color:inherit;border:0;background:none;cursor:pointer}
img{display:block;max-width:100%;height:auto}
.wrap{width:min(1180px,100% - 32px);margin-inline:auto}
section{padding:80px 0;scroll-margin-top:130px}
.aur{position:fixed;inset:0;z-index:-1;overflow:hidden;pointer-events:none}
.aur i{position:absolute;width:46vmax;height:46vmax;border-radius:50%;filter:blur(110px);opacity:.13;animation:drift 18s ease-in-out infinite alternate}
.aur i:nth-child(1){background:#dcc7ab;top:-18%;right:-10%}
.aur i:nth-child(2){background:#cdbfa8;bottom:-22%;left:-12%;animation-delay:-6s}
.aur i:nth-child(3){background:#b9c3c6;top:35%;left:30%;opacity:.1;animation-delay:-11s}
@keyframes drift{to{transform:translate(8%,10%) scale(1.15)}}
.ph{position:relative;overflow:hidden;display:grid;place-items:center;background:repeating-linear-gradient(135deg,#f2eee7 0 12px,#ece7de 12px 24px)}
.ph img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:2}
.sz{position:relative;text-align:center;color:var(--mut);font-size:.78rem;line-height:1.6;padding:6px}
.sz em{display:block;font-style:normal;color:var(--ink);font-size:1rem;font-weight:var(--fwh);direction:ltr}
header{position:sticky;top:0;z-index:50;backdrop-filter:blur(18px);background:#f8f6f2e6;border-bottom:1px solid var(--line)}
.nav{display:flex;align-items:center;gap:16px;height:70px;flex-wrap:nowrap}
.logo{font-size:1.45rem;font-weight:var(--fwh);display:flex;gap:8px;align-items:center;white-space:nowrap;flex-shrink:0}
.logo b{color:var(--red)}
.logo:before{content:"";width:12px;height:12px;border-radius:3px;background:var(--red);box-shadow:0 0 0 4px #ff1f3d26;flex-shrink:0}
.sb{position:relative;flex:1 1 auto;max-width:560px;margin-inline:auto;min-width:0}
.sb input{width:100%;padding:11px 22px 11px 100px;border-radius:99px;border:1px solid #26231f26;background:#fff;font:inherit;color:var(--ink);transition:.25s}
.sb input::placeholder{color:var(--mut)}
.sb input:focus{outline:none;border-color:var(--red);box-shadow:0 0 0 4px #ff1f3d1f}
.sb button{position:absolute;left:5px;top:5px;bottom:5px;padding:0 18px;border-radius:99px;background:var(--red);color:#fff;font-size:.85rem;font-weight:var(--fwh);white-space:nowrap}
.cart{position:relative;padding:10px 18px;border-radius:99px;background:var(--ink);color:#fff;font-weight:var(--fwh);font-size:.9rem;transition:.25s;white-space:nowrap;flex-shrink:0}
.cart:hover{background:var(--red)}
.cart em{font-style:normal;background:var(--red);color:#fff;border-radius:99px;padding:1px 8px;margin-right:6px;font-size:.75rem}
.links{display:flex;gap:6px;padding:0 0 10px;overflow-x:auto;scrollbar-width:none;-webkit-overflow-scrolling:touch}
.links::-webkit-scrollbar{display:none}
.links a{padding:3px 15px;border-radius:99px;font-size:.88rem;color:var(--mut);white-space:nowrap;transition:.25s}
.links a:hover{background:#26231f0d;color:var(--ink)}
.grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:28px 22px}
.bk{perspective:900px;transition:opacity .35s,transform .35s;min-width:0}
.bk.hide{display:none}
.tilt{transform-style:preserve-3d;transition:transform .15s;transform:rotateX(var(--x,0))rotateY(var(--y,0))}
.bk .cv{width:100%}
.tag{background:#e6dcc6;color:#26231f;font-size:.7rem;font-weight:var(--fwh);padding:2px 10px;border-radius:99px}
.info{padding:14px 2px 0}
.info h3{font-size:.98rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.info p{color:var(--mut);font-size:.8rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.pr{display:flex;justify-content:space-between;align-items:center;margin-top:8px;gap:8px;flex-wrap:wrap}
.pr b{color:var(--red)}
.pr s{color:var(--mut);font-size:.75rem;margin-right:6px}
.add{padding:5px 14px;border-radius:99px;background:var(--red);color:#fff;font-size:.8rem;transition:.25s;white-space:nowrap}
.add:hover{transform:translateY(-2px);box-shadow:0 6px 18px #ff1f3d55}
.cv{aspect-ratio:2/3;border-radius:5px 12px 12px 5px;position:relative;overflow:hidden;display:grid;place-items:center;background:repeating-linear-gradient(135deg,#f2eee7 0 12px,#ece7de 12px 24px);box-shadow:0 22px 40px #26231f2e,inset 0 0 0 1px #26231f1a}
.cv:before{content:"";position:absolute;inset:0 0 0 auto;width:8%;z-index:3;pointer-events:none;background:linear-gradient(90deg,#00000040,#ffffff1a 60%,#00000026)}
.cv:after{content:"";position:absolute;inset:0;z-index:3;pointer-events:none;background:linear-gradient(105deg,#ffffff33 0,transparent 32%)}
.cv img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:2}
.cv .tag{position:absolute;top:10px;left:10px;z-index:4}
footer{background:var(--bg2);border-top:1px solid var(--line);padding:56px 0 0}
.ft{display:grid;grid-template-columns:1.5fr 1fr 1fr 1.3fr;gap:36px}
.ft h4{margin-bottom:14px;font-size:1rem}
.ft p{color:var(--mut);font-size:.9rem;max-width:340px}
.ft a{display:block;color:var(--mut);padding:2px 0;font-size:.88rem;transition:.2s}
.ft a:hover{color:var(--red);transform:translateX(-4px)}
.ft .ci{color:var(--mut);font-size:.88rem;padding:2px 0}
.ft .ci b{color:var(--ink);font-size:.85rem}
.soc{display:flex;gap:8px;flex-wrap:wrap;margin-top:18px}
.ft .soc a{display:inline-block;padding:3px 14px;border:1px solid #26231f26;border-radius:99px;background:#fff;color:var(--ink);font-size:.78rem}
.ft .soc a:hover{background:var(--red);color:#fff;border-color:var(--red);transform:none}
.badges{display:flex;gap:12px;margin-top:16px}
.badges .ph{width:78px;height:78px;border-radius:12px;border:1px solid var(--line)}
.badges .sz{font-size:.55rem}
.badges .sz em{font-size:.65rem}
.fb{border-top:1px solid var(--line);margin-top:40px;padding:18px 0;display:flex;justify-content:space-between;flex-wrap:wrap;gap:10px;font-size:.8rem;color:var(--mut)}
.fb div{display:flex;gap:18px;flex-wrap:wrap}
.fb a:hover{color:var(--red)}
.toast{position:fixed;bottom:24px;left:50%;transform:translate(-50%,120px);background:var(--ink);color:#fff;padding:12px 24px;border-radius:99px;font-weight:var(--fwh);transition:.4s;z-index:99;font-size:.9rem;max-width:90vw;text-align:center}
.toast.show{transform:translate(-50%,0)}
@media(max-width:1024px){.ft{grid-template-columns:1fr 1fr}}
@media(max-width:900px){.nav{gap:10px}.logo{font-size:1.15rem}section{padding:56px 0}.sb{max-width:none}}
@media(max-width:700px){.grid{grid-template-columns:repeat(2,1fr);gap:24px 16px}.info h3{font-size:.92rem}.pr{flex-direction:column;align-items:flex-start;gap:6px}.add{width:100%;text-align:center}}
@media(max-width:640px){.nav{height:62px;gap:8px}.logo{font-size:1rem}.logo:before{width:10px;height:10px}.sb input{padding:10px 16px 10px 78px;font-size:.85rem}.sb button{padding:0 14px;font-size:.78rem}.cart{padding:8px 12px;font-size:.82rem}.cart em{padding:1px 6px;font-size:.7rem;margin-right:4px}.ft{grid-template-columns:1fr;gap:28px}}
@media(max-width:420px){.grid{grid-template-columns:1fr}.nav{gap:6px;height:56px}.logo{font-size:.9rem}.sb button{padding:0 10px;font-size:.72rem}.sb input{padding:9px 12px 9px 68px;font-size:.78rem}.cart{padding:7px 10px;font-size:.76rem}.cart em{display:none}}
@media(prefers-reduced-motion:reduce){*{animation:none!important;transition:none!important}}
@media(max-width:640px){
  .nav{flex-wrap:wrap;height:auto;padding:10px 0;gap:8px}
  .nav .logo{order:1}
  .nav .cart{order:2;margin-right:auto}
  .nav .sb{order:3;flex:1 1 100%;max-width:none;margin:6px 0 0}
  .nav form[action*="logout"],
  .nav > a[href*="orders"],
  .nav > a[href*="login"]{order:4;flex:0 0 auto}
  .nav .sb input{padding:10px 16px 10px 70px;font-size:.85rem}
  .nav .sb button{padding:0 12px;font-size:.78rem}
}
html, body{overflow-x:clip}
body{overscroll-behavior-x:none}
</style>
@stack('styles')
</head>
<body>
<div class="aur"><i></i><i></i><i></i></div>
<header>
  <div class="wrap nav">
    <a class="logo" href="{{ route('home') }}">کاغذ<b>وسرخ</b></a>
    <form class="sb" role="search" autocomplete="off" action="{{ route('shop') }}" method="GET">
      <input type="search" name="q" value="{{ request('q') }}" placeholder="جستجوی کتاب یا نویسنده..." aria-label="جستجو">
      <button type="submit">جستجو</button>
    </form>
    <a class="cart" href="{{ route('cart') }}" id="cart">سبد خرید<em id="cnt">{{ \App\Services\CartService::count() ?: '۰' }}</em></a>
    @auth
  <div style="position:relative;display:flex;align-items:center;gap:6px">
    <a href="{{ route('orders') }}" style="font-size:.82rem;color:var(--mut);white-space:nowrap;padding:8px 10px">سفارش‌های من</a>
    <form method="POST" action="{{ route('logout') }}" style="margin:0">
      @csrf
      <button type="submit" style="padding:10px 16px;border-radius:99px;background:var(--bg2);color:var(--ink);font-size:.82rem;font-weight:600;white-space:nowrap">خروج</button>
    </form>
  </div>
@else
  <a href="{{ route('login') }}" style="padding:10px 18px;border-radius:99px;background:var(--bg2);color:var(--ink);font-size:.85rem;font-weight:600;white-space:nowrap">ورود / ثبت‌نام</a>
@endauth
  </div>
  <nav class="wrap links">
    <a href="{{ route('shop') }}">فروشگاه</a>
    <a href="{{ route('deals') }}">تخفیف</a>
    <a href="{{ route('audiobooks') }}">کتاب صوتی</a>
    <a href="{{ route('magazine.index') }}">مجله</a>
    <a href="{{ route('home') }}#cats">دسته‌ها</a>
    <a href="{{ route('home') }}#pubs">ناشران</a>
    <a href="{{ route('home') }}#faq">سوالات</a>
  </nav>
</header>
<main>
@yield('content')
</main>
<footer>
  <div class="wrap ft">
    <div>
      <a class="logo" href="{{ route('home') }}" style="display:flex;padding:0;margin-bottom:12px;font-size:1.35rem;color:var(--ink)">کاغذ<b>وسرخ</b></a>
      <p>فروشگاه آنلاین کتاب با بیش از ۲۰۰ هزار عنوان در قالب چاپی، صوتی و الکترونیک. هر کتاب، یک دنیای تازه.</p>
      <div class="soc"><a href="#">اینستاگرام</a><a href="#">تلگرام</a><a href="#">ایتا</a><a href="#">آپارات</a></div>
      <div class="badges">
        <div class="ph"><span class="sz"><em>۱۲۰ × ۱۲۰</em>نماد</span><img src="{{ asset('images/badges/1.png') }}" alt="نماد اعتماد" onerror="this.remove()"></div>
        <div class="ph"><span class="sz"><em>۱۲۰ × ۱۲۰</em>نماد</span><img src="{{ asset('images/badges/2.png') }}" alt="ساماندهی" onerror="this.remove()"></div>
      </div>
    </div>
    <div><h4>فروشگاه</h4><a href="{{ route('shop') }}">کتاب چاپی</a><a href="{{ route('audiobooks') }}">کتاب صوتی</a><a href="{{ route('deals') }}">تخفیف‌ها</a></div>
    <div><h4>پشتیبانی</h4><a href="{{ route('home') }}#faq">سوالات متداول</a><a href="#">شرایط مرجوعی</a><a href="#">پیگیری سفارش</a><a href="#">تماس با ما</a></div>
    <div><h4>تماس با ما</h4>
      <div class="ci"><b>تلفن:</b> ۰۲۱-۱۲۳۴۵۶۷۸</div>
      <div class="ci"><b>ایمیل:</b> info@example.ir</div>
      <div class="ci"><b>ساعت پاسخگویی:</b> شنبه تا پنجشنبه، ۹ تا ۱۸</div>
    </div>
  </div>
  <div class="wrap fb">
    <span>© ۱۴۰۴ کاغذوسرخ — تمامی حقوق محفوظ است</span>
    <div><a href="#">قوانین</a><a href="#">حریم خصوصی</a><a href="#">درباره ما</a></div>
  </div>
</footer>
<div class="toast" id="toast"></div>
<script>
window.toast=function(m){const t=document.getElementById('toast');if(!t)return;t.textContent=m;t.classList.add('show');clearTimeout(window.__tt);window.__tt=setTimeout(()=>t.classList.remove('show'),2000)};
</script>
<script>
document.addEventListener("click", async (e)=>{
  const b = e.target.closest(".add, [data-add-id]");
  if(!b) return;
  e.preventDefault();
  const id = b.dataset.addId || b.dataset.id;
  const title = b.dataset.addTitle || b.dataset.t || "";
  if(!id) return;

  try {
    const res = await fetch("{{ route('cart.add') }}", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": "{{ csrf_token() }}",
        "Accept": "application/json"
      },
      body: JSON.stringify({ book_id: id, qty: 1 })
    });
    const data = await res.json();
    if(data.ok){
      const cnt = document.getElementById("cnt");
      if(cnt) cnt.textContent = String(data.count).replace(/\d/g,d=>"۰۱۲۳۴۵۶۷۸۹"[d]);
      window.toast("«" + title + "» به سبد اضافه شد");
    }
  } catch(err){
    window.toast("خطا در افزودن به سبد");
  }
});
</script>
<script>
document.documentElement.classList.add('loaded');
setTimeout(()=>document.documentElement.classList.add('loaded'), 800);
</script>
@stack('scripts')
</body>
</html>