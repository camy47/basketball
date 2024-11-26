@extends('layout')

@section('styles')
<style>
    .news-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    .news-item {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05),
                    0 10px 15px -3px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .news-item:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.15);
    }

    .news-title {
        color: var(--dark);
        font-size: 1.5rem;
        font-weight: 700;
        line-height: 1.3;
        margin-bottom: 0.75rem;
    }

    .news-meta {
        font-size: 0.875rem;
        color: #64748b;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .news-meta::before {
        content: '';
        display: inline-block;
        width: 6px;
        height: 6px;
        background-color: var(--primary);
        border-radius: 50%;
    }

    .news-description {
        color: #334155;
        line-height: 1.7;
        margin-bottom: 1.5rem;
    }

    .news-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--primary);
        font-weight: 600;
        text-decoration: none;
        padding: 0.5rem 0;
        position: relative;
    }

    .news-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 2px;
        background-color: var(--primary);
        transition: width 0.3s ease;
    }

    .news-link:hover::after {
        width: 100%;
    }

    .section-title {
        text-align: center;
        margin-bottom: 3rem;
        color: var(--dark);
        font-size: 2.5rem;
        font-weight: 800;
        letter-spacing: -0.025em;
    }

    .refresh-button {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin: 0 auto 3rem;
        padding: 0.75rem 2rem;
        background-color: var(--primary);
        color: white;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .refresh-button:hover {
        background-color: var(--primary-dark);
        transform: translateY(-2px);
    }

    /* Loading spinner */
    .loading {
        display: none;
        text-align: center;
        padding: 3rem;
    }

    .loading.active {
        display: block;
    }

    .spinner {
        width: 48px;
        height: 48px;
        margin: 0 auto;
        border: 3px solid #f3f3f3;
        border-top: 3px solid var(--primary);
        border-radius: 50%;
        animation: spin 0.8s ease-in-out infinite;
    }
</style>
@endsection

@section('content')
    <div class="news-container">
        <h1 class="section-title">Latest Basketball News</h1>
        
        <button class="refresh-button" onclick="refreshNews()">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
            </svg>
            Refresh News
        </button>

        <div class="loading">
            <div class="spinner"></div>
        </div>

        <div id="news-content">
            @forelse($news as $item)
                <article class="news-item">
                    <h2 class="news-title">{{ $item['title'] }}</h2>
                    <div class="news-meta">
                        {{ \Carbon\Carbon::parse($item['date'])->format('F j, Y, g:i A') }}
                    </div>
                    <div class="news-description">
                        {!! $item['description'] !!}
                    </div>
                    <a href="{{ $item['link'] }}" target="_blank" class="news-link">
                        Read Full Article →
                    </a>
                </article>
            @empty
                <p style="text-align: center; padding: 2rem;">
                    No news available at the moment. Please try again later.
                </p>
            @endforelse
        </div>
    </div>

    <script>
        function refreshNews() {
            const newsContent = document.getElementById('news-content');
            const loading = document.querySelector('.loading');
            
            loading.classList.add('active');
            newsContent.style.opacity = '0.5';

            fetch('/news')
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newContent = doc.getElementById('news-content');
                    
                    newsContent.innerHTML = newContent.innerHTML;
                    newsContent.style.opacity = '1';
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to refresh news. Please try again.');
                })
                .finally(() => {
                    loading.classList.remove('active');
                });
        }
    </script>
@endsection 