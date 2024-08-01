<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{

    /**
     * List of applications to add.
     */
    private $permissionsUser = [
        'user-list',
        'user-create',
        'user-edit',
        'user-delete',
    ];

    private $permissionsRole = [
        'role-list',
        'role-create',
        'role-edit',
        'role-delete',
    ];

    private $permissionsInstitution = [
        'institution-list',
        'institution-create',
        'institution-edit',
        'institution-delete',
    ];

    private $permissionsTeacher = [
        'teacher-list',
        'teacher-create',
        'teacher-edit',
        'teacher-delete',
    ];

    private $permissionsCollege = [
        'college-list',
        'college-create',
        'college-edit',
        'college-delete'
    ];

    private $permissionsArea = [
        'area-list',
        'area-create',
        'area-edit',
        'area-delete',
    ];

    private $permissionsGrade = [
        'grade-list',
        'grade-create',
        'grade-edit',
        'grade-delete',
    ];

    private $permissionsSection = [
        'section-list',
        'section-create',
        'section-edit',
        'section-delete',
    ];

    private $permissionsAcademicCalendar = [
        'academic-calendar-list',
        'academic-calendar-create',
        'academic-calendar-edit',
        'academic-calendar-delete',
    ];

    private $permissionsAcademicProgramm = [
        'academic-program-list',
        'academic-program-create',
        'academic-program-edit',
        'academic-program-delete',
    ];

    private $permissionsClassUnit = [
        'class-unit-list',
        'class-unit-create',
        'class-unit-edit',
        'class-unit-delete',
    ];

    private $permissionsTeacherArea = [
        'teacher-area-list',
        'teacher-area-create',
        'teacher-area-edit',
        'teacher-area-delete',
    ];

    private $permissionsTeacherCoor = [
        'teacher-coordinate-list',
        'teacher-coordinate-create',
        'teacher-coordinate-edit',
        'teacher-coordinate-delete',
    ];

    private $permissionsInstitutionTeacher = [
        'institution-teacher-list',
        'institution-teacher-create',
        'institution-teacher-edit',
        'institution-teacher-delete',
    ];

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        foreach ($this->permissionsUser as $permission) {
            Permission::create(['name' => $permission]);
        }
        foreach ($this->permissionsRole as $permission) {
            Permission::create(['name' => $permission]);
        }
        foreach ($this->permissionsInstitution as $permission) {
            Permission::create(['name' => $permission]);
        }
        foreach ($this->permissionsTeacher as $permission) {
            Permission::create(['name' => $permission]);
        }
        foreach ($this->permissionsCollege as $permission) {
            Permission::create(['name' => $permission]);
        }
        foreach ($this->permissionsArea as $permission) {
            Permission::create(['name' => $permission]);
        }
        foreach ($this->permissionsGrade as $permission) {
            Permission::create(['name' => $permission]);
        }
        foreach ($this->permissionsSection as $permission) {
            Permission::create(['name' => $permission]);
        }
        foreach ($this->permissionsAcademicCalendar as $permission) {
            Permission::create(['name' => $permission]);
        }
        foreach ($this->permissionsAcademicProgramm as $permission) {
            Permission::create(['name' => $permission]);
        }
        foreach ($this->permissionsClassUnit as $permission) {
            Permission::create(['name' => $permission]);
        }
        foreach ($this->permissionsTeacherArea as $permission) {
            Permission::create(['name' => $permission]);
        }
        foreach ($this->permissionsTeacherCoor as $permission) {
            Permission::create(['name' => $permission]);
        }
        foreach ($this->permissionsInstitutionTeacher as $permission) {
            Permission::create(['name' => $permission]);
        }

        $user1 = User::create([
            'id_card_user' => '71690691',
            'name' => 'José Antonio',
            'surname_user' => 'Rojas Cusi',
            'email' => 'joseantoniorsystem@gmail.com',
            'password' => Hash::make('71690691')
            ]);

        $role_root = Role::create(['name' => 'root_user']);
                Role::create(['name' => 'ugel_user']);
                Role::create(['name' => 'director_user']);
                Role::create(['name' => 'coord_user']);
                Role::create(['name' => 'docente_user']);

        $permissionsUser = Permission::pluck('id', 'id')->all();
        $permissionsRole = Permission::pluck('id', 'id')->all();
        $permissionsInstitution = Permission::pluck('id', 'id')->all();
        $permissionsTeacher = Permission::pluck('id', 'id')->all();
        $permissionsCollege = Permission::pluck('id', 'id')->all();
        $permissionsArea = Permission::pluck('id', 'id')->all();
        $permissionsGrade = Permission::pluck('id', 'id')->all();
        $permissionsSection = Permission::pluck('id', 'id')->all();
        $permissionsAcademicCalendar = Permission::pluck('id', 'id')->all();
        $permissionsAcademicProgramm = Permission::pluck('id', 'id')->all();
        $permissionsClassUnit = Permission::pluck('id', 'id')->all();
        $permissionsTeacherArea = Permission::pluck('id', 'id')->all();
        $permissionsTeacherCoor = Permission::pluck('id', 'id')->all();
        $permissionsInstitutionTeacher = Permission::pluck('id', 'id')->all();

        // asignar root user
        $role_root->syncPermissions($permissionsUser);
        $role_root->syncPermissions($permissionsRole);
        $role_root->syncPermissions($permissionsInstitution);
        $role_root->syncPermissions($permissionsTeacher);
        $role_root->syncPermissions($permissionsCollege);
        $role_root->syncPermissions($permissionsArea);
        $role_root->syncPermissions($permissionsGrade);
        $role_root->syncPermissions($permissionsSection);
        $role_root->syncPermissions($permissionsAcademicCalendar);
        $role_root->syncPermissions($permissionsAcademicProgramm);
        $role_root->syncPermissions($permissionsClassUnit);
        $role_root->syncPermissions($permissionsTeacherArea);
        $role_root->syncPermissions($permissionsTeacherCoor);
        $role_root->syncPermissions($permissionsInstitutionTeacher);

        $user1->assignRole([$role_root->id]);

        //Factories
        // Project::factory(25)->create();
        // Facilitator::factory(25)->create();
    }
}
