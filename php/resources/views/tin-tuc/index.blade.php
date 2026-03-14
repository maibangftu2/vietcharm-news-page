{{-- 
    Trang Tin Tức - VietCharm Show
    File: resources/views/tin-tuc/index.blade.php
    Route: Route::get('/tin-tuc', [TinTucController::class, 'index'])->name('tin-tuc.index');
--}}

@extends('layouts.app')

@section('title', 'Tin Tức - VietCharm Show')
@section('description', 'Cập nhật tin tức mới nhất về VietCharm Culture & Dining Show tại Dinh Độc Lập, TP. Hồ Chí Minh')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/tin-tuc.css') }}">
@endpush

@section('content')
<div class="news-page">
    {{-- Background pattern --}}
    <div class="news-bg-pattern"></div>

    {{-- Back link --}}
    <div class="news-container">
        <a href="{{ url('/') }}" class="news-back-link">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Về trang chủ
        </a>
    </div>

    {{-- Title Section --}}
    <div class="news-title-section text-center">
        <h1 class="news-page-title">TIN TỨC</h1>
        <p class="news-page-subtitle">Cập nhật tin tức mới nhất về VietCharm Show</p>

        <div class="news-search-container">
            <div class="news-search-box">
                <svg class="news-search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input type="text" class="news-search-input" id="newsSearchInput" placeholder="Tìm kiếm bài viết...">
            </div>
        </div>
    </div>

    {{-- News List --}}
    <div class="news-list-section news-container">

        @php
            // Nhóm bài viết theo tháng
            $groupedNews = $newsItems->groupBy(function($item) {
                return $item->published_at->format('Y-m');
            });
        @endphp

        @foreach($groupedNews as $monthKey => $items)
            @php
                $monthDate = \Carbon\Carbon::createFromFormat('Y-m', $monthKey);
                $monthLabel = 'THÁNG ' . str_pad($monthDate->month, 2, '0', STR_PAD_LEFT) . ' / ' . $monthDate->year;
            @endphp

            @if(!$loop->first)
                <hr class="news-month-divider">
            @endif

            <div class="news-month-group" data-month="{{ $monthKey }}">
                <div class="news-month-badge">
                    <span>{{ $monthLabel }}</span>
                </div>

                @foreach($items as $article)
                    <article class="news-card" data-tags="{{ implode(', ', $article->tags ?? []) }}">
                        <div class="news-card-date">
                            <span class="news-card-day-label">
                                {{ $article->published_at->locale('vi')->isoFormat('dd') }}
                            </span>
                            <span class="news-card-day-num">
                                {{ $article->published_at->format('d') }}
                            </span>
                        </div>
                        <div class="news-card-thumb">
                            @if($article->image)
                                <img src="{{ asset($article->image) }}" 
                                     alt="{{ $article->title }}" 
                                     loading="lazy">
                            @else
                                <img src="{{ asset('images/news-placeholder.jpg') }}" 
                                     alt="{{ $article->title }}" 
                                     loading="lazy">
                            @endif
                        </div>
                        <div class="news-card-content">
                            <h3 class="news-card-title">{{ $article->title }}</h3>
                            <div class="news-card-source">
                                <span class="news-card-source-icon">◎</span>
                                <span>{{ $article->source }} · {{ $article->published_at->format('d/m/Y') }}</span>
                            </div>
                            <p class="news-card-desc">{{ Str::limit($article->excerpt, 180) }}</p>
                            <div class="news-card-tags">
                                @foreach($article->tags ?? [] as $tag)
                                    <span class="news-tag">{{ mb_strtoupper($tag) }}</span>
                                @endforeach
                            </div>
                        </div>
                        <a href="{{ $article->url ?? '#' }}" 
                           class="news-card-arrow" 
                           aria-label="Đọc thêm"
                           target="_blank"
                           rel="noopener noreferrer">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="7" y1="17" x2="17" y2="7"></line>
                                <polyline points="7 7 17 7 17 17"></polyline>
                            </svg>
                        </a>
                    </article>
                @endforeach
            </div>
        @endforeach

        {{-- No results message --}}
        <div class="news-no-results" id="newsNoResults">
            Không tìm thấy bài viết nào phù hợp.
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/tin-tuc.js') }}"></script>
@endpush
