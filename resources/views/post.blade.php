@extends('layout')

@section('content')
    <article style="background-color: white; padding: 2rem; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <h1>{!! $post->title !!}</h1>
        <div style="display: flex; gap: 1rem; align-items: center; margin-bottom: 1rem;">
            <div style="display: flex; align-items: center;">
                <span style="margin-right: 0.5rem;">👤</span>
                <a href="#" style="color: #f85f00; text-decoration: none;">{{ $post->user->name }}</a>
            </div>
            <div>•</div>
            <div>
                <a href="/categories/{{ $post->category->slug }}" style="color: #f85f00; text-decoration: none;">
                    {{ $post->category->name }}
                </a>
            </div>
            <div>•</div>
            <div style="color: #666;">
                {{ $post->created_at->format('M d, Y') }}
            </div>
        </div>

        <div style="line-height: 1.6;">
            {!! $post->body !!}
        </div>
    </article>

    <a href="/" style="display: inline-block; margin-top: 2rem; color: #f85f00; text-decoration: none;">
        ← Go Back
    </a>
@endsection