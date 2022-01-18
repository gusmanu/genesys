<?php

namespace App\DataTables;

use App\Inventory;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class InventoryDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('checkbox', function (Inventory $inventory) {
                return '<div class="custom-checkbox custom-control">
                            <input type="checkbox" onChange="myCheckFunction(this)" data-id="' . $inventory->inventory_id . '" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-' . $inventory->inventory_id . '">
                            <label for="checkbox-' . $inventory->inventory_id . '" class="custom-control-label">&nbsp;</label>
                        </div>';
            })
            ->addColumn('action', function (Inventory $inventory) {
                return '<a href="' . route('edit', $inventory->inventory_id) . '" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a>';
            })
            ->editColumn('created_at', '{{\Carbon\Carbon::parse($created_at, "UTC")->setTimezone("Asia/Jakarta")->format("d-m-Y H:i")}}')
            ->rawColumns(['action', 'checkbox']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Inventory $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Inventory $model)
    {
        $request = request()->all();
        $model = $model->select('*');
        if (isset($request['date_min']) and $request['date_min'] !== null) {
            try {
                $date_min = Carbon::createFromFormat('Y-m-d', $request['date_min'], 'Asia/Jakarta')->setTimezone('UTC');
                if ($date_min) {
                    $date_min = $date_min->startOfDay()->toDateTimeString();
                    $model = $model->where('created_at', '>=', $date_min);
                }
            } catch (\Exception $e) {
            }
        }

        if (isset($request['date_max']) and $request['date_max'] !== null) {
            try {
                $date_max = Carbon::createFromFormat('Y-m-d', $request['date_max'], 'Asia/Jakarta')->setTimezone('UTC');
                if ($date_max) {
                    $date_max = $date_max->endOfDay()->toDateTimeString();
                    $model = $model->where('created_at', '<=', $date_max);
                }
            } catch (\Exception $e) {
            }
        }

        return $model;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('inventorydatatable-table')
                    ->columns($this->getColumns())
                    ->ajax([
                        'url' => route('index'),
                        'type' => 'GET',
                        'data' => 'function(d) { d.date_min = $("#min").val(); d.date_max = $("#max").val();}',
                    ])
                    ->dom('lBfrtip')
                    ->orderBy(6)
                    ->parameters([
                        'stateSave' => true,
                        'stateSaveParams' => "function(settings, data) { 
                            data.min_date = $('#min').val();
                            data.max_date = $('#max').val();
                        }",
                        'stateLoadParams' => "function(settings, data) {
                            $('#min').val(data.min_date);
                            $('#max').val(data.max_date);
                            }",
                        'buttons' => [
                            'create', 'excel', 'reload', [
                                'text' => '<i class="fa fa-trash"></i> ' . 'Delete',
                                'className' => 'delete-button',
                                'action' => 'function(){myDeleteFunction()}'
                            ]
                        ],
                        'lengthMenu' => [5, 10, 25, 50],
                        'language' => [
                            'url' => '//cdn.datatables.net/plug-ins/1.11.3/i18n/id.json',
                        ],
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('checkbox')->title('<div class="custom-checkbox custom-control">
                                                <input type="checkbox" onChange="myCheckFunction(this)" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                                                <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                            </div>')
                ->searchable(false)
                ->orderable(false)
                ->exportable(false),
            Column::make('inventory_id'),
            Column::make('nama'),
            Column::make('harga'),
            Column::make('stok'),
            Column::make('created_at')->title('Dibuat'),
            Column::make('action')
            ->searchable(false)
            ->orderable(false)
            ->exportable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Inventory_' . date('YmdHis');
    }
}
