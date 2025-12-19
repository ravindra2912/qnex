<?php


return [

    "site_setting" => [
        "name" => "Qnex",
        "logo" => env('APP_URL') . '/assets/images/logo.png',
        "footer_logo" => env('APP_URL') . '/assets/images/footer-logo.webp',
        "fevicon" => env('APP_URL') . '/assets/images/fevicon-icon.png',
    ],

    "admin_notify_emails" => ['goswamirvi@gmail.com', 'bhargav@gmail.com'],

    "contactUs" => [
        "address" => "Office No 3-4 (1st Floor) Madhav Park, Opp. Tirupati Balaji Complex, Near Maruti Chowk, L. H. Road, Hirabaugh, Surat, Gujarat 395006",
        "contact" => ['8128121857', '9099101246'],
        "whatsapp" => 8128121857,
        "email" => 'Salesqnex@gmail.com',
    ],

    "socialMedia" => [
        "facebook" => "https://www.facebook.com/Qnex.in",
        "instagram" => "https://www.instagram.com/qnex.in",
        "linkedin" => "https://www.linkedin.com/company/qnexofficial",
        "threads" => "https://www.threads.com/@qnex.in",
        "google_business" => "https://share.google/AyO7Rx10sxbUdP7Z5",
        "youtube" => "https://www.youtube.com/@Qnexofficial",
    ],

    "common_status" => ["active", "in-active"],
    "blog_status" => ["active", "in-active"],

    "legal_page_type" => ["PrivacyPolicy", "TermsAndCondition", "CancellationAndReturnPolicy", "AboutUs"],


    "rating" => [
        0 => 'No Review',
        1 => 'Bad',
        2 => 'Poor',
        3 => 'Average',
        4 => 'Good',
        5 => 'Excellent',
    ],

    "gender" => ['male', 'female', 'other'],
    "user_role" => ['admin', 'user'],
    "user_status" => ['active', 'in-active', 'banned'],
    "app_playstore_url" => 'https://play.google.com/store/apps/details?id=com.quietly.app',


];