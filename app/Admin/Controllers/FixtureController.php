<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Fixture;

class FixtureController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Fixture';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Fixture());
        
        $grid->disableRowSelector();

        //$grid->column('id', __('Id'));

        $grid->column('campeonato.nombre', __('Campeonato'));
        $grid->column('cancha.nombre', __('Cancha'));

        $grid->column('divicion', __('Divicion'));
        $grid->column('zona', __('Zona'));
        $grid->column('fecha_num', __('Fecha num'));
        $grid->column('fecha', __('Fecha'));
        $grid->column('hora', __('Hora'));
        $grid->column('equipo_local', __('Local'));
        $grid->column('equipo_visitante', __('Visitante'));
        $grid->column('goles_equipo_local', __('Goles equipo local'));
        $grid->column('goles_equipo_visitante', __('Goles equipo visitante'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Fixture::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('campeonato_id', __('Campeonato id'));
        $show->field('cancha_id', __('Cancha id'));
        $show->field('divicion', __('Divicion'));
        $show->field('zona', __('Zona'));
        $show->field('fecha_num', __('Fecha num'));
        $show->field('fecha', __('Fecha'));
        $show->field('hora', __('Hora'));
        $show->field('equipo_local', __('Equipo local'));
        $show->field('equipo_visitante', __('Equipo visitante'));
        $show->field('goles_equipo_local', __('Goles equipo local'));
        $show->field('goles_equipo_visitante', __('Goles equipo visitante'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Fixture());

        $form->number('campeonato_id', __('Campeonato id'));
        $form->number('cancha_id', __('Cancha id'));
        $form->text('divicion', __('Divicion'));
        $form->text('zona', __('Zona'));
        $form->number('fecha_num', __('Fecha num'));
        $form->date('fecha', __('Fecha'))->default(date('Y-m-d'));
        $form->switch('hora', __('Hora'));
        $form->text('equipo_local', __('Equipo local'));
        $form->text('equipo_visitante', __('Equipo visitante'));
        $form->number('goles_equipo_local', __('Goles equipo local'));
        $form->number('goles_equipo_visitante', __('Goles equipo visitante'));

        return $form;
    }
}
