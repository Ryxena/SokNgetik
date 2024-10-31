@extends('layouts')

@section('title', 'Home')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section mb-5">
        <div class="container">
            <div class="row align-items-center min-vh-75">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4 text-white">Discover Amazing Stories</h1>
                    <p class="lead mb-4 text-white-75">Read interesting articles from our talented writers.</p>
                    <div class="d-flex gap-3">
                        <a href="#latest-posts" class="btn btn-light btn-lg px-4">Start Reading</a>
                        @guest
                            <a href="{{ route('filament.dashboard.pages.dashboard') }}" class="btn btn-outline-light btn-lg px-4">Join Us</a>
                        @endguest
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <img src="https://cdn131.picsart.com/306995628160211.png" alt="Hero Image" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Posts -->
    <section class="container mb-5">
        <div class="row">
            @if($featuredPosts->count() > 0)
                <div class="col-lg-8">
                    <div class="card border-0 bg-dark text-white featured-card">
                        <img src="{{ $featuredPosts[0]->thumbnail }}"
                             class="card-img"
                             alt="{{ $featuredPosts[0]->title }}">
                        <div class="card-img-overlay d-flex flex-column justify-content-end gradient-overlay">
                            <div class="mb-2">
                                @if($featuredPosts[0]->category)
                                    <span class="badge bg-primary">{{ $featuredPosts[0]->category->name }}</span>
                                @endif
                            </div>
                            <h2 class="card-title h1">{{ $featuredPosts[0]->title }}</h2>
                            <p class="card-text">
                                {{ Str::limit(strip_tags($featuredPosts[0]->content), 150) }}
                            </p>
                            <div class="d-flex align-items-center">
                                <div class="bg-white rounded-circle me-2 d-flex align-items-center justify-content-center"
                                     style="width: 40px; height: 40px;">
                                <span class="text-dark">
                                    {{ strtoupper(substr($featuredPosts[0]->user->name, 0, 1)) }}
                                </span>
                                </div>
                                <div>
                                    <p class="mb-0 text-white">{{ $featuredPosts[0]->user->name }}</p>
                                    <small class="text-white-50">
                                        {{ $featuredPosts[0]->created_at->format('M d, Y') }}
                                    </small>
                                </div>
                            </div>
                            <a href="{{ route('post.show', $featuredPosts[0]->slug) }}" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row g-3">
                        @foreach($featuredPosts->skip(1)->take(2) as $post)
                            <div class="col-12">
                                <div class="card border-0 bg-dark text-white h-100">
                                    <img src="{{ $post->thumbnail }}"
                                         class="card-img"
                                         alt="{{ $post->title }}">
                                    <div class="card-img-overlay d-flex flex-column justify-content-end gradient-overlay">
                                        @if($post->category)
                                            <span class="badge bg-primary mb-2">{{ $post->category->name }}</span>
                                        @endif
                                        <h5 class="card-title">{{ $post->title }}</h5>
                                        <div class="d-flex align-items-center">
                                            <small class="text-white-50">
                                                {{ $post->created_at->format('M d, Y') }}
                                            </small>
                                        </div>
                                        <a href="{{ route('post.show', $post->slug) }}" class="stretched-link"></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Latest Posts -->
    <section id="latest-posts" class="container mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Latest Posts</h2>
        </div>

        <div class="row g-4">
            @forelse($latestPosts as $post)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm">
                        @if($post->thumbnail)
                            <img src="{{ $post->thumbnail }}"
                                 class="card-img-top"
                                 alt="{{ $post->title }}"
                                 style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            @if($post->category)
                                    <span class="badge bg-primary mb-2">{{ $post->category->name }}</span>
                            @endif
                            <h5 class="card-title">
                                <a href="{{ route('post.show', $post->slug) }}"
                                   class="text-decoration-none text-dark">
                                    {{ $post->title }}
                                </a>
                            </h5>
                            <p class="card-text text-muted">
                                {{ Str::limit(strip_tags($post->content), 100) }}
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="bg-light rounded-circle me-2 d-flex align-items-center justify-content-center"
                                         style="width: 32px; height: 32px;">
                                    <span class="text-primary small">
                                        {{ strtoupper(substr($post->user->name, 0, 1)) }}
                                    </span>
                                    </div>
                                    <small class="text-muted">{{ $post->user->name }}</small>
                                </div>
                                <small class="text-muted">{{ $post->created_at->format('M d, Y') }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col">
                    <div class="alert alert-info mb-0">
                        No posts available at the moment.
                    </div>
                </div>
            @endforelse
        </div>
    </section>

    @push('styles')
        <style>
            .hero-section {
                background: linear-gradient(135deg, #6366F1 0%, #A855F7 100%);
                padding: 100px 0;
                margin-top: -20px;
            }

            .min-vh-75 {
                min-height: 75vh;
            }

            .featured-card {
                height: 500px;
            }

            .featured-card img,
            .card img {
                object-fit: cover;
                height: 100%;
            }

            .gradient-overlay {
                background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(0,0,0,0.8) 100%);
            }

            .card {
                transition: transform 0.2s, box-shadow 0.2s;
            }

            .card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
            }

            /* Text utilities */
            .text-white-75 {
                color: rgba(255, 255, 255, 0.75) !important;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });
        </script>
    @endpush
@endsection
