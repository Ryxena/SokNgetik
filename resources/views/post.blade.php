@extends('layouts')

@section('title', $post->title)

@section('content')
    <div class="container mt-5 pt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <article class="blog-post">
                    @if($post->thumbnail)
                        <img src="{{$post->thumbnail }}"
                             alt="{{ $post->title }}"
                             class="img-fluid rounded-3 mb-4 w-100"
                             style="object-fit: cover; height: 400px;">
                    @endif

                    <div class="post-header mb-4">
                        @if($post->category)
                            <a href=""
                               class="badge bg-primary text-decoration-none mb-2">
                                {{ $post->category->name }}
                            </a>
                        @endif
                        <h1 class="display-4 mb-3">{{ $post->title }}</h1>

                        <div class="d-flex align-items-center">
                            <div class="bg-light rounded-circle me-2 d-flex align-items-center justify-content-center"
                                 style="width: 40px; height: 40px;">
                            <span class="text-primary">
                                {{ strtoupper(substr($post->user->name, 0, 1)) }}
                            </span>
                            </div>
                            <div>
                                <p class="mb-0 fw-bold">{{ $post->user->name }}</p>
                                <small class="text-muted">
                                    {{ $post->created_at->format('F d, Y') }} ·
                                    {{ ceil(str_word_count(strip_tags($post->content)) / 200) }} min read
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- Content from CKEditor -->
                    <div class="post-content">
                        {!! str($post->content)->sanitizeHtml() !!}
                    </div>

                    <!-- Share Buttons -->
                    <div class="share-buttons mt-5 pt-4 border-top">
                        <h5>Share this post</h5>
                        <div class="d-flex gap-2">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                               target="_blank"
                               class="btn btn-primary">
                                Share on Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}"
                               target="_blank"
                               class="btn btn-info text-white">
                                Share on Twitter
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . request()->url()) }}"
                               target="_blank"
                               class="btn btn-success">
                                Share on WhatsApp
                            </a>
                        </div>
                    </div>

                    <!-- Author Box -->
                    <div class="author-box mt-5 p-4 bg-light rounded-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-white rounded-circle me-3 d-flex align-items-center justify-content-center"
                                 style="width: 60px; height: 60px;">
                            <span class="h4 text-primary mb-0">
                                {{ strtoupper(substr($post->user->name, 0, 1)) }}
                            </span>
                            </div>
                            <div>
                                <h5 class="mb-1">Written by {{ $post->user->name }}</h5>
                                @if($post->user->bio)
                                    <p class="mb-0">{{ $post->user->bio }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Related Posts -->
                @if(isset($relatedPosts) && $relatedPosts->count() > 0)
                    <div class="related-posts mt-5">
                        <h3 class="mb-4">Related Posts</h3>
                        <div class="row g-4">
                            @foreach($relatedPosts as $relatedPost)
                                <div class="col-md-4">
                                    <div class="card h-100">
                                        @if($relatedPost->thumbnail)
                                            <img src="{{$relatedPost->thumbnail }}"
                                                 class="card-img-top"
                                                 alt="{{ $relatedPost->title }}">
                                        @endif
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <a href="{{ route('post.show', $relatedPost->slug) }}"
                                                   class="text-decoration-none text-dark">
                                                    {{ $relatedPost->title }}
                                                </a>
                                            </h5>
                                            <p class="card-text text-muted">
                                                {{ Str::limit(strip_tags($relatedPost->content), 100) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .post-content {
                font-size: 1.1rem;
                line-height: 1.8;
            }

            .post-content h2 {
                margin-top: 2rem;
                margin-bottom: 1rem;
            }

            .post-content p {
                margin-bottom: 1.5rem;
            }

            .post-content img {
                max-width: 100%;
                height: auto;
                border-radius: 8px;
                margin: 1.5rem 0;
            }

            .post-content blockquote {
                border-left: 4px solid #6366F1;
                padding-left: 1rem;
                margin: 1.5rem 0;
                font-style: italic;
                color: #4B5563;
            }

            .post-content pre {
                background: #1F2937;
                color: #F9FAFB;
                padding: 1rem;
                border-radius: 8px;
                overflow-x: auto;
            }

            .post-content a {
                color: #6366F1;
                text-decoration: none;
            }

            .post-content a:hover {
                text-decoration: underline;
            }
        </style>
    @endpush
@endsection
