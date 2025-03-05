<!-- Required vendors -->
<script src="{{ asset('') }}assets/vendor/global/global.min.js"></script>
<script src="{{ asset('') }}assets/vendor/chart.js/Chart.bundle.min.js"></script>
<script src="{{ asset('') }}assets/vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>

<!-- Datatable -->
<script src="{{ asset('') }}assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('') }}assets/js/plugins-init/datatables.init.js"></script>

<!-- Dashboard 1 -->
<script src="{{ asset('') }}assets/js/dashboard/dashboard-1.js"></script>
<script src="{{ asset('') }}assets/js/dashboard/dashboard-4.js"></script>
<!-- Apex Chart -->
<script src="{{ asset('') }}assets/vendor/apexchart/apexchart.js"></script>
<script src="{{ asset('') }}assets/vendor/swiper/js/swiper-bundle.min.js"></script>
<script src="{{ asset('') }}assets/vendor/webticker/jquery.webticker.min.js"></script>
{{-- <script src="../../s3.tradingview.com/tv.js"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.1/nouislider.min.js"></script> --}}

{{-- <script src="../../cdnjs.cloudflare.com/ajax/libs/wnumb/1.2.0/wNumb.min.js"></script> --}}

<script src="{{ asset('') }}assets/vendor/raphael/raphael.min.js"></script>
<script src="{{ asset('') }}assets/vendor/morris/morris.min.js"></script>

<script src="{{ asset('') }}assets/js/custom.js"></script>
<script src="{{ asset('') }}assets/js/deznav-init.js"></script>
<script src="{{ asset('') }}assets/js/demo.js"></script>
<script src="{{ asset('') }}assets/js/styleSwitcher.js"></script>
{{-- <script src="{{ asset('') }}assets/js/dashboard/tradingview-1.js"></script> --}}


<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script defer>
    $(document).ready(function() {
        var table = $('#mytable').DataTable({
            "paging": true,
            "searching": true,
            "info": true,
            "lengthChange": false,
            "pageLength": 3,
            "dom": 'rtip', // Menghilangkan default search box
            "language": {
                "paginate": {
                    "previous": "<",
                    "next": ">"
                }
            }
        });

        $('#tableSearch').on('keyup', function() {
            table.search(this.value).draw();
        });
    });
</script>
<script defer>
    $(document).ready(function() {
        var table = $('#rekaptable').DataTable({
            "paging": false,
            "searching": true,
            "info": true,
            "lengthChange": false,
            "dom": 'rtip'
        });

        $('#tableSearch').on('keyup', function() {
            table.search(this.value).draw();
        });

        $('#filterSelect').on('change', function() {
            if ($(this).val() === "month") {
                $('#monthPicker').fadeIn(300);
            } else {
                $('#monthPicker').fadeOut(300);
                applyFilter();
            }
        });

        $('#monthPicker').on('change', function() {
            applyFilter();
        });

        function applyFilter() {
            var filterValue = $('#filterSelect').val();
            var selectedMonth = $('#monthPicker').val();
            var today = new Date();

            table.rows().every(function() {
                var row = this.node();
                var dateText = $(row).find("td:nth-child(4)").text().trim();
                var rowDate = parseDate(dateText);
                if (!rowDate) {
                    $(row).show();
                    return;
                }

                var showRow = false;
                if (filterValue === "day") {
                    showRow = (rowDate.toDateString() === today.toDateString());
                } else if (filterValue === "week") {
                    var oneWeekAgo = new Date();
                    oneWeekAgo.setDate(today.getDate() - 7);
                    showRow = (rowDate >= oneWeekAgo && rowDate <= today);
                } else if (filterValue === "month") {
                    if (selectedMonth) {
                        var selectedYear = parseInt(selectedMonth.split('-')[0]);
                        var selectedMonthNum = parseInt(selectedMonth.split('-')[1]) - 1;
                        showRow = (rowDate.getFullYear() === selectedYear && rowDate.getMonth() ===
                            selectedMonthNum);
                    } else {
                        var thisMonth = today.getMonth();
                        var thisYear = today.getFullYear();
                        showRow = (rowDate.getFullYear() === thisYear && rowDate.getMonth() ===
                            thisMonth);
                    }
                } else {
                    showRow = true;
                }
                $(row).toggle(showRow);
            });
        }

        function parseDate(dateText) {
            var parts = dateText.split('/');
            if (parts.length === 3) {
                return new Date(parts[2], parts[1] - 1, parts[0]);
            } else if (!isNaN(Date.parse(dateText))) {
                return new Date(dateText);
            }
            return null;
        }
    });
</script>


<script defer>
    document.getElementById('increment-1').addEventListener('click', function() {
        var quantityInput = document.getElementById('quantity-1');
        var quantity = parseInt(quantityInput.value);
        quantityInput.value = quantity + 1;
    });

    document.getElementById('decrement-1').addEventListener('click', function() {
        var quantityInput = document.getElementById('quantity-1');
        var quantity = parseInt(quantityInput.value);
        if (quantity > 1) {
            quantityInput.value = quantity - 1;
        }
    });
</script>
