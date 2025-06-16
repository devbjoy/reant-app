<?php

namespace App\Livewire\Admin\Datatable\Permission;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Permission;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use function Laravel\Prompts\search;

class TrashedTable extends DataTableComponent
{
    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }
    public function builder(): Builder
    {
        return Permission::onlyTrashed()->latest();
    }
    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable()
                ->searchable(),
            Column::make('Status', 'status')
                ->sortable()
                ->format(function ($value, $row, $column) {
                    if ($value == 1) {
                        return '<button
                          class="bg-success-50 text-theme-xs text-success-600 dark:bg-success-500/15 dark:text-success-500 rounded-full px-2 py-0.5 font-medium">
                          Active
                        </button>';
                    } else {
                        return ' <button
                          class="bg-red-50 text-theme-xs text-red-600 dark:bg-success-500/15 dark:bg-text-red-500 rounded-full px-2 py-0.5 font-medium">
                          Block
                        </button>';
                    }
                })
                ->html(),
            Column::make("Created at", "created_at")
                ->sortable()
                ->format(function ($value) {
                    return Carbon::parse($value)->format('d-m-Y');
                }),

            Column::make("Updated at", "updated_at")
                ->sortable()
                ->format(function ($value) {
                    return Carbon::parse($value)->format('d-m-Y');
                }),
            Column::make("Actions")
                ->label(function ($row) {
                    return view('admin.partials.trash-action', ['row' => $row]);
                })
                ->html()
        ];
    }
}
