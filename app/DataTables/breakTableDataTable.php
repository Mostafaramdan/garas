<?php

namespace App\DataTables;

use App\Models\breaks as model;

class breakTableDataTable
{
    public $model,$currentPage,
           $itemsPerPage=20,
           $sortBy,
           $sortType,
           $activeStatusName='is_active',
           $viewPath='pages.breaks.',
           $routeNamePrefix='breaks.';
    protected
        $actionsColumns = [
            'create',
            'edit',
            'delete',
            'show',
            'activeStatus'
        ],
        $searchableColumns = [
            'time'
        ];

    public function __construct(model $model)
    {
        $this->model = $model ;
        $this->itemsPerPage= request()->itemsPerPage??$this->itemsPerPage;
        $this->currentPage= ((int)request()->page )?  (int)request()->page : 1;
        $this->sortType= request()->sortType??'desc';
        $this->sortBy= request()->sortBy??'id';
    }

    /**
     * Build tableInfo .
     *
     * @param mixed $query Results from query() method.
     * @return string
     */


    public function main() : string
    {
        return (string) view($this->viewPath.'main',[
            'module'=>$this,
            'columns'=>$this->getColumns(),
            'routeNamePrefix'=>$this->routeNamePrefix,
        ]);
    }
    /**
     * Build tableInfo .
     *
     * @param mixed $query Results from query() method.
     * @return string
     */


    public function tableInfo() : string
    {
        return (string) view($this->viewPath.'tableinfo',[
            'records'=>$this->queryResult(),
            'columns'=>$this->getColumns(),
            'routeNamePrefix'=>$this->routeNamePrefix,
            'model'=>$this->model->getTable()
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */

    public function query()
    {
        return $this->model
            ->when(request()->keyword,function($q){
                return $q->where(function($q){
                    foreach($this->searchableColumns as $col){
                        $q->orWhere($col, 'like', "%" . request()->keyword . "%");
                    }
                    return $q;
                });
        })->orderBy($this->sortBy,$this->sortType);
    }
    public function queryResult()
    {
        return $this->query()
                    ->forPage($this->currentPage,$this->itemsPerPage)
                    ->get();
    }
    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function paginationHtml() :string
    {
        $recordsCount= $this->query()->count();
        $totalPages= ceil($recordsCount/$this->itemsPerPage);
        return (string) view('buttons.pagination',['totalPages'=>$totalPages,'currentPage'=>$this->currentPage]);

    }

    /**
     * Get columns.
     *
     * @return array
     */
    public function getColumns() :array
    {
        return [
            'after_class_room',
            'time',
        ];
    }
    public function getSortBy() :array
    {
        return [
            'day',
            'class_number'
        ];
    }
}
