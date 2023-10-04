<?php

namespace App\Traits;


trait AdminHelperTrait
{

    protected $array_keys = [
    "parent_id","order_id","country_id","city_id","job_id","grade_id","job_type_id","job_grade_id","employee_type_id","day_id",
    "management_id","employee_management_id","employee_id","shift_id","branch_id","user_id","manger_id","department_id","currency_id","management_child_id"];

    protected $check_keys = [
        'airline', 'airline_first', 'airline_second','insurance','insurance_personal','insurance_family',  'transfer', 'transfer_registration', 'transfer_final','car', 'telecom','social_insurance'];
    protected $category_type = ["service","post"];
    protected $page_type = ["page","testimonial","feature","slider"];
    protected $admin_perms_models =
    [
            "academies.index",
            "activity_logs.index",
            "attendances.index",
            "branches.index",
            "brokers.index",
            "categories.index",
            "cities.index",
            "clients.index",
            "contacts.index",
            "contracts.index",
            "countries.index",
            "courses.index",
            "currencies.index",
            "employees.index",
            "employee_contracts.index",
            "employee_finances.index",
            "employee_managements.index",
            "employee_types.index",
            "employee_vacations.index",
            "employee_details.index",
            "employee_finances",
            "employee_managements",
            "employee_types",
            "employee_vacations",
            "experiences.index",
            "grades.index",
            "groups.index",
            "jobs.index",
            "job_types.index",
            "job_grades.index",
            "job_names.index",
            "managements.index",
            "qualifications.index",
            "shifts.index",
            "day_shifts.index",
            "days.index",
            "states.index",
            "specialists.index",
            "universities.index",
            "vacations.index",
            "notifications.index",
            "works.index",
            "supports.index",
            "decisions.index",
            "orders.index",
            "pages.index",
            "posts.index",
            "roles.index",
            "services.index",
            "users.index",
            "logs.index",
    ];

    protected $limit_array = [25, 50, 100,250,500];
    protected $admin_roles =['admin', 'manger','office_admin','account_admin','office_manger','account_manger','office','account'];
    protected $user_admins = ['admin', 'manger'];
    protected $user_mangers = ['office_admin','account_admin'];
    protected $user_teams = ['office_manger', 'account_manger'];
    protected $user_employees = ['office_manger', 'account_manger'];

}
