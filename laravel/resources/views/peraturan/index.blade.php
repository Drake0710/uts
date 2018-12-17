@extends('search')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div id="jar">
            
            @if(count($rows)>0)

                <h4 class="card-title">Hasil Pencarian untuk "{!! $_GET['q'] !!}"</h4>
                <h6 class="card-subtitle">Sekitar {{ $jml }} hasil <!-- ( 0.10 seconds) --></h6>

                <ul class="search-listing">
                
                @foreach($rows as $result)

                    <div id="search-result">
                        <li>
                            <h3>
                                <a href="{{ url('/search/peraturan/'.$result->id) }}">
                                    {!! highlightkeyword($result->no_peraturan, $_GET['q']) !!}
                                </a>
                            </h3>
                            <p>{!! highlightkeyword($result->tentang, $_GET['q']) !!}</p>
                        </li>
                    </div>

                @endforeach

                    <div class="pagination"></div>

                </ul>

            @else

                <h4 class="card-title">Hasil Pencarian untuk "{!! $_GET['q'] !!}" tidak ditemukan.</h4>

            @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    jQuery(document).ready(function(){
        
        // Number of items and limits the number of items per page
        var numberOfItems = $("#jar #search-result").length;
        var limitPerPage = 5;
        // Total pages rounded upwards
        var totalPages = Math.ceil(numberOfItems / limitPerPage);
        /* Number of buttons at the top, not counting prev/next, but including the dotted buttons.
           Must be at least 5: */
        var paginationSize = 10; 
        var currentPage;

        function showPage(whichPage) {
            if (whichPage < 1 || whichPage > totalPages) return false;
            currentPage = whichPage;
            $("#jar #search-result").hide()
                .slice((currentPage-1) * limitPerPage, 
                        currentPage * limitPerPage).show();
            // Replace the navigation items (not prev/next):
            $(".pagination li").slice(1, -1).remove();
            getPageList(totalPages, currentPage, paginationSize).forEach( item => {
                $("<li>").addClass("page-item")
                         .addClass(item ? "current-page" : "disabled")
                         .toggleClass("active", item === currentPage).append(
                    $("<a>").addClass("page-link").attr({
                        href: "javascript:void(0)"}).text(item || "...")
                ).insertBefore("#next-page");
            });
            // Disable prev/next when at first/last page:
            $("#previous-page").toggleClass("disabled", currentPage === 1);
            $("#next-page").toggleClass("disabled", currentPage === totalPages);
            return true;
        }

        // Include the prev/next buttons:
        $(".pagination").append(
            $("<li>").addClass("page-item").attr({ id: "previous-page" }).append(
                $("<a>").addClass("page-link").attr({
                    href: "javascript:void(0)"}).text("Prev")
            ),
            $("<li>").addClass("page-item").attr({ id: "next-page" }).append(
                $("<a>").addClass("page-link").attr({
                    href: "javascript:void(0)"}).text("Next")
            )
        );
        // Show the page links
        $("#jar").show();
        showPage(1);

        // Use event delegation, as these items are recreated later    
        $(document).on("click", ".pagination li.current-page:not(.active)", function () {
            return showPage(+$(this).text());
        });
        $("#next-page").on("click", function () {
            return showPage(currentPage+1);
        });

        $("#previous-page").on("click", function () {
            return showPage(currentPage-1);
        });

    });
</script>
@endsection