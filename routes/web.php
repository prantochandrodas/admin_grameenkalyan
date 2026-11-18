<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\Backend\FaqController;
use App\Http\Controllers\Backend\UsersController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Backend\BrandLogoController;
use App\Http\Controllers\Backend\VisitorsController;
use App\Http\Controllers\Backend\GalleryController;
use App\Http\Controllers\Backend\CustomerFeedbackController;
use App\Http\Controllers\Backend\LandOwnerController;
use App\Http\Controllers\Backend\CareerController;
use App\Http\Controllers\Backend\PartnersController;
use App\Http\Controllers\Backend\ProjectsCategoryController;
use App\Http\Controllers\Backend\ProjectsController;
use App\Http\Controllers\Backend\SummaryReportSettingsController;
use App\Http\Controllers\Backend\StoryCategoryController;
use App\Http\Controllers\Backend\StoryController;
use App\Http\Controllers\Backend\MemberController;
use App\Http\Controllers\Backend\PeoplesController;
use App\Http\Controllers\Backend\HealthCenterController;
use App\Http\Controllers\Backend\LocatorController;
use App\Http\Controllers\Backend\ContactController as ContactBackendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Backend\DepartmentController;
use App\Http\Controllers\Backend\DesignationController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\HealthCareController;
use App\Http\Controllers\PeopleCorporateController;
use App\Http\Controllers\PeopleHealthForceController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ServiceSpecialController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OtherServicesController;
use App\Http\Controllers\StoryController as StoryFrontController;
use App\Http\Controllers\GalleryController as GalleryFrontController;
use App\Http\Controllers\Backend\VideoGalleryController;
use App\Http\Controllers\Backend\PhotoGalleryController;
use App\Http\Controllers\Backend\PhotoAlbumController;
use App\Http\Controllers\HomeContentsController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\Backend\CulturalPrioritiesController;
use App\Http\Controllers\Backend\DonateController;
use App\Http\Controllers\Backend\GalleryCategoryController;
use App\Http\Controllers\Backend\NewsEventController;
use App\Http\Controllers\Backend\PackageCategoryController;
use App\Http\Controllers\Backend\PackageController;
use App\Http\Controllers\Backend\PhotoSubAlbumController;
use App\Http\Controllers\Backend\PopupImageController;
use App\Http\Controllers\Backend\ScheduleController;
use App\Http\Controllers\Backend\StoryCommentController;
use App\Http\Controllers\Backend\TestNameController;
use App\Http\Controllers\Backend\WebsiteBannerController;
use App\Http\Controllers\ServiceContentsController;
use App\Http\Controllers\HealthcareContentsController;
use App\Http\Controllers\DiseaseSpecificMedicareController;
use App\Http\Controllers\HealthcareServicesController;
use App\Http\Controllers\HomeSliderController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\TimelineController;
use App\Http\Controllers\TimelineItemsController;


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

Route::get('/quick-search', [PagesController::class, 'quickSearch'])->name('quick-search');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
Route::get('/', [DashboardController::class, 'index']);

//Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
////    Route::get('/', [HomeController::class,'index']);
//    Route::get('/about', [AboutController::class,'index']);
//    Route::get('/service', [ServiceController::class,'index']);
//    Route::get('/healthcare', [HealthCareController::class,'index']);
//    Route::get('/engagement-in-social-business', [OtherServicesController::class,'socialBusiness']);
//    Route::get('/well-being', [OtherServicesController::class,'wellBeing']);
//    Route::get('/emergency-response', [OtherServicesController::class,'emergencyResponse']);
//    Route::get('/locator', [HomeController::class,'getLocator']);
//    Route::get('/join-us', [HomeController::class,'getJoinUs']);
//    Route::get('/medicine', [ServiceSpecialController::class,'getMedicine']);
//
//    Route::get('/gynae-and-obs', [ServiceSpecialController::class,'getGynaeObs']);
//    Route::get('/pediatric', [ServiceSpecialController::class,'getPediatric']);
//    Route::get('/eye-care', [ServiceSpecialController::class,'getEyeCare']);
//    Route::get('/ent-care', [ServiceSpecialController::class,'getENTCare']);
//    Route::get('/diabetes', [ServiceSpecialController::class,'getOrthopedic']);
//    Route::get('/more-health-care', [ServiceSpecialController::class,'getMoreHealthCare']);
//
//
//    Route::get('/health-force', [PeopleHealthForceController::class,'index']);
//    Route::get('/corporate', [PeopleCorporateController::class,'index']);
Route::get('/get-district', [LocationController::class, 'getDistrictByDivision']);
Route::get('/get-upazilla', [LocationController::class, 'getUpazillaByDistrict']);
Route::get('/get-health-center-by-id', [HealthCareController::class, 'getHealthCareCenterByID']);
Route::get('/get-health-center-by-value', [HealthCareController::class, 'getHealthCareCenterByValue']);
Route::get('/get-health-center-by-division', [HealthCareController::class, 'getHealthCareCenterByDivision']);
//    Route::get('/story', [StoryFrontController::class,'index']);
Route::get('/story/{id}', [StoryFrontController::class, 'getStoryByCategory']);
Route::get('/story-details/{id}', [StoryFrontController::class, 'getStoryDetails']);
//    Route::post('/send-message', [ContactController::class,'postContactMessage']);
//    Route::get('/search', [HomeController::class,'getSearchResult']);
//    Route::post('/post-application', [HomeController::class,'postCareer']);
// Route::get('/bio/{id}', [HomeController::class,'getBio']);
//
//    Route::get('/micro-health-insurance', [ServiceSpecialController::class,'getMicroHealthInsurance']);
//    Route::get('/doctor-consulation', [ServiceSpecialController::class,'getDoctorConsulation']);
//    Route::get('/primary-diagnosis', [ServiceSpecialController::class,'getPrimaryDiagnosis']);
//    Route::get('/door-to-door-visit', [ServiceSpecialController::class,'getDoorToDoorVisit']);
//    Route::get('/health-camps', [ServiceSpecialController::class,'getHealthCamps']);
//    Route::get('/digital-healthcare', [ServiceSpecialController::class,'getDigitalHealthcare']);
//    Route::get('/vaccination-immunisation', [ServiceSpecialController::class,'getVaccinationImmunisation']);
//    Route::get('/access-to-medicine', [ServiceSpecialController::class,'getAccessToMedicine']);
//    Route::post('post-comment',[StoryFrontController::class,'postComment']);
Route::post('update-summary-report-settings', [SummaryReportSettingsController::class, 'updateSummaryReportSettingsAjax']);
//    Route::get('/photo-gallery', [GalleryFrontController::class,'getPhotoGallery']);
//    Route::get('/photo-gallery/{id}', [GalleryFrontController::class,'getPhotoGalleryByAlbum']);
//    Route::get('/photo-album', [GalleryFrontController::class,'getPhotoAlbum']);
//    Route::get('/video-gallery', [GalleryFrontController::class,'getVideoGallery']);
//    Route::get('/video-view-count', [GalleryFrontController::class,'getVideoViewCount']);
//});
Route::delete('admin/contact/bulk-delete', [ContactBackendController::class, 'bulkDelete'])
    ->name('contact.bulk-delete');
