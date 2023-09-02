<?php

use Admin\Http\Controllers\Api\{ActivityController,
    AvatarUpload,
    Charts,
    ChecklistItemComplete,
    ChecklistItemsController,
    CheckUpdates,
    DepartmentController,
    FavoritesController,
    FileUpload,
    FiltersController,
    InvitationsController,
    KpiCategoryController,
    KpiController,
    KpiResultController,
    LabelsController,
    LevelController,
    LogoUpload,
    Metrics,
    MilestoneController,
    Notifications,
    NotificationsRead,
    ProfileController,
    ProjectArchive,
    ProjectDuplicate,
    ProjectExportTimeLogs,
    ProjectFavorite,
    ProjectListsController,
    ProjectListSort,
    ProjectRestore,
    ProjectsController,
    ProjectsOptions,
    ProjectTimeLogs,
    ProjectTotalTime,
    ProjectTypeController,
    RecentProjects,
    RolesController,
    SectionController,
    SettingsEmailController,
    SettingsGeneralController,
    StatusController,
    SubTasksController,
    TaskArchive,
    TaskAssign,
    TaskCommentsController,
    TaskComplete,
    TaskDueDate,
    TaskLabel,
    TaskList,
    TaskMove,
    TaskPriority,
    TaskRecurring,
    TaskRestore,
    TasksController,
    TaskSort,
    ProjectStatisticsController,
    TimeLogsController,
    UpdateApp,
    UpdateRecipe,
    UsersController
};
use Illuminate\Support\Facades\Route;

Route::get('{resource}/filters', FiltersController::class);
Route::get('metrics', Metrics::class);
Route::get('charts/{project_id?}', Charts::class);
Route::get('notifications', Notifications::class);
Route::post('notifications/read', NotificationsRead::class);
Route::get('recent-projects', RecentProjects::class);
Route::post('logo', LogoUpload::class);
Route::post('avatar', AvatarUpload::class);
Route::post('file', FileUpload::class);
Route::resource('profile', ProfileController::class)->only(['create', 'store']);
Route::resource('time-logs', TimeLogsController::class)->only(['index', 'store']);

Route::resource('favorites', FavoritesController::class)->only(['index', 'store', 'destroy']);

//Statistics
Route::get('projects/{id}/statistics', ProjectStatisticsController::class);
Route::get('projects/options', ProjectsOptions::class);
Route::resource('projects', ProjectsController::class);
Route::resource('projects.lists', ProjectListsController::class)->shallow();
Route::patch('projects/{project}/favorite', ProjectFavorite::class);
Route::post('projects/{project}/duplicate', ProjectDuplicate::class);
Route::patch('projects/{project}/archive', ProjectArchive::class);
Route::patch('projects/{project}/restore', ProjectRestore::class);
Route::patch('projects/{project}/list-sort', ProjectListSort::class);
Route::get('projects/{project}/time-logs', ProjectTimeLogs::class);
Route::get('projects/{project}/total-time', ProjectTotalTime::class);
Route::get('projects/{project}/export-time-logs', ProjectExportTimeLogs::class);

Route::resource('tasks.comments', TaskCommentsController::class)->shallow()->only(['store', 'destroy']);
Route::resource('tasks', TasksController::class);
Route::patch('tasks/{task}/sort', TaskSort::class);
Route::patch('tasks/{task}/move', TaskMove::class);
Route::patch('tasks/{task}/list', TaskList::class);
Route::patch('tasks/{task}/priority', TaskPriority::class);
Route::patch('tasks/{task}/assign', TaskAssign::class);
Route::patch('tasks/{task}/label', TaskLabel::class);
Route::patch('tasks/{task}/complete', TaskComplete::class);
Route::patch('tasks/{task}/archive', TaskArchive::class);
Route::patch('tasks/{task}/restore', TaskRestore::class);
Route::patch('tasks/{task}/due-date', TaskDueDate::class);
Route::post('tasks/{task}/recurring', TaskRecurring::class);
Route::post('sub-tasks', [SubTasksController::class, 'store']);
Route::patch('sub-tasks/{task}', [SubTasksController::class, 'update']);
Route::delete('sub-tasks/{task}', [SubTasksController::class, 'destroy']);
Route::post('checklist-item', [ChecklistItemsController::class, 'store']);
Route::patch('checklist-item/{item}', [ChecklistItemsController::class, 'update']);
Route::delete('checklist-item/{item}', [ChecklistItemsController::class, 'destroy']);
Route::patch('checklist-item/{item}/complete', ChecklistItemComplete::class);

Route::resource('labels', LabelsController::class);
Route::resource('users', UsersController::class);
Route::resource('invitations', InvitationsController::class)->except(['show', 'edit', 'update']);
Route::resource('roles', RolesController::class);

Route::resource('settings/general', SettingsGeneralController::class)->only(['create', 'store']);
Route::resource('settings/email', SettingsEmailController::class)->only(['create', 'store']);
Route::post('check-updates', CheckUpdates::class)->middleware('can:setting:updates');
Route::post('update-app', UpdateApp::class)->middleware('can:setting:updates');
Route::post('update-recipe', UpdateRecipe::class)->middleware('can:setting:updates');

// Milestone
Route::get('milestone/get_all_milestones', [MilestoneController::class, 'getAllMilestones'])->name('milestone.getAllMilestones');
Route::resource('milestone', MilestoneController::class);

// Frequencies
Route::get('frequencies', [SettingsGeneralController::class, 'allFrequencies'])->name('frequencies.index');

// Kpi Categories
Route::resource('kpiCategories', KpiCategoryController::class);

// crud for result of kpis
Route::get('kpis/{kpi_id}/results/get_all_results', [KpiResultController::class, 'getAllResults'])->name('kpis.getAllResults');
Route::resource('kpis/{kpi_id}/results', KpiResultController::class);

// kpis
Route::resource('kpis', KpiController::class);

// Project Types
Route::get('project_types/all_types', [ProjectTypeController::class, 'getAllTypes']);
Route::resource('project_types', ProjectTypeController::class);

// Departments
Route::get('departments/get_all_departments', [DepartmentController::class, 'getAllDepartments'])->name('departments.get_all_departments');
Route::resource('departments', DepartmentController::class);

// Statuses
Route::get('statuses/get_all_statuses', [StatusController::class, 'getAllStatuses'])->name('statuses.');
Route::resource('statuses', StatusController::class);

// logs
Route::get('/logs', ActivityController::class);

// levels of radar
Route::resource('levels', LevelController::class);

// Sections of radar
Route::resource('sections', SectionController::class);
