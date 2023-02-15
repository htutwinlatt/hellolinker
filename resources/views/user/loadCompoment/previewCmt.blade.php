@foreach ($comments as $comment)
<div class="row bg-dark rounded m-1">
    <div class="p-2 rounded">
        <div>
            <img src="{{ asset('storage/profile_photos/' . $comment->user_info->profile_photo_path) }}" class="rounded rounded-circle" width="30px" height="30px" alt="">
            <span>{{ $comment->user_info->name }}</span>
            <div class=" float-end">
                @for ($a = 0; $a < 4; $a++) <i class="fa-solid fa-star @if ($a < $comment->rating) text-warning @endif"></i>
                    @endfor
                    <!-- Cmt Action Btn-->
                    @if (!empty(Auth::user()))
                    @if (Auth::user()->id == $comment->user_id || Auth::user()->role == 'admin')
                    <div class="dropdown d-inline">
                        <a class="btn btn-dark text-light btn-sm " title="more" href="#" role="button" id="cmtAction" data-mdb-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-ellipsis"></i>
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="cmtAction">
                            <li>
                                <a class="dropdown-item delCmtBtn" href="{{ route('user#comment_del', $comment->id) }}"><i class="fa-solid fa-trash"></i>
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
@if ($totalCmt > 3)
<a href="{{ route('user#movie_comments', $id) }}" class="d-block text-end"><span><span language="eng">More</span>.....</span></a>
@endif
@if ($totalCmt == 0)
<div class="w-100 text-uppercase    "><span language='eng'>There is no comments for this
        movie.</span></div>
@endif
<script>
    selLanguage();
    //comment delete
    $(".delCmtBtn").click(function (e) {
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
                    data: { destory: true },
                    dataType: "JSON",
                    success: function (data) {
                        Alert(data);
                        getComments();
                    },
                });
            }
        });
    });
</script>
