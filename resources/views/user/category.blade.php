@extends('layouts.master')
@section('title')
    Category
@endsection

@section('content')
    <div class="container">
        <div class="row my-5 py-5">
            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4711089720936751"
                crossorigin="anonymous"></script>
            <!-- New Box Ads -->
            <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-4711089720936751" data-ad-slot="6565579201"
                data-ad-format="auto" data-full-width-responsive="true"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
            <div class="my-3 px-4">
                <input type="text" id="catSearchInput" class="form-control">
            </div>
            <div class="catContiner">

            </div>
            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4711089720936751"
                crossorigin="anonymous"></script>
            <!-- New Box Ads -->
            <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-4711089720936751"
                data-ad-slot="6565579201" data-ad-format="auto" data-full-width-responsive="true"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let categories = [];
        $(document).ready(function() {
            $('.nav-category').addClass('active');
            get_category();
            $('#catSearchInput').keyup(function() {
                let value = $(this).val().toLowerCase();
                if (value.length > 0) {
                    let filter_array = categories.filter((e) => e.includes(value))
                    category_list(filter_array)
                } else {
                    category_list(categories)
                }
            });
        });

        function category_list(arr) {
            $('.catContiner').html('');
            for (let i = 0; i < arr.length; i++) {
                $('.catContiner').append('<a href="{{ url('category/search') }}/' + arr[i] +
                    '" class="btn btn-primary m-1">' + arr[i] + '</a>')
            }
        }

        function get_category() {
            $.ajax({
                type: "GET",
                url: "{{ route('user#category_list') }}",
                data: {},
                dataType: "JSON",
                success: function(response) {
                    let myarray = [];
                    response.forEach(e => {
                        const array = e.type.split(',')
                        array.forEach(category => {
                            if (category.length > 0) {
                                myarray.push(category.toLowerCase().trim());
                            }
                        });
                    });
                    categories = removeDuplicateArray(myarray).sort();
                    category_list(categories);
                }
            });
        }
    </script>
@endpush
