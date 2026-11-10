@extends('layouts.app')
@section('title', 'مجله‌ی کاغذوسرخ')

@push('styles')
<style>
.mag-head{background:#fff;border-bottom:1px solid var(--line);padding:36px 0;margin-top:20px}
.mag-head h1{font-size:clamp(1.6rem,3.5vw,2.4rem);margin-bottom:6px}
.mag-head p{color:var(--mut);font-size:.95rem}
.mag-body{padding:36px 0 80px}
.mg{display:grid;grid-template-columns:repeat(3,1fr);gap:22px}
.ar{border-radius:var(--r);background:var(--card);border:1px solid var(--line);overflow:hidden;transition:.3s;box-shadow:0 10px 30px #26231f0d;display:block}
.ar:hover{transform:translateY(-6px)}
.ar .ph{aspect-ratio:16/10}
.ar div:last-child{padding:18px 20px}
.ar small{color:var(--red);font-size:.75rem}
.ar h3{margin:4px 0 8px;font-size:1.05rem;line-height:1.5}
.ar p{color:var(--mut);font-size:.82rem;line-height:1.7;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
.ar .meta{color:var(--mut);font-size:.75rem;margin-top:10px}
.pager{display:flex;justify-content:center;margin-top:40px;gap:6px;flex-wrap:wrap}
.pager a,.pager span{padding:8px 14px;border-radius:10px;border:1px solid var(--line);background:#fff;font-size:.85rem;color:var(--mut);min-width:36px;text-align:center}
.pager a:hover{border-color:var(--red);color:var(--red)}
.pager .on{background:var(--ink);color:#fff;border-color:var(--ink)}
.pager .disabled{opacity:.4;cursor:not-allowed}
@media(max-width:900px){.mg{grid-template-columns:repeat(2,1fr)}}
@media(max-width:560px){.mg{grid-template-columns:1fr}}
</style>
@endpush

@section('content')
<div class="mag-head"><div class="wrap">
  <small style="color:var(--red);font-size:.8rem;letter-spacing:1px">MAGAZINE</small>
  <h1>مجله‌ی کاغذوسرخ</h1>
  <p>معرفی کتاب، نقد و بررسی، و راهنماهای خواندن — هر هفته مطالب تازه.</p>
</div></div>

<div class="wrap mag-body">
  @if($magazines->count())
    <div class="mg">
      @foreach($magazines as $m)
        <a class="ar" href="{{ route('magazine.show', $m) }}">
          <div class="ph"><span class="sz"><em>۸۰۰ × ۵۰۰</em>تصویر مقاله</span><img src="{{ asset($m->image) }}" alt="{{ $m->title }}" onerror="this.remove()"></div>
          <div>
            <small>{{ $m->category_label }}</small>
            <h3>{{ $m->title }}</h3>
            <p>{{ $m->excerpt }}</p>
            <div class="meta">{{ $m->published_label }} · {{ $m->read_time }}</div>
          </div>
        </a>
      @endforeach
    </div>

    @if($magazines->hasPages())
      <div class="pager">
        @if($magazines->onFirstPage())<span class="disabled">قبلی</span>@else<a href="{{ $magazines->previousPageUrl() }}">قبلی</a>@endif
        @foreach($magazines->getUrlRange(1, $magazines->lastPage()) as $page => $url)
          @if($page == $magazines->currentPage())<span class="on">{{ $page }}</span>@else<a href="{{ $url }}">{{ $page }}</a>@endif
        @endforeach
        @if($magazines->hasMorePages())<a href="{{ $magazines->nextPageUrl() }}">بعدی</a>@else<span class="disabled">بعدی</span>@endif
      </div>
    @endif
  @else
    <div style="background:var(--card);border:1px dashed var(--line);border-radius:var(--r);padding:60px 20px;text-align:center;color:var(--mut)">
      <b style="display:block;font-size:1.2rem;color:var(--ink);margin-bottom:8px">هنوز مقاله‌ای منتشر نشده</b>
      <span>به‌زودی مطالب تازه‌ای اضافه می‌شود.</span>
    </div>
  @endif
</div>
@endsection