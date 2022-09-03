<?php

namespace App\DataTables;

use Illuminate\Database\Eloquent\Builder;

class DataTable
{
    public $query,$model,$currentPage,
           $itemsPerPage=20,
           $sortBy,
           $sortType,
           $viewPath='pages.school_timetables.',
           $routeNamePrefix='school_timetables.',
           $togglableColumns = [
               'is_active',
           ];
    private
        $actionsColumns = ['create','edit','delete','show'],
        $searchableColumns = [
            'created_at',
        ];

    public function __construct()
    {
        $this->itemsPerPage= request()->itemsPerPage??$this->itemsPerPage;
        $this->currentPage= ((int)request()->page )?  (int)request()->page : 1;
        $this->sortType= request()->sortType??'desc';
        $this->sortBy= request()->sortBy??'id';
        $this->viewPath= config('app.dashboardFolder').'.'.$this->resourceName.'.';
        $this->routeNamePrefix= $this->resourceName.'.';
        $this->query= $this->query();
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
            'model'=>$this->model->getTable(),
            "togglableColumns"=>$this->togglableColumns
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */

    public function query(): Builder
    {
        return $this->model
            ->when(request()->keyword,function($q){
                return $q->where(function($q){
                    foreach($this->searchableColumns as $col){
                        $q->orWhere($col, 'like', "%" . request()->keyword . "%");
                    }
                    return $q;
                });
        })
        ->orderBy($this->sortBy,$this->sortType);
    }
    public function queryResult()
    {
        return $this->query
                    ->forPage($this->currentPage,$this->itemsPerPage)
                    ->get();
    }
    /**
     * paigination html of this resource.
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
            'created_at',
        ];
    }
}
