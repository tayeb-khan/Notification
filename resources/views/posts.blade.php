@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="mb-0">
                            <i class="fa fa-list me-2 text-primary"></i> {{ __('Posts') }}
                        </h5>
                    </div>

                    <div class="card-body">
                        @session('success')
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa fa-check-circle me-1"></i> {{ $value }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endsession

                        <div id="notification"></div>

                        @if (!auth()->user()->is_admin)
                            <h6 class="mb-3 mt-4"><i class="fa fa-pen me-1 text-success"></i> Create New Post</h6>
                            <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data" class="mb-5">
                                @csrf
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" name="title" class="form-control" id="title" placeholder="Enter post title">
                                    @error('title')
                                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="body" class="form-label">Body</label>
                                    <textarea name="body" class="form-control" id="body" rows="4" placeholder="Write something..."></textarea>
                                    @error('body')
                                    <small class="text-danger d-block mt-1">{{ $message }}</small>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save me-1"></i> Submit
                                </button>
                            </form>
                        @endif

                        <h6 class="mt-4"><i class="fa fa-table me-1 text-info"></i> All Posts</h6>
                        <div class="table-responsive">
                            <table class="table table-striped align-middle table-hover border">
                                <thead class="table-light">
                                <tr>
                                    <th scope="col" width="70px">#ID</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Body</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($posts as $post)
                                    <tr>
                                        <td>{{ $post->id }}</td>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->body }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">There are no posts.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @if (auth()->user()->is_admin)
        <script type="module">
            window.Echo.channel('posts')
                .listen('.create', (data) => {
                    console.log('New Post created: ', data);
                    const notification = document.getElementById('notification');
                    notification.insertAdjacentHTML('beforeend', `
                        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                            <i class="fa fa-bell me-1"></i> ${data.message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `);
                });
        </script>
    @endif
@endsection
