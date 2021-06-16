<?php

namespace App\Nova;

use App\Overrides\AttachManyCustom;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;

class User extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\User::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'email',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),


//            BelongsToMany::make('Primary', 'primary_department', Department::class),
            BelongsToMany::make('Departments', 'departments', Department::class)->fields(function () {
                return [
                    Boolean::make('Primary')->showOnIndex(fn() => true)
                        ->displayUsing(fn() => isset($this->pivot) ? $this->pivot->primary : null),
                ];
            }),
            AttachManyCustom::make('Departments', 'departments', Department::class),

            BelongsToMany::make('Permissions', 'permissions'),
            AttachManyCustom::make('Permissions', 'permissions', Permission::class),

            BelongsToMany::make('Roles', 'roles'),
            AttachManyCustom::make('Roles', 'roles', Role::class)
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }

    public function rolesSynced($changes, $rid)
    {

        if (count($changes['attached'])) {
            \App\Models\Role::whereIn('id', $changes['attached'])->each(fn($it) => \App\Models\User::find($rid)->track_given_role($it));
        }

        if (count($changes['detached'])) {
            \App\Models\Role::whereIn('id', $changes['attached'])->each(fn($it) => \App\Models\User::find($rid)->track_revoked_role($it));
        }

    }

    public function departmentsSynced($changes, $rid)
    {
        if (count($changes['attached'])) {
            \App\Models\Department::whereIn('id', $changes['attached'])->each(fn($it) => \App\Models\User::find($rid)->track_added_department($it));
        }

        if (count($changes['detached'])) {
            \App\Models\Department::whereIn('id', $changes['attached'])->each(fn($it) => \App\Models\User::find($rid)->track_removed_department($it));
        }
    }
}
