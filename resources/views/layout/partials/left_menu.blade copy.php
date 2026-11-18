<li class="menu-item " aria-haspopup="true">
    <a href="/admin/dashboard" class="menu-link "><span
            class="svg-icon menu-icon"><!--begin::Svg Icon | path:media/svg/icons/Design/Layers.svg--><svg
                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                    <path
                        d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z"
                        fill="#000000" fill-rule="nonzero"></path>
                    <path
                        d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z"
                        fill="#000000" opacity="0.3"></path>
                </g>
            </svg><!--end::Svg Icon--></span><span class="menu-text">Dashboard</span></a>
</li>
@if (has_group_access(['Role', 'Resource']))
    <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover"><a href="#"
            class="menu-link menu-toggle"><span
                class="svg-icon menu-icon"><!--begin::Svg Icon | path:media/svg/icons/Design/Bucket.svg--><svg
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                    height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                        <path
                            d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z"
                            fill="#000000" opacity="0.3"></path>
                    </g>
                </svg><!--end::Svg Icon--></span><span class="menu-text">Authentications</span><i
                class="menu-arrow"></i></a>
        <div class="menu-submenu " kt-hidden-height="80" style="display: none; overflow: hidden;">
            <span class="menu-arrow"></span>
            <ul class="menu-subnav">
                <li class="menu-item  menu-item-parent" aria-haspopup="true">
                    <span class="menu-link"><span class="menu-text">Authentication</span></span>
                </li>
                <li class="menu-item " aria-haspopup="true"><a href="{{ url('/admin/user') }}" class="menu-link "><i
                            class="menu-bullet menu-bullet-dot"><span></span></i><span
                            class="menu-text">Users</span></a></li>
                @if (has_access('Alfaj\Acl\Http\RoleController@index', true))
                    <li class="menu-item " aria-haspopup="true"><a href="/role" class="menu-link "><i
                                class="menu-bullet menu-bullet-dot"><span></span></i><span
                                class="menu-text">Roles</span></a></li>
                @endif
                @if (has_access('Alfaj\Acl\Http\ResourcesController@index', true))
                    <li class="menu-item " aria-haspopup="true"><a href="/resource" class="menu-link "><i
                                class="menu-bullet menu-bullet-dot"><span></span></i><span
                                class="menu-text">Resources</span></a></li>
                @endif
            </ul>
        </div>
    </li>
@endif
<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
    <a href="#" class="menu-link menu-toggle">
        <span class="svg-icon menu-icon">
            <i class="fas fa-heartbeat"></i>
        </span>
        <span class="menu-text">Healthcare Package</span>
        <i class="menu-arrow"></i>
    </a>

    <div class="menu-submenu" style="display: none; overflow: hidden;">
        <span class="menu-arrow"></span>

        <ul class="menu-subnav">
            <li class="menu-item menu-item-parent" aria-haspopup="true">
                <span class="menu-link">
                    <span class="menu-text">Healthcare Package</span>
                </span>
            </li>

            <li class="menu-item" aria-haspopup="true">
                <a href="{{ url('admin/test-name') }}" class="menu-link">
                    <i class="menu-bullet menu-bullet-dot">
                        <span></span>
                    </i>
                    <span class="menu-text">Test Name</span>
                </a>
            </li>
            <li class="menu-item" aria-haspopup="true">
                <a href="{{ url('admin/package-category') }}" class="menu-link">
                    <i class="menu-bullet menu-bullet-dot">
                        <span></span>
                    </i>
                    <span class="menu-text">Package Category</span>
                </a>
            </li>
            <li class="menu-item" aria-haspopup="true">
                <a href="{{ url('admin/package') }}" class="menu-link">
                    <i class="menu-bullet menu-bullet-dot">
                        <span></span>
                    </i>
                    <span class="menu-text">Package</span>
                </a>
            </li>
        </ul>
    </div>
