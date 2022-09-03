<?php
namespace App\DataTables;

use App\Models\schools as model;

class SchoolDataTable extends DataTable
{
    // 
    public $resourceName='schools';
    public function __construct(model $model) 
    {
        $this->model = $model ;
		parent::__construct();
        $this->query= $this->query
            ->without(['class_rooms_in_days','grade_subject','subjects','stages'])
            ->where(function($q){
                $q->when(request()->filterSubscription,function($q){
                    return $q->where(function($q){
                        return $q->whereHas('lastSubscription',function($q){
                            $filterSubscription= request()->filterSubscription;
                            $chech= $filterSubscription=='current'?'>=':'<';
                            return $q->where('end_at',$chech,date('Y-m-d'));

                        });
                    });
                });

            });
    }
    public function getColumns() :array
    {
        
        return [
            'name',
            'phone',
            'user_name',
            'country'
        ];
    }
    
}
