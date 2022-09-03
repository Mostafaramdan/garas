<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CreateUpdateClassRequest;
use Illuminate\Http\Request;
use App\DataTables\contactDataTable;
use App\Models\contacts as model;

class ContactController extends contactDataTable
{

    /**
     * Display a listing of the resource.
     * @return
     */
    public function index(contactDataTable $module)
    {
        return  request()->ajax() ?
                $module->main():
                view($this->viewPath.'index', compact('module')) ;
    }
    

    public function show(model $contact)
    {
        $record= $contact;
        return view($this->viewPath.'show', compact('record'));
    }

}

