<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Permission;
use App\Permissions\DepartmentsPermissions;
use App\Permissions\UsersPermissions;
use Illuminate\Database\Seeder;

class DepartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * MAIN ROOT POLITIE
         */
        #Direcția Generală de Poliție Locală
        $directia_generala = Department::firstOrCreate(
            [
                'slug' => \Str::of('Direcția Generală de Poliție Locală')->slug(),
            ],
            [
                'name' => 'Direcția Generală de Poliție Locală',
                'has_children' => true
            ]
        );

        /**
         * FIRST CHILD - INSPECTIE SI CONTROL
         */
        #Direcția Inspecție și control
        $directia_inspectie = Department::firstOrCreate(
            [
                'slug' => \Str::of('Direcția Inspecție și control')->slug(),
            ],
            [
                'parent_id' => $directia_generala->id,
                'name' => 'Direcția Inspecție și control',
                'has_children' => true
            ]
        );

        /**
         *  GRAND KIDS / INSPECTIE KIDS
         */
        #Serviciul Disciplina în construcții și afișaj stradal
        Department::firstOrCreate(
            [
                'slug' => \Str::of('Serviciul Disciplina în construcții și afișaj stradal')->slug(),
            ],
            [
                'parent_id' => $directia_inspectie->id,
                'name' => 'Serviciul Disciplina în construcții și afișaj stradal',
                'has_children' => false
            ]
        );

        #Serviciul Control comercial
        Department::firstOrCreate(
            [
                'slug' => \Str::of('Serviciul Control comercial')->slug(),
            ],
            [
                'parent_id' => $directia_inspectie->id,
                'name' => 'Serviciul Control comercial',
                'has_children' => false
            ]
        );

        #Serviciul Protecția mediului
        Department::firstOrCreate(
            [
                'slug' => \Str::of('Serviciul Protecția mediului')->slug(),
            ],
            [
                'parent_id' => $directia_inspectie->id,
                'name' => 'Serviciul Protecția mediului',
                'has_children' => false
            ]
        );

        /**
         * FIRST CHILD - Ordine Publica
         */
        $directia_ordine_publica = Department::firstOrCreate(
            [
                'slug' => \Str::of('Direcția Ordine publică')->slug(),
            ],
            [
                'parent_id' => $directia_generala->id,
                'name' => 'Direcția Ordine publică',
                'has_children' => true
            ]
        );

        /**
         *  GRAND KIDS / Ordine Publica KIDS
         */
        $servicu_ordine_si_liniste = Department::firstOrCreate(
            [
                'slug' => \Str::of('Serviciul Ordine și liniște publică')->slug(),
            ],
            [
                'parent_id' => $directia_ordine_publica->id,
                'name' => 'Serviciul Ordine și liniște publică',
                'has_children' => true
            ]
        );

        /**
         *  2xGRAND KIDS / Serviciu Ordine Si Liniste KIDS
         */
        #Biroul 1 Ordine publică
        Department::firstOrCreate(
            [
                'slug' => \Str::of('Biroul 1 Ordine publică')->slug(),
            ],
            [
                'parent_id' => $servicu_ordine_si_liniste->id,
                'name' => 'Biroul 1 Ordine publică',
                'has_children' => false
            ]
        );

        #Biroul 2 Ordine publică
        Department::firstOrCreate(
            [
                'slug' => \Str::of('Biroul 2 Ordine publică')->slug(),
            ],
            [
                'parent_id' => $servicu_ordine_si_liniste->id,
                'name' => 'Biroul 2 Ordine publică',
                'has_children' => false
            ]
        );

        #Biroul 3 Ordine publică
        Department::firstOrCreate(
            [
                'slug' => \Str::of('Biroul 3 Ordine publică')->slug(),
            ],
            [
                'parent_id' => $servicu_ordine_si_liniste->id,
                'name' => 'Biroul 3 Ordine publică',
                'has_children' => false
            ]
        );

        /**
         * Grand Kids / Ordine Public Kids
         */
        #Biroul Inspecție zonală
        Department::firstOrCreate(
            [
                'slug' => \Str::of('Biroul Inspecție zonală')->slug(),
            ],
            [
                'parent_id' => $directia_ordine_publica->id,
                'name' => 'Biroul Inspecție zonală',
                'has_children' => false
            ]
        );

        #Biroul Evidența persoanelor și contravențiilor
        Department::firstOrCreate(
            [
                'slug' => \Str::of('Biroul Evidența persoanelor și contravențiilor')->slug(),
            ],
            [
                'parent_id' => $directia_ordine_publica->id,
                'name' => 'Biroul Evidența persoanelor și contravențiilor',
                'has_children' => false
            ]
        );

        #Compartiment Armament și bunuri confiscate
        Department::firstOrCreate(
            [
                'slug' => \Str::of('Compartiment Armament și bunuri confiscate')->slug(),
            ],
            [
                'parent_id' => $directia_ordine_publica->id,
                'name' => 'Compartiment Armament și bunuri confiscate',
                'has_children' => false
            ]
        );

        #Serviciul Dispecerat și monitorizare obiective
        Department::firstOrCreate(
            [
                'slug' => \Str::of('Serviciul Dispecerat și monitorizare obiective')->slug(),
            ],
            [
                'parent_id' => $directia_ordine_publica->id,
                'name' => 'Serviciul Dispecerat și monitorizare obiective',
                'has_children' => false
            ]
        );

        #Serviciul Intervenție rapidă
        Department::firstOrCreate(
            [
                'slug' => \Str::of('Serviciul Intervenție rapidă')->slug(),
            ],
            [
                'parent_id' => $directia_ordine_publica->id,
                'name' => 'Serviciul Intervenție rapidă',
                'has_children' => false
            ]
        );

        #Serviciul Circulația pe drumurile publice
        Department::firstOrCreate(
            [
                'slug' => \Str::of('Serviciul Circulația pe drumurile publice')->slug(),
            ],
            [
                'parent_id' => $directia_ordine_publica->id,
                'name' => 'Serviciul Circulația pe drumurile publice',
                'has_children' => false
            ]
        );

        /**
         *  KIDS / Direcția Deservire și suport general
         */
        $deservire_suport_general = Department::firstOrCreate(
            [
                'slug' => \Str::of('Direcția Deservire și suport general')->slug(),
            ],
            [
                'parent_id' => $directia_generala->id,
                'name' => 'Direcția Deservire și suport general',
                'has_children' => true
            ]
        );


        /**
         *  GRAND KIDS / Direcția Deservire și suport general KIDS
         */
        #Serviciul Siguranță și pază obiective
        Department::firstOrCreate(
            [
                'slug' => \Str::of('Serviciul Siguranță și pază obiective')->slug(),
            ],
            [
                'parent_id' => $deservire_suport_general->id,
                'name' => 'Serviciul Siguranță și pază obiective',
                'has_children' => false
            ]
        );

        #Serviciul Suport operativ
        Department::firstOrCreate(
            [
                'slug' => \Str::of('Serviciul Suport operativ')->slug(),
            ],
            [
                'parent_id' => $deservire_suport_general->id,
                'name' => 'Serviciul Suport operativ',
                'has_children' => false
            ]
        );

        #Biroul Planificare și control
        Department::firstOrCreate(
            [
                'slug' => \Str::of('Biroul Planificare și control')->slug(),
            ],
            [
                'parent_id' => $deservire_suport_general->id,
                'name' => 'Biroul Planificare și control',
                'has_children' => false
            ]
        );

        $departments = Department::all();

        foreach ($departments as $department) {
            Permission::create([
                'name' => UsersPermissions::INVITE_USER($department->slug),
                'display_name' => UsersPermissions::DISPLAY_INVITE_USER($department->name),
                'guard_name' => 'web'
            ]);
            Permission::create([
                'name' => DepartmentsPermissions::VIEW($department->slug),
                'display_name' => DepartmentsPermissions::DISPLAY_VIEW($department->name),
                'guard_name' => 'web'
            ]);



            Permission::create([
                'name' => DepartmentsPermissions::ASSIGN_TASK($department->slug),
                'display_name' => DepartmentsPermissions::DISPLAY_ASSIGN_TASK($department->name),
                'guard_name' => 'web'
            ]);

            Permission::create([
                'name' => DepartmentsPermissions::CREATE_TASK($department->slug),
                'display_name' => DepartmentsPermissions::DISPLAY_CREATE_TASK($department->name),
                'guard_name' => 'web'
            ]);
        }
        Department::firstOrCreate(
            [
                'slug' => \Str::of('WEBMASTER')->slug(),
            ],
            [
                'name' => 'WEBMASTER',
                'has_children' => false
            ]
        );

    }
}
