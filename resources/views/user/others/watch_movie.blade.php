@extends('layouts.master')

@section('title')
{{ $movie->name }} - Hello Linker
@endsection
@section('styles')
<style>
    .downloadBtnContainer {
        z-index: 10
    }
</style>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row my-3">
        <div class="col-md-3">
            <div class="forBoxAds">

            </div>
        </div>
        <span id="episodesText" class="d-none">{{ $movie->episodes }}</span>
        <div class="col-md-6 my-2">
            <h5>{{ $movie->name }} <span class="playingEp"></span></h5>
            <div id="movieIframeContainer">
                {{-- <iframe id="movieIframe" src="" class="w-100" height="480" allow="autoplay"></iframe> --}}
            </div>

            <h5 class="">Please Scrolldown to get download link.</h5>
        </div>
        <div class="col-md-3">

        </div>
        <div class="col-md-3">

        </div>
        <div class="col-md-6 text-center  my-1">
            <div class="forBoxAds">

            </div>
            <div class="position-relative">
                <div class="downloadBtnContainer my-3">
                    <button class="btn btn-primary downLoadingBtn" type="button" disabled>
                        <span class="spinner-border spinner-border-sm " role="status" aria-hidden="true"></span>
                        Download Link...<span class="downCount">
                            @if (Auth::user())
                            @if (Auth::user()->role == 'member' || Auth::user()->role == 'admin')
                            1
                            @endif
                            @else
                            11
                            @endif

                        </span>
                    </button>
                    <a href="#" class="btn btn-primary d-none downloadBtn mb-3"><i
                            class="fa-solid fa-cloud-arrow-down fs-3"></i> Download Movie Now</a>
                </div>
            </div>
            <div class="forBoxAds">

            </div>

        </div>
        <div class="col-md-3">
            <div class="forBoxAds">

            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    let watchLink = '';
        let downloadLink = '';
        $(document).ready(function() {
            // let downloadTime = localStorage.getItem('downloadTime');
            // if (!downloadTime) {
            //     localStorage.setItem('downloadTime', 0);
            //     downloadTime = 0;
            // }
            // if (downloadTime % 2 == 0) {
            //     $('.downloadBtnCoverAds').addClass('d-none');
            // }
            downloadTime++;
            localStorage.setItem('downloadTime', downloadTime)
            movieFrameLoading();
        });

        function getLink(movLink, originLink) {
            if (movLink[2].includes("drive.google") && !originLink.includes('folders')) {
                watchLink = 'https://drive.google.com/file/d/' + movLink[5] + '/preview';
                downloadLink = 'https://drive.google.com/uc?export=download&id=' + movLink[5];
                $('#movieIframeContainer').html(`<iframe id="movieIframe" src="` + watchLink +
                    `" class="w-100" height="310" allow="autoplay" allowfullscreen></iframe>`);
            } else {
                $('#movieIframeContainer').html(
                    '<h5 class="my-5 text-center">Cannot Direct Watch Movie! Scrolldown to get downloadlink.</h5>'
                );
                downloadLink = originLink;
            }
        }
</script>
@if ($movie->link != null && $movie->link != '')
<script>
    console.log('hello');
            let link = '{{ $movie->link }}'
            let movLink = link.split('/')
            getLink(movLink, link);
            $(document).ready(function() {
                let downCount = setInterval(() => {
                    let time = parseInt($('.downCount').html());
                    if (time == 0) {
                        clearInterval(downCount);
                        $('.downLoadingBtn').remove();
                        $('.downloadBtn').removeClass('d-none').attr('href', downloadLink);
                        return;
                    } else {
                        $('.downCount').html(time - 1)
                    }
                }, 1000);

                $('.downloadBtn').click(function() {

                })
            });
</script>
@elseif ($movie->episodes != null && $movie->episodes != '')
<script>
    let MovLinksEpisode = '';
            let episodes = $('#episodesText').html();
            let eparray = episodes.split('|');
            let downCount = setInterval(() => {
                let time = parseInt($('.downCount').html());
                if (time == 0) {
                    clearInterval(downCount);
                    $('.downLoadingBtn').remove();
                    getListUrl(eparray);
                    return;
                } else {
                    $('.downCount').html(time - 1)
                }
            }, 1000);

            function getListUrl(array) {
                $('.downloadBtnContainer').html('');
                let text = '<ul class="list-group">';
                for (let i = 0; i < array.length; i++) {
                    if (array[i].length > 4) {
                        let splitLink = array[i].split(',');
                        let link = splitLink[1];
                        movLink = link.split('/')
                        getLink(movLink, link);
                        text += `<li class="list-group-item text-light text-start"><span class="epName">` + splitLink[0] + `</span><span class="float-end">
                            <a href="` + downloadLink +
                            `" class="btn btn-link"><i class="fa-solid fa-cloud-arrow-down"></i> Download</a>`;
                        if (watchLink != '') {
                            text += `<button link="` + watchLink + `" class="btn btn-link watchBtnMovie"><i class="fa-solid fa-play"></i> Play</button>
                            </span></li>`;
                            $('#movieIframeContainer').html(
                                '<h5 class="mt-5 text-center">Please Click Play! Scrolldown to see the list.</h5>'
                            );
                        } else {
                            text += '</span></li>';
                        }
                    }
                }
                text += '</ul>';
                $('.downloadBtnContainer').html(text)
                watchBtnMovie()
            }

            function watchBtnMovie() {
                $('.watchBtnMovie').click(function() {
                    movieFrameLoading();
                    let link = $(this).attr('link');
                    console.log(link);
                    $('.watchBtnMovie').removeClass('d-none');
                    $('.watchBtnMovie[link="' + link + '"]').addClass('d-none');
                    $('#movieIframeContainer').html(`<iframe id="movieIframe" src="` + link +
                        `" class="w-100 " height="310z" allow="autoplay" allowfullscreen></iframe>`);
                    $('.playingEp').html($(this).closest('li').find('.epName').html());
                    $(window).scrollTop(0);
                })
            }

            function movieFrameLoading() {
                $('#movieIframeContainer').html(`<div style="height: 310px">
                        <div class="d-flex justify-content-center annimateLogo mt-5">
                            <img class=" rounded rounded-circle" src="{{ asset('user/img/linklogo.jpg') }}" height="100"
                                alt="">
                        </div>
                        <p class="placeholder-glow " >
                            <span class="placeholder col-6"></span>
                            <span class="placeholder col-7"></span>
                            <span class="placeholder col-3"></span>
                            <span class="placeholder col-3"></span>
                            <span class="placeholder col-6"></span>
                            <span class="placeholder col-8"></span>
                          </p>
                    </div>`)
            }
</script>
@endif
@endpush
