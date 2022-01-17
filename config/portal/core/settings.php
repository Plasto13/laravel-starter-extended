<?php

return [
    'app_name' => [
        'label' => 'core::settings.app_name',
        'description' => 'core::settings.app_name_description',
        'view' => 'text',
        'translatable' => true,
        'default' => 'Laravel Starter',
        'groupClass' => 'col-md-6 col-sm-12', // any class for form group
        'class' => '', // any class for input
        'rules' => 'required',
    ],
    'meta_site_name' => [
        'label' => 'core::settings.meta_site_name',
        'description' => 'core::settings.meta_site_name_description',
        'view' => 'text',
        'translatable' => true,
        'default' => '',
        'groupClass' => 'col-md-6 col-sm-12',
        'class' => '', // any class for input
        'rules' => 'required',
    ],
    'locales' => [
        'label' => 'core::settings.aviable_locale',
        'description' => 'core::settings.aviable_locale_description',
        'view' => 'select-locales',
        'translatable' => false,
        'default' => ['en', 'sk'],
        'groupClass' => 'col-md-12 col-sm-12',
        'class' => 'select2', // any class for input
        'rules' => '',
    ],
    'meta_description' => [
        'label' => 'core::settings.meta_description',
        'description' => 'core::settings.meta_description_description',
        'view' => 'text',
        'translatable' => true,
        'default' => '',
        'groupClass' => 'col-md-12 col-sm-12',
        'class' => '', // any class for input
        'rules' => 'required',
    ],
    'meta_keyword' => [
        'label' => 'core::settings.meta_keyword',
        'description' => 'core::settings.meta_keyword_description',
        'view' => 'text',
        'translatable' => true,
        'default' => '',
        'groupClass' => 'col-md-6 col-sm-12',
        'class' => '', // any class for input
        'rules' => 'required',
    ],
    'meta_image' => [
        'label' => 'core::settings.meta_image',
        'description' => 'core::settings.meta_image_description',
        'view' => 'text',
        'translatable' => false,
        'default' => 'img/default_banner.jpg',
        'groupClass' => 'col-md-6 col-sm-12',
        'class' => '', // any class for input
        'rules' => 'required',
    ],
    'meta_fb_app_id' => [
        'label' => 'core::settings.meta_fb_app_id',
        'description' => 'core::settings.meta_fb_app_id_description',
        'view' => 'text',
        'translatable' => false,
        'default' => '',
        'groupClass' => 'col-md-6 col-sm-12',
        'class' => '', // any class for input
        'rules' => 'required',
    ],
    'meta_twitter_site' => [
        'label' => 'core::settings.meta_twitter_site',
        'description' => 'core::settings.meta_twitter_site_description',
        'view' => 'text',
        'translatable' => false,
        'default' => '',
        'groupClass' => 'col-md-6 col-sm-12',
        'class' => '', // any class for input
        'rules' => 'required',
    ],
    'meta_twitter_creator' => [
        'label' => 'core::settings.meta_twitter_creator',
        'description' => 'core::settings.meta_twitter_creator_description',
        'view' => 'text',
        'translatable' => false,
        'default' => '',
        'groupClass' => 'col-md-6 col-sm-12',
        'class' => '', // any class for input
        'rules' => 'required',
    ],
    'google_analytics' => [
        'label' => 'core::settings.google_analytics',
        'description' => 'core::settings.google_analytics_description',
        'view' => 'text',
        'translatable' => false,
        'default' => '',
        'groupClass' => 'col-md-6 col-sm-12',
        'class' => '', // any class for input
        'help' => 'Paste the tracking code in this field.', // Help text for the input field.
    ],
    'backend_theme' => [
        'label' => 'core::settings.backend_theme',
        'description' => 'core::settings.backend_theme_description',
        'view' => 'select-backend-theme',
        'translatable' => false,
        'value' => 'adminlte3',
        'groupClass' => 'col-md-4 col-sm-12',
        'class' => 'select2', // any class for input
        'rules' => 'required',
    ],
    'frontend_theme' => [
        'label' => 'core::settings.frontend_theme',
        'description' => 'core::settings.frontend_theme_description',
        'view' => 'select-frontend-theme',
        'translatable' => false,
        'value' => 'starter',
        'groupClass' => 'col-md-4 offset-md-4 col-sm-12',
        'class' => 'select2', // any class for input
    ],
    'email' => [
        'label' => 'core::settings.email',
        'description' => 'core::settings.email_description',
        'view' => 'email',
        'translatable' => false,
        'default' => 'info@example.com',
        'groupClass' => 'col-md-6 col-sm-12',
        'class' => '', // any class for input
        'rules' => 'required|email',
    ],
    'facebook_url' => [
        'label' => 'core::settings.facebook_url',
        'description' => 'core::settings.facebook_url_description',
        'view' => 'text',
        'translatable' => false,
        'default' => '',
        'groupClass' => 'col-md-6 col-sm-12',
        'class' => '', // any class for input
        'rules' => 'required|nullable|max:191'
    ],
    'twitter_url' => [
        'label' => 'core::settings.twitter_url',
        'description' => 'core::settings.twitter_url_description',
        'view' => 'text',
        'translatable' => false,
        'default' => '',
        'groupClass' => 'col-md-6 col-sm-12',
        'class' => '', // any class for input
        'rules' => 'required|nullable|max:191'
    ],
    'instagram_url' => [
        'label' => 'core::settings.instagram_url',
        'description' => 'core::settings.instagram_url_description',
        'view' => 'text',
        'translatable' => false,
        'default' => '',
        'groupClass' => 'col-md-6 col-sm-12',
        'class' => '', // any class for input
        'rules' => 'required|nullable|max:191'
    ],
    'linkedin_url' => [
        'label' => 'core::settings.linkedin_url',
        'description' => 'core::settings.linkedin_url_description',
        'view' => 'text',
        'translatable' => false,
        'default' => '',
        'groupClass' => 'col-md-6 col-sm-12',
        'class' => '', // any class for input
        'rules' => 'required|nullable|max:191'
    ],
    'youtube_url' => [
        'label' => 'core::settings.youtube_url',
        'description' => 'core::settings.youtube_url_description',
        'view' => 'text',
        'translatable' => false,
        'default' => '',
        'groupClass' => 'col-md-6 col-sm-12',
        'class' => '', // any class for input
        'rules' => 'required|nullable|max:191'
    ],
    'show_copyright' => [
        'label' => 'core::settings.show_copyright',
        'description' => 'core::settings.show_copyright_description',
        'view' => 'checkbox',
        'translatable' => false,
        'default' => 1,
        'groupClass' => 'col-12',
        'class' => '', // any class for input
    ],
    'footer_text' => [
        'label' => 'core::settings.footer_text',
        'description' => 'core::settings.footer_text_description',
        'view' => 'text',
        'translatable' => true,
        'default' => 'Laravel Starter',
        'groupClass' => 'col-md-6 col-sm-12', // any class for form group
        'class' => '', // any class for input
        'rules' => 'required',
    ],
];
