<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\User\UpdateRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\User::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/user');
        CRUD::setEntityNameStrings('user', 'users');
        CRUD::denyAccess(['create', 'delete']);
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addColumn(['name' => 'email', 'label' => 'Адрес почты', 'type' => 'email']);
        CRUD::addColumn(['name' => 'username', 'label' => 'Никнейм', 'type' => 'text']);
        CRUD::addColumn(['name' => 'name', 'label' => 'Имя', 'type' => 'text']);
        CRUD::addColumn(['name' => 'is_blocked', 'label' => 'Заблокирован', 'type' => 'boolean']);
        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        CRUD::setValidation(UpdateRequest::class);

        CRUD::addField([
            'name' => "username",
            'label' => "Никнейм",
            'type' => 'text',
        ]);
        CRUD::addField([
            'name' => "name",
            'label' => "Имя",
            'type' => 'text',
        ]);
        CRUD::addField([
            'name' => 'is_blocked',
            'label' => "Заблокирован",
            'type' => 'checkbox',
        ]);

    }
}
