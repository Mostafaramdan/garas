<?php

namespace App\DataTables;


class AdabterTeacherDataTable extends TeacherDataTable
{
    public 
           $viewPath='pages.waiting_classrooms.',
           $routeNamePrefix='waiting_classrooms.';
    
    /**
     * Get columns.
     *
     * @return array
     */
    public function getColumns() :array
    {
        return [
            'name',
            'created_at',
        ];
    }
}
