<?php

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\JobVacancyController;
use App\Http\Controllers\Admin\JobApplicationController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\SolutionCategoryController;
use App\Http\Controllers\Admin\SolutionController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\TestingController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\MainImageController;
use App\Http\Controllers\Admin\TestimonyController;
use App\Http\Controllers\Admin\JobVacancyLevelController;
use App\Http\Controllers\Admin\JobVacancyDepartmentController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::fallback([App\Http\Controllers\Frontend\HomeController::class, 'home']);
Route::prefix('eksad-admin')->group(function(){
//    Route::get('/', 'Admin\DashboardController@index')->name('admin.dashboard');
//    Route::get('/login', 'Admin\LoginController@showLoginForm')->name('login');
//    Route::post('/login', 'Admin\LoginController@login')->name('login.submit');
//    Route::get('/logout', 'Admin\LoginController@logout')->name('logout');

    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/search', [DashboardController::class, 'search'])->name('admin.search');
    Route::get('/example-page', [DashboardController::class, 'examplePage'])->name('admin.example-page');
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');

    //ADMIN USER MODULE
    Route::get('/adminuser', [AdminUserController::class, 'index'])->name('admin.adminuser.index');
    Route::get('/adminuser/create', [AdminUserController::class, 'create'])->name('admin.adminuser.create');
    Route::post('/adminuser/store', [AdminUserController::class, 'store'])->name('admin.adminuser.store');
    Route::get('/adminuser/edit/{id}', [AdminUserController::class, 'edit'])->name('admin.adminuser.edit');
    Route::post('/adminuser/update/{id}', [AdminUserController::class, 'update'])->name('admin.adminuser.update');
    Route::post('/adminuser/delete', [AdminUserController::class, 'destroy'])->name('admin.adminuser.destroy');

    //BLOG & BLOG CATEGORY MODULE
    Route::get('/blog', [BlogController::class, 'index'])->name('admin.blog.index');
    Route::get('/blog/create', [BlogController::class, 'create'])->name('admin.blog.create');
    Route::post('/blog/store', [BlogController::class, 'store'])->name('admin.blog.store');
    Route::get('/blog/show/{id}', [BlogController::class, 'show'])->name('admin.blog.show');
    Route::get('/blog/edit/{id}', [BlogController::class, 'edit'])->name('admin.blog.edit');
    Route::get('/blog/publish/{id}', [BlogController::class,'publishBlog'])->name('admin.blog.publish');
    Route::get('/blog/unpublish/{id}', [BlogController::class,'unpublishBlog'])->name('admin.blog.unpublish');
    Route::post('/blog/update/{id}', [BlogController::class, 'update'])->name('admin.blog.update');
    Route::post('/blog/delete', [BlogController::class, 'destroy'])->name('admin.blog.destroy');

    Route::get('/blogcategory', [BlogCategoryController::class, 'index'])->name('admin.blogcategory.index');
    Route::get('/blogcategory/create', [BlogCategoryController::class, 'create'])->name('admin.blogcategory.create');
    Route::post('/blogcategory/store', [BlogCategoryController::class, 'store'])->name('admin.blogcategory.store');
    Route::get('/blogcategory/edit/{id}', [BlogCategoryController::class, 'edit'])->name('admin.blogcategory.edit');
    Route::post('/blogcategory/update/{id}', [BlogCategoryController::class, 'update'])->name('admin.blogcategory.update');
    Route::post('/blogcategory/delete', [BlogCategoryController::class, 'destroy'])->name('admin.blogcategory.destroy');


    //CONTACT US MODULE
    Route::get('/contactus', [ContactUsController::class, 'index'])->name('admin.contactus.index');
    Route::get('/contactus/show/{id}', [ContactUsController::class, 'show'])->name('admin.contactus.show');
    Route::post('/contactus/delete', [ContactUsController::class, 'destroy'])->name('admin.contactus.destroy');
    Route::get('/subscribe', [ContactUsController::class, 'indexSubscribe'])->name('admin.subscribe.index');
    Route::post('/subscribe/delete', [ContactUsController::class, 'destroySubscribe'])->name('admin.subscribe.destroy');

    //SOLUTION MODULE
    Route::get('/solution', [SolutionController::class, 'index'])->name('admin.solution.index');
    Route::get('/solution/show/{id}', [SolutionController::class, 'show'])->name('admin.solution.show');
    Route::get('/solution/create', [SolutionController::class, 'create'])->name('admin.solution.create');
    Route::post('/solution/store', [SolutionController::class, 'store'])->name('admin.solution.store');
    Route::get('/solution/edit/{id}', [SolutionController::class, 'edit'])->name('admin.solution.edit');
    Route::post('/solution/update/{id}', [SolutionController::class, 'update'])->name('admin.solution.update');
    Route::post('/solution/delete', [SolutionController::class, 'destroy'])->name('admin.solution.destroy');
    Route::get('/solution/select', [SolutionController::class, 'selectSolutions'])->name('admin.solution.select');

    Route::get('/solutioncategory', [SolutionCategoryController::class, 'index'])->name('admin.solutioncategory.index');
    Route::get('/solutioncategory/create', [SolutionCategoryController::class, 'create'])->name('admin.solutioncategory.create');
    Route::post('/solutioncategory/store', [SolutionCategoryController::class, 'store'])->name('admin.solutioncategory.store');
    Route::get('/solutioncategory/edit/{id}', [SolutionCategoryController::class, 'edit'])->name('admin.solutioncategory.edit');
    Route::post('/solutioncategory/update/{id}', [SolutionCategoryController::class, 'update'])->name('admin.solutioncategory.update');
    Route::post('/solutioncategory/delete', [SolutionCategoryController::class, 'destroy'])->name('admin.solutioncategory.destroy');
    Route::get('/solutioncategory/select', [SolutionCategoryController::class, 'selectCategorySolutions'])->name('admin.solutioncategory.select');
    //DATATABLES
    Route::get('/solution/datatable', [SolutionController::class, 'getIndex'])->name('admin.solution.datatable');
    Route::get('/solutioncategory/datatable', [SolutionCategoryController::class, 'getIndex'])->name('admin.solutioncategory.datatable');

    //PORTFOLIO MODULE
    Route::get('/portfolio', [PortfolioController::class, 'index'])->name('admin.portfolio.index');
    Route::get('/portfolio/show/{id}', [PortfolioController::class, 'show'])->name('admin.portfolio.show');
    Route::get('/portfolio/create', [PortfolioController::class, 'create'])->name('admin.portfolio.create');
    Route::post('/portfolio/store', [PortfolioController::class, 'store'])->name('admin.portfolio.store');
    Route::get('/portfolio/edit/{id}', [PortfolioController::class, 'edit'])->name('admin.portfolio.edit');
    Route::post('/portfolio/update/{id}', [PortfolioController::class, 'update'])->name('admin.portfolio.update');
    Route::post('/portfolio/status/update', [PortfolioController::class, 'changePublishStatus'])->name('admin.portfolio.status.update');
    Route::post('/portfolio/delete', [PortfolioController::class, 'delete'])->name('admin.portfolio.delete');
    //DATATABLES
    Route::get('/portfolio/datatable', [PortfolioController::class, 'getIndex'])->name('admin.portfolio.datatable');


    //SERVICE MODULE
    Route::get('/job_vacancy', [JobVacancyController::class, 'index'])->name('admin.job_vacancy.index');
    Route::get('/job_vacancy/show/{id}', [JobVacancyController::class, 'show'])->name('admin.job_vacancy.show');
    Route::get('/job_vacancy/create', [JobVacancyController::class, 'create'])->name('admin.job_vacancy.create');
    Route::post('/job_vacancy/store', [JobVacancyController::class, 'store'])->name('admin.job_vacancy.store');
    Route::get('/job_vacancy/edit/{id}', [JobVacancyController::class, 'edit'])->name('admin.job_vacancy.edit');
    Route::post('/job_vacancy/update/{id}', [JobVacancyController::class, 'update'])->name('admin.job_vacancy.update');
    Route::post('/job_vacancy/delete', [JobVacancyController::class, 'destroy'])->name('admin.job_vacancy.destroy');
    Route::get('/job_vacancy/select', [JobVacancyController::class, 'selectServices'])->name('admin.job_vacancy.select');

    //JOB VACANCY LEVEL & DEPARTMENT MODULE
    Route::get('/job_vacancy_level', [JobVacancyLevelController::class, 'index'])->name('admin.vacancylevel.index');
    Route::get('/job_vacancy_level/create', [JobVacancyLevelController::class, 'create'])->name('admin.vacancylevel.create');
    Route::post('/job_vacancy_level/store', [JobVacancyLevelController::class, 'store'])->name('admin.vacancylevel.store');
    Route::get('/job_vacancy_level/edit/{id}', [JobVacancyLevelController::class, 'edit'])->name('admin.vacancylevel.edit');
    Route::post('/job_vacancy_level/update/{id}', [JobVacancyLevelController::class, 'update'])->name('admin.vacancylevel.update');
    Route::post('/job_vacancy_level/delete', [JobVacancyLevelController::class, 'destroy'])->name('admin.vacancylevel.destroy');

    Route::get('/job_vacancy_department', [JobVacancyDepartmentController::class, 'index'])->name('admin.vacancydepartment.index');
    Route::get('/job_vacancy_department/create', [JobVacancyDepartmentController::class, 'create'])->name('admin.vacancydepartment.create');
    Route::post('/job_vacancy_department/store', [JobVacancyDepartmentController::class, 'store'])->name('admin.vacancydepartment.store');
    Route::get('/job_vacancy_department/edit/{id}', [JobVacancyDepartmentController::class, 'edit'])->name('admin.vacancydepartment.edit');
    Route::post('/job_vacancy_department/update/{id}', [JobVacancyDepartmentController::class, 'update'])->name('admin.vacancydepartment.update');
    Route::post('/job_vacancy_department/delete', [JobVacancyDepartmentController::class, 'destroy'])->name('admin.vacancydepartment.destroy');

    //DATATABLES
    Route::get('/job_vacancy/datatable', [JobVacancyController::class, 'getIndex'])->name('admin.job_vacancy.datatable');
    Route::get('/job_vacancy_level/datatable', [JobVacancyLevelController::class, 'getIndex'])->name('admin.vacancylevel.datatable');
    Route::get('/job_vacancy_department/datatable', [JobVacancyDepartmentController::class, 'getIndex'])->name('admin.vacancydepartment.datatable');

    Route::get('/job_application', [JobApplicationController::class, 'index'])->name('admin.job_application.index');
    Route::get('/job_application/show/{id}', [JobApplicationController::class, 'show'])->name('admin.job_application.show');
    Route::get('/job_application/download/{filename}', [JobApplicationController::class, 'download'])->name('admin.job_application.download');
    Route::post('/job_application/delete', [JobApplicationController::class, 'destroy'])->name('admin.job_application.destroy');
    //DATATABLES
    Route::get('/job_application/datatable', [JobApplicationController::class, 'getIndex'])->name('admin.job_application.datatable');

    // Client Slide
    Route::get('/client/', [ClientController::class, 'index'])->name('admin.client.index');
    Route::post('/client/update/', [ClientController::class, 'update'])->name('admin.client.update');
    Route::get('/client/edit/{id}', [ClientController::class, 'edit'])->name('admin.client.edit');
    Route::post('/client/update-single/', [ClientController::class, 'updateSingle'])->name('admin.client.updateSingle');
    Route::post('/client/delete', [ClientController::class, 'destroy'])->name('admin.client.destroy');

    // Main Image
    Route::get('/main_image/', [MainImageController::class, 'index'])->name('admin.mainimage.index');
    Route::post('/main_image/update/', [MainImageController::class, 'update'])->name('admin.mainimage.update');
    Route::get('/main_image/edit/{id}', [MainImageController::class, 'edit'])->name('admin.mainimage.edit');
    Route::post('/main_image/update-single/', [MainImageController::class, 'updateSingle'])->name('admin.mainimage.updateSingle');
    Route::post('/main_image/delete', [MainImageController::class, 'destroy'])->name('admin.mainimage.destroy');

    //TESTIMONIAL MODULE
    Route::get('/testimony', [TestimonyController::class, 'index'])->name('admin.testimony.index');
    Route::get('/testimony/create', [TestimonyController::class, 'create'])->name('admin.testimony.create');
    Route::post('/testimony/store', [TestimonyController::class, 'store'])->name('admin.testimony.store');
    Route::get('/testimony/show/{id}', [TestimonyController::class, 'show'])->name('admin.testimony.show');
    Route::get('/testimony/edit/{id}', [TestimonyController::class, 'edit'])->name('admin.testimony.edit');
    Route::get('/testimony/publish/{id}', [TestimonyController::class,'publishBlog'])->name('admin.testimony.publish');
    Route::get('/testimony/unpublish/{id}', [TestimonyController::class,'unpublishBlog'])->name('admin.testimony.unpublish');
    Route::post('/testimony/update', [TestimonyController::class, 'update'])->name('admin.testimony.update');
    Route::post('/testimony/destroy', [TestimonyController::class, 'destroy'])->name('admin.testimony.destroy');
    //DATATABLES
    Route::get('/testimony/datatable', [TestimonyController::class, 'getIndex'])->name('admin.testimony.datatable');

    //TEAM MODULE
    Route::get('/team', [TeamController::class, 'index'])->name('admin.team.index');
    Route::get('/team/create', [TeamController::class, 'create'])->name('admin.team.create');
    Route::post('/team/store', [TeamController::class, 'store'])->name('admin.team.store');
    Route::get('/team/show/{id}', [TeamController::class, 'show'])->name('admin.team.show');
    Route::get('/team/edit/{id}', [TeamController::class, 'edit'])->name('admin.team.edit');
    Route::post('/team/update/{id}', [TeamController::class, 'update'])->name('admin.team.update');
    Route::post('/team/destroy', [TeamController::class, 'destroy'])->name('admin.team.destroy');

    //DATATABLES
    Route::get('/adminuser/datatable', [AdminUserController::class, 'getIndex'])->name('admin.adminuser.datatable');
    Route::get('/contactus/datatable', [ContactUsController::class, 'getIndex'])->name('admin.contactus.datatable');
    Route::get('/subscribe/datatable', [ContactUsController::class, 'getIndexSubscribe'])->name('admin.subscribe.datatable');
    Route::get('/blogcategory/datatable', [BlogCategoryController::class, 'getIndex'])->name('admin.blogcategory.datatable');
    Route::get('/blog/datatable', [BlogController::class, 'getIndex'])->name('admin.blog.datatable');
    Route::get('/team/datatable', [TeamController::class, 'getIndex'])->name('admin.team.datatable');
});