</li>
@if (has_group_access(['Backend-Visitors']))
    <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover"><a href="#"
            class="menu-link menu-toggle"><span
                class="svg-icon menu-icon"><!--begin::Svg Icon | path:media/svg/icons/Design/Bucket.svg--><svg
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                    height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                        <path
                            d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z"
                            fill="#000000" opacity="0.3"></path>
                    </g>
                </svg><!--end::Svg Icon--></span><span class="menu-text">Visitors</span><i class="menu-arrow"></i></a>
        <div class="menu-submenu " kt-hidden-height="80" style="display: none; overflow: hidden;">
            <span class="menu-arrow"></span>
            <ul class="menu-subnav">
                <li class="menu-item  menu-item-parent" aria-haspopup="true">
                    <span class="menu-link"><span class="menu-text">Themes</span></span>
                </li>
                @if (has_access('Backend\VisitorsController@index'))
                    <li class="menu-item " aria-haspopup="true"><a href="/admin/visitors" class="menu-link "><i
                                class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Visitor
                                List</span></a></li>
                @endif

            </ul>
        </div>
    </li>
@endif
<li class="menu-item" aria-haspopup="true"><a href="/admin/popup-image" class="menu-link "><i
            class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Popup Images</span></a>
</li>
<li class="menu-item" aria-haspopup="true"><a href="/admin/website-banner" class="menu-link "><i
            class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Website Banners</span></a>
</li>
@if (has_access('Backend\StoryCategoryController@index'))
    <li class="menu-item" aria-haspopup="true"><a href="/admin/story-category" class="menu-link "><i
                class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Story Category
                List</span></a></li>
@endif

@if (has_access('Backend\StoryController@index'))
    <li class="menu-item" aria-haspopup="true"><a href="/admin/story" class="menu-link "><i
                class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Story List</span></a>
    </li>
@endif
<li class="menu-item" aria-haspopup="true"><a href="/admin/story-comments" class="menu-link "><i
            class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Story Comment
            List</span></a></li>
@if (has_access('Backend\MemberController@index'))
    <li class="menu-item" aria-haspopup="true"><a href="/admin/members" class="menu-link "><i
                class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Member List</span></a>
    </li>
@endif
@if (has_access('Backend\PeoplesController@index'))
    <li class="menu-item" aria-haspopup="true"><a href="/admin/people" class="menu-link "><i
                class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">People List</span></a>
    </li>
@endif
@if (has_access('Backend\HealthCenterController@index'))
    <li class="menu-item" aria-haspopup="true"><a href="/admin/health-center" class="menu-link "><i
                class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Health Center
                List</span></a></li>
@endif
<li class="menu-item" aria-haspopup="true"><a href="/admin/cultural-priorities" class="menu-link "><i
            class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Cultural Priorities
            List</span></a></li>
<li class="menu-item" aria-haspopup="true"><a href="/admin/donate" class="menu-link "><i
            class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Donate</span></a></li>
<li class="menu-item" aria-haspopup="true"><a href="/admin/news-event" class="menu-link "><i
            class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">News & Events</span></a></li>
@if (has_access('Backend\LocatorController@index'))
    <li class="menu-item" aria-haspopup="true"><a href="/admin/locator" class="menu-link "><i
                class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Locator List</span></a>
    </li>
@endif
<li class="menu-item" aria-haspopup="true"><a href="/admin/schedule" class="menu-link "><i
            class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Schedule List</span></a>
</li>

@if (has_access('Backend\SummaryReportSettingsController@index'))
    <li class="menu-item" aria-haspopup="true"><a href="/admin/reports-summary-settings" class="menu-link "><i
                class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Summary Report
                Settings</span></a></li>
@endif
<li class="menu-item" aria-haspopup="true"><a href="/admin/contact" class="menu-link "><i
            class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Contact Request
            List</span></a></li>
{{-- @if (has_access('Backend\ContactController@index'))
    <li class="menu-item" aria-haspopup="true"><a href="/admin/contact" class="menu-link "><i
                class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Contact Request
                List</span></a></li>
@endif --}}

