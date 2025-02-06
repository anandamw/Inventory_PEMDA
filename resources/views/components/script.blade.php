<!-- Required vendors -->
<script src="{{ asset('') }}assets/vendor/global/global.min.js"></script>
<script src="{{ asset('') }}assets/vendor/chart.js/Chart.bundle.min.js"></script>
<script src="{{ asset('') }}assets/vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>

    <!-- Datatable -->
    <script src="{{ asset('')}}assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('')}}assets/js/plugins-init/datatables.init.js"></script>

<!-- Dashboard 1 -->
<script src="{{ asset('') }}assets/js/dashboard/dashboard-1.js"></script>
<!-- Apex Chart -->
<script src="{{ asset('') }}assets/vendor/apexchart/apexchart.js"></script>
<script src="{{ asset('') }}assets/vendor/swiper/js/swiper-bundle.min.js"></script>
<script src="../../s3.tradingview.com/tv.js"></script>
<script src="../../cdnjs.cloudflare.com/ajax/libs/wnumb/1.2.0/wNumb.min.js"></script>
<script src="../../cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.js"></script>
<script src="{{ asset('') }}assets/vendor/raphael/raphael.min.js"></script>
<script src="{{ asset('') }}assets/vendor/morris/morris.min.js"></script>

<script src="{{ asset('') }}assets/js/custom.js"></script>
<script src="{{ asset('') }}assets/js/deznav-init.js"></script>
<script src="{{ asset('') }}assets/js/demo.js"></script>
<script src="{{ asset('') }}assets/js/styleSwitcher.js"></script>
<script src="{{ asset('') }}assets/js/dashboard/tradingview-1.js"></script>



<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
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
<script>
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
