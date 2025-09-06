<script type="text/javascript">
    $(document).on("change", "select.filter-ranking", function () {
        let c = $(this).val();
        let url = "{{route('rankings.filter')}}";
        $.ajax({
            url: url,
            method: "GET",
            data: {
                "class": c,
            },
            success: function (response) {
                if (response) {
                    $("#filter-player-result").html(response);
                }
            },
        })
    });

    $("a.top-by-type").on('click', function (e) {
        let type = $(this).data('type');
        let url = "{{route('rankings.getTypeRanking')}}";
        $.ajax({
            url: url,
            method: "GET",
            data: {
                "type": type,
            },
            success: function (response) {
                if (response) {
                    $("#ranking-result-content").html(response);
                }
            },
        })
    });

</script>
