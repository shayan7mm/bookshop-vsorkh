@extends('layouts.app')

@section('content')
<style>
.shop-head{background:#fff;border-bottom:1px solid var(--line);padding:36px 0 0;margin-top:20px}
.shop-head h1{font-size:clamp(1.6rem,3.5vw,2.4rem);margin-bottom:6px}
.shop-head p{color:var(--mut);font-size:.95rem}
.shop-body{padding:36px 0 80px;display:grid;grid-template-columns:260px 1fr;gap:36px;align-items:start}
.sidebar{position:sticky;top:130px;display:flex;flex-direction:column;gap:22px}
.fbox{background:var(--card);border:1px solid var(--line);border-radius:var(--r);padding:20px}
.fbox h4{font-size:.95rem;margin-bottom:12px}
.fbox a{display:flex;align-items:center;gap:8px;font-size:.85rem;color:var(--mut);padding:5px 0;cursor:pointer;transition:.2s;border-radius:8px}
.fbox a:hover{color:var(--red)}
.fbox a.on{color:var(--red);font-weight:600}
.filterbar{background:var(--card);border:1px solid var(--line);border-radius:var(--r);padding:14px 18px;margin-bottom:20px;display:flex;justify-content:space-between;align-items:center;gap:14px;flex-wrap:wrap}
.filterbar form{display:flex;gap:8px;align-items:center;flex-wrap:wrap;flex:1}
.filterbar input[type=search]{flex:1;min-width:180px;padding:9px 16px;border-radius:99px;border:1px solid #26231f26;background:#fff;font:inherit;color:var(--ink)}
.filterbar input[type=search]:focus{outline:none;border-color:var(--red);box-shadow:0 0 0 3px #ff1f3d1f}
.filterbar .count{color:var(--mut);font-size:.82rem;white-space:nowrap}
.filterbar .btn-s{padding:8px 18px;border-radius:99px;background:var(--red);color:#fff;font-size:.85rem;font-weight:600}
.empty{background:var(--card);border:1px dashed var(--line);border-radius:var(--r);padding:60px 20px;text-align:center;color:var(--mut)}
.empty b{display:block;font-size:1.2rem;color:var(--ink);margin-bottom:8px}
.pager{display:flex;justify-content:center;margin-top:40px;gap:6px;flex-wrap:wrap}
.pager a,.pager span{padding:8px 14px;border-radius:10px;border:1px solid var(--line);background:#fff;font-size:.85rem;color:var(--mut);min-width:36px;text-align:center}
.pager a:hover{border-color:var(--red);color:var(--red)}
.pager .on{background:var(--ink);color:#fff;border-color:var(--ink)}
.pager .disabled{opacity:.4;cursor:not-allowed}
@media(max-width:900px){
  .shop-body{grid-template-columns:1fr;gap:20px}
  .sidebar{position:static;flex-direction:row;flex-wrap:wrap;gap:12px}
  .fbox{flex:1 1 45%;min-width:160px}
  .filterbar form{width:100%}
}
@media(max-width:560px){.fbox{flex:1 1 100%}}
</style>

<div class="shop-head"><div class="wrap">
  <small style="color:var(--red);font-size:.8rem;letter-spacing:1px">SHOP</small>
  <h1>{{ $pageTitle ?? 'فروشگاه' }}</h1>
  <p>{{ $pageSub ?? 'همه‌ی کتاب‌ها با امکان فیلتر بر اساس دسته، ناشر، نوع و قیمت' }}</p>
</div></div>

<div class="wrap shop-body">
  <aside class="sidebar">
    <div class="fbox">
      <h4>دسته‌بندی</h4>
      <a href="{{ route('shop', request()->except('category','page')) }}" class="{{ empty($filters['category']) ? 'on' : '' }}">همه دسته‌ها</a>
      @foreach($categories as $c)
        <a href="{{ route('shop', array_merge(request()->except('category','page'), ['category'=>$c->id])) }}" class="{{ ($filters['category'] ?? null) == $c->id ? 'on' : '' }}">{{ $c->name }}</a>
      @endforeach
    </div>

    <div class="fbox">
      <h4>ناشر</h4>
      <a href="{{ route('shop', request()->except('publisher','page')) }}" class="{{ empty($filters['publisher']) ? 'on' : '' }}">همه ناشران</a>
      @foreach($publishers as $p)
        <a href="{{ route('shop', array_merge(request()->except('publisher','page'), ['publisher'=>$p->id])) }}" class="{{ ($filters['publisher'] ?? null) == $p->id ? 'on' : '' }}">{{ $p->name }}</a>
      @endforeach
    </div>

    <div class="fbox">
      <h4>نوع کتاب</h4>
      <a href="{{ route('shop', request()->except('type','page')) }}" class="{{ empty($filters['type']) ? 'on' : '' }}">همه</a>
      <a href="{{ route('shop', array_merge(request()->except('type','page'), ['type'=>'p'])) }}" class="{{ ($filters['type'] ?? null) === 'p' ? 'on' : '' }}">چاپی</a>
      <a href="{{ route('shop', array_merge(request()->except('type','page'), ['type'=>'a'])) }}" class="{{ ($filters['type'] ?? null) === 'a' ? 'on' : '' }}">صوتی</a>
      <a href="{{ route('shop', array_merge(request()->except('type','page'), ['type'=>'e'])) }}" class="{{ ($filters['type'] ?? null) === 'e' ? 'on' : '' }}">الکترونیک</a>
    </div>

    <div class="fbox">
      <h4>ویژه</h4>
      <a href="{{ route('deals') }}" class="{{ !empty($filters['sale']) ? 'on' : '' }}">فقط تخفیف‌دارها</a>
      <a href="{{ route('audiobooks') }}">فقط کتاب صوتی</a>
    </div>
  </aside>

  <main>
    <div class="filterbar">
      <form method="GET" action="{{ route('shop') }}">
        @foreach($filters as $k => $v)
          @if($k !== 'q' && $v)
            <input type="hidden" name="{{ $k }}" value="{{ $v }}">
          @endif
        @endforeach
        <input type="search" name="q" value="{{ $filters['q'] ?? '' }}" placeholder="جستجو در عنوان یا نویسنده...">
        <button class="btn-s" type="submit">جستجو</button>
        @if(!empty($filters))
          <a href="{{ route('shop') }}" style="font-size:.82rem;color:var(--mut);padding:8px 12px">پاک کردن فیلترها</a>
        @endif
      </form>
      <span class="count">{{ $books->total() }} کتاب</span>
    </div>

    @if($books->count())
      <div class="grid">
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

      @if($books->hasPages())
        <div class="pager">
          @if($books->onFirstPage())
            <span class="disabled">قبلی</span>
          @else
            <a href="{{ $books->previousPageUrl() }}">قبلی</a>
          @endif
          @foreach($books->getUrlRange(1, $books->lastPage()) as $page => $url)
            @if($page == $books->currentPage())
              <span class="on">{{ $page }}</span>
            @else
              <a href="{{ $url }}">{{ $page }}</a>
            @endif
          @endforeach
          @if($books->hasMorePages())
            <a href="{{ $books->nextPageUrl() }}">بعدی</a>
          @else
            <span class="disabled">بعدی</span>
          @endif
        </div>
      @endif
    @else
      <div class="empty">
        <b>کتابی پیدا نشد</b>
        <span>فیلترها را تغییر بده یا عبارت جستجو را پاک کن.</span>
      </div>
    @endif
  </main>
</div>
@endsection