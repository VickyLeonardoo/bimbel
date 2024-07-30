@extends('partials.admin.header')
@section('content')
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table-order" class="table table-striped" style="width: 100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Application Date</th>
                                        <th>Year</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->reg_no }}</td>
                                            <td>{{ $order->user->name }}</td>
                                            <td>{{ Carbon\Carbon::parse($order->created_at)->format('d F Y') }}</td>
                                            <td>{{ $order->year->name }}</td>
                                            <td>
                                                @if ($order->status == 'draft')
                                                    <span class="badge bg-warning">Draft</span>
                                                @elseif ($order->status == 'confirmed')
                                                    <span class="badge bg-primary">Pending</span>

                                                @elseif ($order->status == 'payment_received')
                                                    <span class="badge bg-success">Payment Receive</span>
                                                @else
                                                    <span class="badge bg-danger">Cancelled</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.transaction.show', $order->id) }}" class="badge bg-info">Check</a>
                                            </td> 
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        // Inisialisasi DataTable
        var table = $('#table-order').DataTable({
            "responsive": true,
            "autoWidth": false,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "Semua"]
            ],
            "order": [[0, 'desc']]
        });

        // Tambahkan checkbox kustom di atas dropdown "Show X entries"
        $("#table-order_length").before(`
            <label style="margin-bottom: 10px; display: block;">
                <input type="checkbox" id="archiveCheckbox"> See Archive
            </label>
        `);

        // Fungsi untuk mendapatkan URL tanpa parameter tertentu
        function removeURLParameter(url, parameter) {
            var urlparts = url.split('?');
            if (urlparts.length >= 2) {
                var prefix = encodeURIComponent(parameter) + '=';
                var pars = urlparts[1].split(/[&;]/g);

                // Filter out the parameter we want to remove
                for (var i = pars.length; i-- > 0;) {
                    if (pars[i].lastIndexOf(prefix, 0) !== -1) {
                        pars.splice(i, 1);
                    }
                }

                url = urlparts[0] + (pars.length > 0 ? '?' + pars.join('&') : '');
                return url;
            } else {
                return url;
            }
        }

        // Tangani acara klik checkbox
        $('#archiveCheckbox').on('change', function() {
            if ($(this).is(':checked')) {
                // Jika checkbox dicentang, arahkan ke URL dengan parameter
                window.location.href = '{{ url()->current() }}?archive=true';
            } else {
                // Jika checkbox tidak dicentang, arahkan ke URL tanpa parameter
                window.location.href = removeURLParameter(window.location.href, 'archive');
            }
        });

        // Periksa jika URL memiliki parameter 'archive', centang checkbox
        if (new URLSearchParams(window.location.search).has('archive')) {
            $('#archiveCheckbox').prop('checked', true);
        }
    });
</script>

@endsection