Route::resource('admin/contact', ContactBackendController::class);
Route::group(['prefix' => 'admin', 'middleware' => ['resource.maker', 'auth.acl']], function () {
    Route::get('/my-profile', [UsersController::class, 'myProfile']);
    Route::get('/edit-profile', [UsersController::class, 'editProfile']);
    Route::post('/update-profile', [UsersController::class, 'updateProfile']);
    Route::get('/change-password', [UsersController::class, 'changePassword']);
    Route::post('/save-new-password', [UsersController::class, 'updatePassword']);
    Route::resource('/user', UsersController::class);
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/logout', [UsersController::class, 'logout']);
    Route::resource('/visitors', VisitorsController::class);
    Route::resource('/contact', ContactBackendController::class);
    Route::resource('/user-comment', CustomerFeedbackController::class);
    Route::resource('/career', CareerController::class);
    Route::post('/career/bulk-delete', [CareerController::class, 'bulkDelete'])->name('career.bulk-delete');
    Route::resource('/reports-summary-settings', SummaryReportSettingsController::class);
    Route::resource('/story-category', StoryCategoryController::class);
    Route::post('/test-name/check-names', [TestNameController::class, 'checkNames']);
    Route::resource('/test-name', TestNameController::class);
    Route::resource('/package-category', PackageCategoryController::class);
    Route::get('/package/{id}/print', [PackageController::class, 'printView']);
    Route::resource('/package', PackageController::class);
    Route::resource('/cultural-priorities', CulturalPrioritiesController::class);
    Route::resource('/story', StoryController::class);
    Route::get('/story-comments', [StoryCommentController::class, 'index'])->name('story-comments.index');
    Route::delete('/story-comments/bulk-delete', [StoryCommentController::class, 'bulkDestroy'])->name('story-comments.bulk-destroy');
    Route::delete('/story-comments/{id}', [StoryCommentController::class, 'destroy'])->name('story-comments.destroy');
    Route::resource('/people', PeoplesController::class);
    Route::resource('/members', MemberController::class);
    Route::resource('/get-center', HealthCenterController::class);
    Route::resource('/health-center', HealthCenterController::class);
    Route::resource('/locator', LocatorController::class);
    Route::resource('/schedule', ScheduleController::class);

    Route::resource('/designation', DesignationController::class);
    Route::resource('/department', DepartmentController::class);
    Route::resource('/photo-album-category', GalleryCategoryController::class);
    Route::resource('/video-gallery', VideoGalleryController::class);
    Route::delete('/photo-gallery/bulk-delete', [PhotoGalleryController::class, 'bulkDestroy'])
        ->name('photo-gallery.bulk-destroy');
    Route::post('/photo-gallery/bulk-assign', [PhotoGalleryController::class, 'bulkAssign'])
        ->name('photo-gallery.bulk-assign');
    Route::resource('/photo-gallery', PhotoGalleryController::class);
    Route::get('/photo-gallery/sub-albums/{albumId}', [PhotoGalleryController::class, 'subAlbums']);
    Route::resource('/photo-album', PhotoAlbumController::class);
    Route::resource('/photo-sub-album', PhotoSubAlbumController::class);

    Route::resource('/popup-image', PopupImageController::class)->except(['show']);
    //new backend routes 10-07-2023
    Route::resource('/home-contents', HomeContentsController::class);
    Route::resource('/home-slider', HomeSliderController::class);
    Route::resource('/about-us', AboutUsController::class);
    Route::resource('/service-contents', ServiceContentsController::class);
    //        Route::resource('/healthcare-contents', HealthcareContentsController::class);
    Route::resource('/healthcare-services', HealthcareServicesController::class);
    Route::resource('/disease-specific-medicare', DiseaseSpecificMedicareController::class);
    Route::resource('/timeline', TimelineController::class);
    //        Route::resource('/timeline-items', TimelineItemsController::class);
    Route::resource('/newsletter', NewsletterController::class);
    //ends here
    Route::resource('/donate', DonateController::class);
    Route::resource('/website-banner', WebsiteBannerController::class);
    Route::resource('/news-event', NewsEventController::class);
});
