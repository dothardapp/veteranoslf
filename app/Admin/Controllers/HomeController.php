<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use OpenAdmin\Admin\Admin;
use OpenAdmin\Admin\Controllers\Dashboard;
use OpenAdmin\Admin\Layout\Column;
use OpenAdmin\Admin\Layout\Content;
use OpenAdmin\Admin\Layout\Row;

class HomeController extends Controller
{
    public function index(Content $content)
    {

        /*return $content->row(function (Row $row) {

            $row->column(4, 'xxx');
        
            $row->column(8, function (Column $column) {
                $column->row('111');
                $column->row('222');
                $column->row(function(Row $row) {
                    $row->column(6, '444');
                    $row->column(6, '555');
                });
            });
        });*/

        return $content
            ->css_file(Admin::asset("open-admin/css/pages/dashboard.css"))
            ->title('Panel de inicio')
            ->description('Contenido...')
            ->row(Dashboard::title())
            ->row(function (Row $row) {

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::environment());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::extensions());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::dependencies());
                });

                
            });

        // Fill the page body part, you can put any renderable objects here        
    }
}
