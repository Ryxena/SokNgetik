@extends('layouts')

@section('title', $user->name)

@section('content')
    <div class="container mt-5 pt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Profile Header -->
                <div class="text-center mb-5">
                    <div class="profile-header mb-4"></div>
                    <div class="profile-info">
                        <div class="bg-light rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center"
                             style="width: 100px; height: 100px;">
                        <span class="h1 text-primary mb-0">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </span>
                        </div>
                        <h1 class="display-5">{{ $user->name }}</h1>
                        <p class="lead text-muted">{{ '@' . $user->username }}</p>
                    </div>
                </div>

                <!-- Bio -->
                @if($user->bio)
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">About</h5>
                            <p class="card-text">{{ $user->bio }}</p>
                        </div>
                    </div>
                @endif

                <!-- User's Posts -->
                <div class="posts">
                    <h3 class="mb-4">Latest Posts</h3>
                    @forelse($user->posts()->latest()->take(5)->get() as $post)
                        <div class="card mb-3">
                            @if($post->thumbnail)
                                <img src="{{ $post->thumbnail }}"
                                     class="card-img-top"
                                     alt="{{ $post->title }}">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{ route('post.show', $post->slug) }}"
                                       class="text-decoration-none text-dark">
                                        {{ $post->title }}
                                    </a>
                                </h5>
                                <p class="card-text text-muted">
                                    {{ Str::limit(strip_tags($post->content), 150) }}
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        {{ $post->created_at->format('M d, Y') }}
                                    </small>
                                    <a href="{{ route('post.show', $post->slug) }}"
                                       class="btn btn-sm btn-outline-primary">
                                        Read More
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-info">
                            No posts yet.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .profile-header {
                background: linear-gradient(135deg, #6366F1 0%, #A855F7 100%);
                height: 200px;
                border-radius: 15px;
            }

            .profile-info {
                margin-top: -50px;
            }
        </style>
    @endpush
@endsection
