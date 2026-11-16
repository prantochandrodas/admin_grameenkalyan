<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\HomeContentsApiController;
use App\Http\Controllers\API\HomeSliderContentsApiController;
use App\Http\Controllers\API\AboutUsContentsApiController;
use App\Http\Controllers\API\ServiceContentsApiController;
use App\Http\Controllers\API\HealthcareServicesAPIController;
use App\Http\Controllers\API\DiseaseSpecificMedicareAPIController;
use App\Http\Controllers\API\TimelineAPIController;
use App\Http\Controllers\API\NewsletterAPIController;
use App\Http\Controllers\API\StoryAPIController;
use App\Http\Controllers\API\MembersAPIController;
use App\Http\Controllers\API\PeoplesAPIController;
use App\Http\Controllers\API\HealthCentrersAPIController;
use App\Http\Controllers\API\LocatorsAPIController;
use App\Http\Controllers\API\SummaryReportsSettingsAPIController;
use App\Http\Controllers\API\DepartmentsAPIController;
use App\Http\Controllers\API\DesignationsAPIController;
use App\Http\Controllers\API\PhotoAlbumsAPIController;
use App\Http\Controllers\API\PhotoGalleryAPIController;
use App\Http\Controllers\API\VideoGalleryAPIController;
use App\Http\Controllers\API\SearchAPIController;
use App\Http\Controllers\API\FormsAPIController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* New Module API(s) */

Route::get('home-contents', [HomeContentsApiController::class, 'getHomepageContents']);
Route::get('home-slider-contents', [HomeSliderContentsApiController::class, 'getHomeSliderContents']);
Route::get('about-us-contents', [AboutUsContentsApiController::class, 'getAboutUsContents']);
Route::get('service-contents', [ServiceContentsApiController::class, 'getServiceContents']);
Route::get('healthcare-services', [HealthcareServicesAPIController::class, 'getHealthcareServices']);
Route::get('disease-specific-medicare', [DiseaseSpecificMedicareAPIController::class, 'getDiseaseSpecificMedicare']);
Route::get('timeline', [TimelineAPIController::class, 'getTimeline']);
Route::get('newsletter', [NewsletterAPIController::class, 'getNewsletter']);
/* End New Module API(s) */

Route::get('story-categories', [StoryAPIController::class, 'getStoryCategories']);
Route::get('stories', [StoryAPIController::class, 'getStories']);
Route::get('members', [MembersAPIController::class, 'getMembers']);
Route::get('peoples', [PeoplesAPIController::class, 'getPeoples']);
Route::get('health-centers', [HealthCentrersAPIController::class, 'getHealthCenters']);
Route::get('locators', [LocatorsAPIController::class, 'getLocator']);
Route::get('summary-report-settings', [SummaryReportsSettingsAPIController::class, 'getSummaryReportSettings']);
Route::get('departments', [DepartmentsAPIController::class, 'getDepartments']);
Route::get('designations', [DesignationsAPIController::class, 'getDesignations']);
Route::get('photo-albums', [PhotoAlbumsAPIController::class, 'getPhotoAlbums']);
Route::get('photo-galleries', [PhotoGalleryAPIController::class, 'getPhotoGalleries']);
Route::get('video-galleries', [VideoGalleryAPIController::class, 'getVideoGallery']);
Route::get('recommended-video-galleries', [VideoGalleryAPIController::class, 'getRecommendedVideoGallery']);
Route::get('search-results', [SearchAPIController::class, 'getSearchResults']);
Route::post('save-contact-form', [FormsAPIController::class, 'saveContactFormData']);
Route::post('save-career-form', [FormsAPIController::class, 'saveCareerFormData']);
