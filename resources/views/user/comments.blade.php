@extends('layouts.master')
@section('title')
    {{ $movie->name }}
@endsection
@section('styles')
    <style>

    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-6">
                <div class="my-3">
                    <a href="javascript:history.back()" title="back page" class="btn btn-primary"><i
                            class="fs-6 fa-solid fa-arrow-left-long"></i></a>
                    <a href="{{ route('user#movie_info', $movie->id) }}" class="btn btn-primary" title="Movie List"><i
                            class="fs-6 fa-solid fa-clapperboard"></i></a>
                </div>
            </div>
            <div class="row">
                <h5 class="text-center mt-5 mb-2"><i class="fa-solid fa-comments text-primary"></i> <span
                        language='eng'>Comments</span>( {{ $comments->total() }} )
                </h5>
                <div class="line-mf"></div>
            </div>
            <!-- Commments -->
            <div class="col-md-1"></div>
            <div class="col-md-6 my-2 CommentContainer">
                @foreach ($comments as $comment)
                    <div class="row bg-dark rounded m-1">
                        <div class="p-2 rounded">
                            <div>
                                <img src="{{ asset('user/img/linklogo.jpg') }}" class="rounded rounded-circle"
                                    width="30px" height="30px" alt="">
                                <div class=" float-end">
                                    @for ($a = 0; $a < 4; $a++)
                                        <i
                                            class="fa-solid fa-star @if ($a < $comment->rating) text-warning @endif"></i>
                                    @endfor
                                    @if (!empty(Auth::user()))
                                        @if (Auth::user()->id == $comment->user_id || Auth::user()->role == 'admin')
                                            <div class="dropdown d-inline">
                                                <a class="btn btn-dark text-light btn-sm " title="more" href="#"
                                                    role="button" id="cmtAction" data-mdb-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="fa-solid fa-ellipsis"></i>
                                                </a>

                                                <ul class="dropdown-menu" aria-labelledby="cmtAction">
                                                    <li>
                                                        <a class="dropdown-item delCmtBtn"
                                                            href="{{ route('user#comment_del', $comment->id) }}"><i
                                                                class="fa-solid fa-trash"></i>
                                                            <span language='eng'>Remove</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <div>
                                <p class=" text-muted bg-dark p-2 rounded">{{ $comment->comment }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="mt-3">{{ $comments->links() }}</div>
            </div>
            @if (Auth::user())
            <div class="col-md-4 my-4 align-items-center">
                <form action="{{ route('user#comment_add', $movie->id) }}" class="commentForm" method="POST">
                    @csrf
                    <!-- Comment Input -->
                    <label class="form-label" for="form1"><span language="eng">Entert Comment</span></label>
                    <textarea type="search" minlength="5" required id="form1" name="comment"
                        class="form-control @error('comment') is-invalid @endif" rows="4"></textarea>
                @error('comment')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <!-- Rating -->
                <div class="mt-3">
                    <label class="form-label" for="customRange1"><span language="eng">Rating</span></label>
                    <input type="range" required min="1" max="4" name="rating" class="form-range cmtRating d-none" autocompleted="none" value="3">
                </div>
                <div class="d-flex ratingIconContainer justify-content-around fs-3 text-warning">
                    <p><i class="ratIcon-1 fa-solid fa-face-frown rounded rounded-circle"></i></p>
                    <p><i class="ratIcon-2 fa-solid fa-face-meh rounded rounded-circle"></i></p>
                    <p><i class="ratIcon-3 fa-solid fa-face-smile-beam rounded rounded-circle border border-4 scaletwo"></i></p>
                    <p><i class="ratIcon-4 fa-solid fa-face-grin-hearts rounded rounded-circle"></i></p>
                </div>
                <p class="text-end">Rating : <span id="ratText"><span language="eng">good</span></span></p>
                <!-- Submit button -->
                        <button type="submit" class="btn btn-primary btn-block mt-2"><i class="fa-solid fa-paper-plane"></i><span language="eng">Send</span></button>
                          </form>
            </div>
            @endif
        </div>
    </div>
@endsection

    @push('scripts')
    <script>
        let _token = '{{ csrf_token() }}';
        $(document).ready(function() {
            ratingFunction();
            //Comment Submit Form
            $('.commentForm').submit(function(e) {
                e.preventDefault();
                let comment = $(this).find('textarea[name="comment"]').val();
                let rating = $(this).find('input[name="rating"]').val();
                $.ajax({
                    type: "POST",
                    url: "{{ route('user#comment_add', $movie->id) }}",
                    data: {
                        comment,
                        rating,
                        _token
                    },
                    dataType: "JSON",
                    success: function(data) {
                        if (data.success) {
                            Alert(data);
                        }
                        $('.commentForm').find('textarea[name="comment"]').val('');
                        reload();
                    }
                });
            });

            //Comment Delete
            $(".delCmtBtn").click(function(e) {
                e.preventDefault();
                route = $(this).attr("href");
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "GET",
                            url: route,
                            data: {
                                destory: true
                            },
                            dataType: "JSON",
                            success: function(data) {
                                Alert(data);
                                reload()
                            },
                        });
                    }
                });
            });
        });


        let reload = () => {
            setTimeout(() => {
                location.reload()
            }, 1000);
        }
    </script>
@endpush
