<?php

use App\Sharp\Admin\Tag\TagEntity;
use App\Sharp\Admin\User\UserEntity;
use App\Sharp\Admin\WeatherDailyReport\WeatherDailyReportEntity;
use App\Sharp\Admin\WeatherStation\WeatherStationEntity;
use App\Sharp\ClimaSharpMenu;
use App\Sharp\MyBlogposts\BlogpostEntity;
use App\Sharp\MyProfile\MemberEntity;
use App\Sharp\MyWeatherDailyReports\MyWeatherDailyReportEntity;
use App\Sharp\MyWeatherStation\MyWeatherStationEntity;

return [

    // Required. The name of your app, as it will be displayed in Sharp.
    "name" => "CLI.M.A.",

    // Optional. You can here customize the URL segment in which Sharp will live. Default in "sharp".
    "custom_url_segment" => "sharp",

    // Optional. You can prevent Sharp version to be displayed in the page title. Default is true.
    "display_sharp_version_in_title" => true,

    // Optional. You can display a breadcrumb on all Sharp pages. Default is false.
    "display_breadcrumb" => false,

    // Optional. Handle extensions.
//    "extensions" => [
//        "assets" => [
//            "strategy" => "asset",
//            "head" => [
//                "/css/inject.css",
//            ],
//        ],
//
//        "activate_custom_fields" => false,
//    ],

    // Required. Your entities list, as entityKey => \App\Sharp\Entities\SharpEntity implementation
    "entities" => [
        "my_profile" => MemberEntity::class,
        "my_station" => MyWeatherStationEntity::class,
        "my_daily_reports" => MyWeatherDailyReportEntity::class,
        "my_blogposts" => BlogpostEntity::class,
        //admin
        "users" => UserEntity::class,
        "stations" => WeatherStationEntity::class,
        "daily_reports" => WeatherDailyReportEntity::class,
        "tags" => TagEntity::class,
    ],

    // Optional. Your dashboards list, as entityKey => \App\Sharp\Entities\SharpDashboardEntity implementation
    "dashboards" => [
//        "my_dashboard" => \App\Sharp\Entities\MyDashboardEntity::class,
    ],

    // Optional. Your global filters list, which will be displayed in the main menu.
    "global_filters" => [
//        "my_global_filter" => \App\Sharp\Filters\MyGlobalFilter::class
    ],

    // Required. The main menu (left bar), which may contain links to entities, dashboards
    // or external URLs, grouped in categories.
    "menu" => ClimaSharpMenu::class,

    // Optional. Your file upload configuration.
    "uploads" => [
        // Tmp directory used for file upload.
        "tmp_dir" => env("SHARP_UPLOADS_TMP_DIR", "tmp"),

        // These two configs are used for thumbnail generation inside Sharp.
        "thumbnails_disk" => env("SHARP_UPLOADS_THUMBS_DISK", "public"),
        "thumbnails_dir" => env("SHARP_UPLOADS_THUMBS_DIR", "thumbnails"),
    ],

    // Optional. Options for form markdown editor (SharpFormMarkdownField)
    "markdown_editor" => [
        // If false, the UL tool will display a dropdown to choose between tight and normal lists
        "tight_lists_only" => true,
        // If false, simple carriage return will not be converted to <br> (in Sharp)
        "nl2br" => false,
    ],

    // Optional. Auth related configuration.
    "auth" => [
        // Name of the login and password attributes of the User Model.
        "login_attribute" => "email",
        "password_attribute" => "password",

        // Name of the attribute used to display the current user in the UI.
        "display_attribute" => "name",

        // Optional additional auth check.
//        "check_handler" => \App\Sharp\ClimaSharpCheckHandler::class,

        // Optional custom guard
//        "guard" => "sharp",
    ],

//    "login_page_message_blade_path" => env("SHARP_LOGIN_PAGE_MESSAGE_BLADE_PATH", "sharp/_login-page-message"),

    "theme" => [
        "primary_color" => "#004c9b",
//        "favicon_url" => "",
//        "logo_urls" => [
//            "menu" => "/sharp-assets/menu-icon.png",
//            "login" => "/sharp-assets/login-icon.png",
//        ],
    ],

];
