<?php

namespace App\DataTables;

use App\Models\subscriptions as model;

class SubscriptionsDataTable
{
    public $model,$currentPage,
           $itemsPerPage=20,
           $sortBy,
           $sortType,
           $activeStatusName='is_active',
           $viewPath='pages.subscriptions.',
           $routeNamePrefix='subscriptions.';
    protected
        $actionsColumns = [
            'create',
            'edit',
            'delete',
            'show',
        ],
        $searchableColumns = [
            'subscribed_at',
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
            'routeNamePrefix'=>$this->routeNamePrefix
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
            ->with(['school','package'])
            ->when(request()->keyword,function($q){
                return $q->where(function($q){
                    return   $q->Where('subscribed_at', 'like', "%" . request()->keyword . "%");
                })
                ->with(['school' => function($query){
                    $keyword= request()->keyword;
                        return $query->where('name', 'like', '%'.$keyword.'%')
                                ->orWhere("user_name", 'like', '%'.$keyword.'%')
                                ->orWhere("phone", 'like', '%'.$keyword.'%');
                }])
                ->with(['packege' => function($query) use ($searchString){
                    $keyword= request()->keyword;
                        return  $query->where('name_ar', 'like', '%'.$keyword.'%')
                                       ->orWhere('name_en', 'like', '%'.$keyword.'%');
                }]);
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
            'subscribed_at',
            'end_at',
        ];
    }
}