{{-- @if (has_access('Backend\CustomerFeedbackController@index'))
    <li class="menu-item" aria-haspopup="true"><a href="/admin/user-comment" class="menu-link "><i
                class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">User Comments</span></a>
    </li>
@endif --}}

@if (has_access('Backend\DesignationController@index'))
    <li class="menu-item" aria-haspopup="true"><a href="/admin/designation" class="menu-link "><i
                class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Designation</span></a>
    </li>
@endif

@if (has_access('Backend\DepartmentController@index'))
    <li class="menu-item" aria-haspopup="true"><a href="/admin/department" class="menu-link "><i
                class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Department</span></a>
    </li>
@endif
<li class="menu-item" aria-haspopup="true"><a href="/admin/career" class="menu-link "><i
            class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Applicants List</span></a>
</li>
@if (has_group_access(['Backend-VideoGallery', 'Backend-PhotoGallery']))
    <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover"><a href="#"
            class="menu-link menu-toggle"><span
                class="svg-icon menu-icon"><!--begin::Svg Icon | path:media/svg/icons/Design/Bucket.svg--><svg
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                    height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"></rect>
                        <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                        <path
                            d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z"
                            fill="#000000" opacity="0.3"></path>
                    </g>
                </svg><!--end::Svg Icon--></span><span class="menu-text">Gallery</span><i class="menu-arrow"></i></a>
        <div class="menu-submenu" kt-hidden-height="80" style="display: none; overflow: hidden;">
            <span class="menu-arrow"></span>
            <ul class="menu-subnav">
                <li class="menu-item  menu-item-parent" aria-haspopup="true">
                    <span class="menu-link"><span class="menu-text">Gallery</span></span>
                </li>
                <li class="menu-item " aria-haspopup="true"><a href="{{ url('/admin/photo-album') }}"
                        class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                            class="menu-text">Photo Album</span></a></li>
                <li class="menu-item " aria-haspopup="true"><a href="{{ url('/admin/photo-sub-album') }}"
                        class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                            class="menu-text">Photo Sub Album</span></a></li>
                <li class="menu-item " aria-haspopup="true"><a href="{{ url('/admin/photo-gallery') }}"
                        class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                            class="menu-text">Photo Gallery</span></a></li>
                @if (has_access('Backend\VideoGalleryController@index'))
                    <li class="menu-item " aria-haspopup="true"><a href="/admin/video-gallery" class="menu-link "><i
                                class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Video
                                Gallery</span></a></li>
                @endif
            </ul>
        </div>
    </li>
@endif
{{-- /* New backend modules 10-07-2023 */ --}}
<li class="menu-item" aria-haspopup="true"><a href="/admin/home-contents" class="menu-link "><i
            class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Home Contents</span></a></li>
<li class="menu-item" aria-haspopup="true"><a href="/admin/home-slider" class="menu-link "><i
            class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Home Slider</span></a></li>
<li class="menu-item" aria-haspopup="true"><a href="/admin/about-us" class="menu-link "><i
            class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">About Us Contents</span></a>
</li>
<li class="menu-item" aria-haspopup="true"><a href="/admin/service-contents" class="menu-link "><i
            class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Service Contents</span></a>
</li>
<li class="menu-item" aria-haspopup="true"><a href="/admin/healthcare-services" class="menu-link "><i
            class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Healthcare
            Services</span></a></li>
<li class="menu-item" aria-haspopup="true"><a href="/admin/disease-specific-medicare" class="menu-link "><i
            class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Disease Specific
            Medicares</span></a></li>
<li class="menu-item" aria-haspopup="true"><a href="/admin/timeline" class="menu-link "><i
            class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Timelines</span></a></li>
<li class="menu-item" aria-haspopup="true"><a href="/admin/newsletter" class="menu-link "><i
            class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Newsletters</span></a></li>
{{-- /* ends here */ --}}
