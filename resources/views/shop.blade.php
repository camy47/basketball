@extends('layout')

@section('styles')
<style>
    .shop-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
    }

    .filter-section {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 3rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .filter-form {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .select-wrapper {
        position: relative;
        flex: 1;
        min-width: 200px;
    }

    .filter-select {
        width: 100%;
        padding: 0.75rem 1rem;
        border-radius: 12px;
        border: 2px solid #e2e8f0;
        background: #f8fafc;
        font-size: 0.95rem;
        transition: all 0.2s ease;
        appearance: none;
        cursor: pointer;
    }

    .filter-select:hover {
        border-color: #cbd5e1;
    }

    .filter-select:focus {
        border-color: #3b82f6;
        outline: none;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .filter-button {
        padding: 0.75rem 1.5rem;
        background: #3b82f6;
        color: white;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .filter-button:hover {
        background: #2563eb;
        transform: translateY(-1px);
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 1.5rem;
    }

    .product-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px -8px rgba(0, 0, 0, 0.15);
    }

    .product-image {
        width: 100%;
        aspect-ratio: 1;
        object-fit: cover;
    }

    .product-content {
        padding: 1rem;
    }

    .product-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 0.5rem;
    }

    .product-description {
        color: #64748b;
        font-size: 0.9rem;
        line-height: 1.5;
        margin-bottom: 0.75rem;
    }

    .product-price {
        font-size: 1.25rem;
        font-weight: 700;
        color: #3b82f6;
    }
</style>
@endsection

@section('content')
<div class="shop-container">
    <div class="filter-section">
        <h2 class="text-2xl font-bold mb-4">Filter Basketballs</h2>
        <form method="GET" action="{{ route('shop') }}" class="filter-form">
            <div class="select-wrapper">
                <select name="type" class="filter-select">
                    <option value="">All Types</option>
                    <option value="indoor" {{ request('type') === 'indoor' ? 'selected' : '' }}>Indoor</option>
                    <option value="outdoor" {{ request('type') === 'outdoor' ? 'selected' : '' }}>Outdoor</option>
                    <option value="indoor-outdoor" {{ request('type') === 'indoor-outdoor' ? 'selected' : '' }}>Indoor/Outdoor</option>
                </select>
            </div>

            <div class="select-wrapper">
                <select name="sort" class="filter-select">
                    <option value="">Sort By</option>
                    <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                    <option value="name_asc" {{ request('sort') === 'name_asc' ? 'selected' : '' }}>Name: A to Z</option>
                    <option value="name_desc" {{ request('sort') === 'name_desc' ? 'selected' : '' }}>Name: Z to A</option>
                </select>
            </div>

            <button type="submit" class="filter-button">
                Apply Filters
            </button>
        </form>
    </div>

    <div class="product-grid">
        @foreach($basketballs as $ball)
            <div class="product-card">
                <img 
                    class="product-image"
                    src="{{ $ball->image ? Storage::url($ball->image) : 'https://via.placeholder.com/200x200' }}" 
                    alt="{{ $ball->name }}"
                >
                <div class="product-content">
                    <h3 class="product-title">{{ $ball->name }}</h3>
                    <p class="product-description">{{ $ball->description }}</p>
                    <div class="product-price">${{ number_format($ball->price, 2) }}</div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
