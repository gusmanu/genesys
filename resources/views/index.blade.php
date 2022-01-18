@extends('layout.table-base')

@section('table')
<div class="row">
    <div class="col-12">
        @include('layout.alert')
        <div class="card product">
            <div class="card-header">
                <h4>Inventory</h4>
            </div>
            <div class="card-body">
                <button id="btn-show-filter" data-status="hide" class="btn btn-outline-primary btn-sm collapsed"
                    style="margin-bottom: 5px;" type="button" data-toggle="collapse" data-target="#collapseFilter"
                    aria-expanded="false" aria-controls="collapseFilter">
                    Tampilkan Filter
                </button>
                <button id="btn-reset-filter" class="btn btn-outline-danger btn-sm" style="margin-bottom: 5px;"
                    type="button">
                    Reset Filter
                </button>            
                <div class="collapse" id="collapseFilter" style="">
                    <form class="form-inline">
                        <input type="text" value="" class="form-control form-control-sm mb-2 mr-sm-2" id="min"
                            name="min" placeholder="Date Min">
                        <div class="input-group mb-2 mr-sm-2">
                            <input type="text" value="" class="form-control form-control-sm" id="max" name="max"
                                placeholder="Date Max">
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-sm" id="inventorydatatable-table">
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('table-script')

    {{-- DataTable Build Script --}}
    {!! $dataTable->scripts() !!}

    {{-- DataTable Support & Filter Script --}}
    <script type="text/javascript">
        function deleteData(ids) {
            let csrf = $('meta[name=csrf-token]').attr('content')
            $.ajax({
                url: "{{ route('index') }}",
                type: "DELETE",
                dataType: "json",
                data: {
                    "_token": csrf,
                    "ids": ids
                },
                success: function (a) {
                    toastSuccess(a.message)
                    window.LaravelDataTables['inventorydatatable-table'].draw()
                },
                error: function (a, b, c) {
                    console.log(a)
                    toastError("Gagal Terhapus:" + a.message + "Status: " + b + "\n" + c);
                }
            })
        }

        $('#min, #max').daterangepicker({
            singleDatePicker: true,
            locale: {
                format: 'YYYY-MM-DD'
            },
            autoUpdateInput: false,
            drops: 'down',
            opens: 'right',
        }).on("apply.daterangepicker", function (e, picker) {
            picker.element.val(picker.startDate.format(picker.locale.format))
            window.LaravelDataTables['inventorydatatable-table'].draw()
        }).on('cancel.daterangepicker', function (ev, picker) {
            picker.element.val('')
            window.LaravelDataTables['inventorydatatable-table'].draw()
        })

        $('#btn-reset-filter').on('click', function () {
            $('#min').val('')
            $('#max').val('')
            $('input[type=search]').val('')
            window.LaravelDataTables['inventorydatatable-table'].search('')
            localStorage.removeItem('DataTables_inventorydatatable-table_/')
            window.LaravelDataTables['inventorydatatable-table'].draw()
        })
    </script>

@endpush