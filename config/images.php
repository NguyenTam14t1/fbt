<?php

return [
    'paths' => [
        'user_avatar' => 'uploads/user_avatar',
        'guide_avatar' => 'uploads/guide_avatar',
        'admin_avatar' => 'uploads/admin_avatar',
        'image_tour' => 'uploads/image_tour',
        'thumbnail_tour' => 'uploads/thumbnail_tour',
        'news' => 'uploads/news',
    ],
    'validate' => [
        'user_avatar' => [
            'mimes' => 'jpeg,png,jpg',
            'max_size' => 2048,
        ],
    ],
    'accept_extension' => '.jpeg,.png,.jpg',
    'default' => [
        'user_avatar' => '',
    ],
    'dimensions' => [
        'user_avatar' => [
            'larger' => [150, 150],
            'normal' => [160, 160],
            'small' => [64, 64],
        ],
        'teacher_avatar' => [
            'larger' => [150, 150],
            'normal' => [160, 160],
            'small' => [64, 64],
        ],
        'admin_avatar' => [
            'larger' => [150, 150],
            'normal' => [160, 160],
            'small' => [64, 64],
        ],
        'image_lesson' => [
            'original' => '',
        ],
        'thumbnail_tour' => [
            'original' => '',
            'larger' => [195, 140],
        ],
        'news' => [
            'small' => [120, 120],
            'larger' => [120, 120],
        ]
    ],
    'not_resize' => [],
];
