@extends('layouts.app')
@section('title', $book->title . ' | کاغذوسرخ')

@push('styles')
<style>
.book-wrap{padding:40px 0 60px}
.crumbs{font-size:.82rem;color:var(--mut);margin-bottom:22px}
.crumbs a:hover{color:var(--red)}
.book-detail{display:grid;grid-template-columns:340px 1fr;gap:44px;align-items:start}
.book-cover{position:sticky;top:130px}
.book-cover .cv{width:100%;box-shadow:0 30px 60px #26231f33}
.book-info h1{font-size:clamp(1.5rem,3.5vw,2.4rem);line-height:1.35;margin-bottom:8px}
.book-meta{display:flex;flex-wrap:wrap;gap:14px;color:var(--mut);font-size:.88rem;margin-bottom:20px}
.book-meta span{display:inline-flex;align-items:center;gap:6px}
.book-meta a{color:var(--red)}
.book-price{display:flex;align-items:center;gap:14px;margin:20px 0;flex-wrap:wrap}
.book-price b{font-size:1.8rem;color:var(--red)}
.book-price s{color:var(--mut);font-size:1rem}
.book-price .discount{background:var(--red);color:#fff;font-size:.78rem;padding:3px 12px;border-radius:99px;font-weight:600}
.book-actions{display:flex;gap:12px;flex-wrap:wrap;margin:24px 0}
.book-actions .btn{min-width:180px;text-align:center}
.book-desc{background:var(--card);border:1px solid var(--line);border-radius:var(--r);padding:24px;margin-top:24px;line-height:1.9}
.book-desc h3{font-size:1.1rem;margin-bottom:12px}
.book-desc p{color:#4a423a}
.badges-row{display:flex;gap:10px;flex-wrap:wrap;margin-top:20px;font-size:.82rem}
.badges-row span{display:inline-flex;align-items:center;gap:8px;padding:6px 14px;border:1px solid var(--line);border-radius:99px;background:#fff;color:var(--mut)}
.badges-row span:before{content:"";width:6px;height:6px;border-radius:50%;background:var(--red)}
.related{padding:40px 0 80px}
@media(max-width:900px){.book-detail{grid-template-columns:1fr;gap:28px}.book-cover{position:static;max-width:260px;margin:auto}.book-actions .btn{flex:1;min-width:140px}}
</style>
@endpush

@section('content')
<div class="wrap book-wrap">
  <div class="crumbs">
    <a href="{{ route('home') }}">خانه</a> /
    <a href="{{ route('shop') }}">فروشگاه</a> /
    @if($book->category)
      <a href="{{ route('shop', ['category'=>$book->category_id]) }}">{{ $book->category->name }}</a> /
    @endif
    <span>{{ $book->title }}</span>
  </div>

  <div class="book-detail">
    <div class="book-cover">
      <div class="cv">
        @if($book->tag)<span class="tag">{{ $book->tag }}</span>@endif
        <span class="sz"><em>۶۰۰ × ۹۰۰</em>جای عکس جلد</span>
        <img src="{{ asset($book->image) }}" alt="{{ $book->title }}" width="600" height="900" onerror="this.remove()">
      </div>
    </div>

    <div class="book-info">
      <h1>{{ $book->title }}</h1>
      <div class="book-meta">
        <span>نویسنده: {{ $book->author }}</span>
        @if($book->publisher)
          <span>ناشر: <a href="{{ route('shop', ['publisher'=>$book->publisher_id]) }}">{{ $book->publisher->name }}</a></span>
        @endif
        <span>نوع: {{ ['p'=>'چاپی','a'=>'صوتی','e'=>'الکترونیک'][$book->type] }}</span>
      </div>

      <div class="book-price">
        <b>{{ number_format($book->price) }} هزار تومان</b>
        @if($book->old_price)
          <s>{{ number_format($book->old_price) }} هزار</s>
          <span class="discount">{{ round((1 - $book->price / $book->old_price) * 100) }}٪ تخفیف</span>
        @endif
      </div>

      <div class="book-actions">
        <button class="btn p" data-add-id="{{ $book->id }}" data-add-title="{{ $book->title }}">افزودن به سبد خرید</button>
        <a class="btn g" href="{{ route('cart') }}">مشاهده سبد</a>
      </div>

      <div class="badges-row">
        <span>ارسال سریع</span>
        <span>ضمانت اصالت</span>
        <span>پرداخت امن</span>
        <span>۷ روز مرجوعی</span>
      </div>

      <div class="book-desc">
        <h3>درباره‌ی این کتاب</h3>
        <p>{{ $book->description ?: 'توضیحات این کتاب به‌زودی اضافه می‌شود.' }}</p>
      </div>
    </div>
  </div>
</div>

@if($related->count())
<section class="related"><div class="wrap">
  <div class="sh"><div><small>RELATED</small><h2>کتاب‌های مرتبط</h2></div></div>
  <div class="grid">
    @foreach($related as $rb)
      <div class="bk" data-t="{{ $rb->type }}">
        <a class="tilt" href="{{ route('book.show', $rb) }}" style="display:block">
          <div class="cv">
            @if($rb->tag)<span class="tag">{{ $rb->tag }}</span>@endif
            <span class="sz"><em>۶۰۰ × ۹۰۰</em></span>
            <img src="{{ asset($rb->image) }}" alt="{{ $rb->title }}" onerror="this.remove()">
          </div>
        </a>
        <div class="info">
          <h3>{{ $rb->title }}</h3>
          <p>{{ $rb->author }} · {{ ['p'=>'چاپی','a'=>'صوتی','e'=>'PDF'][$rb->type] }}</p>
          <div class="pr">
            <span><b>{{ number_format($rb->price) }} هزار</b>@if($rb->old_price)<s>{{ number_format($rb->old_price) }} هزار</s>@endif</span>
            <button class="add" data-add-id="{{ $rb->id }}" data-add-title="{{ $rb->title }}">افزودن</button>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div></section>
@endif
@endsection

@push('scripts')
<script>
document.addEventListener("click", e=>{
  const b = e.target.closest("[data-add-id]");
  if(!b) return;
  window.toast("«"+b.dataset.addTitle+"» به سبد اضافه شد");
});
document.querySelectorAll(".bk").forEach(c=>{
  const t=c.querySelector(".tilt"); if(!t) return;
  if(window.matchMedia("(hover:hover)").matches){
    c.addEventListener("pointermove",e=>{const r=c.getBoundingClientRect();t.style.setProperty("--y",((e.clientX-r.left)/r.width-.5)*18+"deg");t.style.setProperty("--x",(.5-(e.clientY-r.top)/r.height)*18+"deg")});
    c.addEventListener("pointerleave",()=>{t.style.setProperty("--x","0deg");t.style.setProperty("--y","0deg")});
  }
});
</script>
@endpush