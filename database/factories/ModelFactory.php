<?php

/**
 * User
 */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    $firstName = $faker->unique()->firstName;
    $lastName  = $faker->lastName;
    $name      = $firstName . ' ' . $lastName;

    return [
        'name'          => $name,
        'slug'          => str_slug($name),
        'first_name'    => $firstName,
        'last_name'     => $lastName,
        'profile_image' => $faker->imageUrl(640, 480),
        'timezone'      => $faker->timezone,
        'email'         => $faker->email,
        'password'      => $faker->md5,
    ];
});

/**
 * Team
 */
$factory->define(App\Models\Team::class, function (Faker\Generator $faker) {
    $name = $faker->company;

    return [
        'name'      => $name,
        'slug'      => str_slug($name),
        'team_logo' => $faker->imageUrl(640, 480),
        'user_id'   => factory(App\Models\User::class)->create()->id,
    ];
});

/**
 * Space
 */
$factory->define(App\Models\Space::class, function (Faker\Generator $faker) {
    $name = $faker->name;

    return [
        'name'    => $name,
        'slug'    => str_slug($name),
        'outline' => $faker->paragraph,
        'user_id' => factory(App\Models\User::class)->create()->id,
        'team_id' => factory(App\Models\Team::class)->create()->id,
    ];
});

/**
 * Wiki
 */
$factory->define(App\Models\Wiki::class, function (Faker\Generator $faker) {
    $name = $faker->name;

    return [
        'name'        => $name,
        'slug'        => str_slug($name),
        'space_id'    => factory(App\Models\Space::class)->create()->id,
        'outline'     => $faker->paragraph,
        'description' => $faker->paragraph,
        'user_id'     => factory(App\Models\User::class)->create()->id,
        'team_id'     => factory(App\Models\Team::class)->create()->id,
    ];
});

/**
 * Page
 */
$factory->define(App\Models\Page::class, function (Faker\Generator $faker) {
    $name = $faker->name;

    return [
        'name'        => $name,
        'slug'        => str_slug($name),
        'outline'     => $faker->paragraph,
        'description' => $faker->paragraph,
        'position'    => $faker->numberBetween(0, 10),
        'user_id'     => factory(App\Models\User::class)->create()->id,
        'wiki_id'     => factory(App\Models\Wiki::class)->create()->id,
        'team_id'     => factory(App\Models\Team::class)->create()->id,
    ];
});

/**
 * Comment
 */
$factory->define(App\Models\Comment::class, function (Faker\Generator $faker) {
    $subjectType = $faker->randomElement([App\Models\Wiki::class, App\Models\Page::class]);

    return [
        'content'      => $faker->paragraph,
        'subject_type' => $subjectType,
        'subject_id'   => str_contains($subjectType, 'Wiki') ? factory(App\Models\Wiki::class)->create()->id : factory(App\Models\Page::class)->create()->id,
        'user_id'      => factory(App\Models\User::class)->create()->id,
    ];
});

/**
 * Integration
 */
$factory->define(App\Models\Integration::class, function (Faker\Generator $faker) {
    return [
        'title'   => $faker->title,
        'slug'    => $faker->slug,
        'url'     => $faker->url,
        'team_id' => factory(App\Models\Team::class)->create()->id,
        'user_id' => factory(App\Models\User::class)->create()->id,
    ];
});

/**
 * Invite
 */
$factory->define(App\Models\Invite::class, function (Faker\Generator $faker) {
    return [
        'code'    => $faker->md5,
        'email'   => $faker->email,
        'team_id' => factory(App\Models\Team::class)->create()->id,
        'role_id' => factory(App\Models\Role::class)->create()->id,
    ];
});

/**
 * Like
 */
$factory->define(App\Models\Like::class, function (Faker\Generator $faker) {
    $subjectType = $faker->randomElement([App\Models\Wiki::class, App\Models\Page::class, App\Models\Comment::class]);

    switch ($subjectType) {
        case str_contains($subjectType, 'Wiki'):
            $subject = factory(App\Models\Wiki::class)->create();
            break;
        case str_contains($subjectType, 'Page'):
            $subject = factory(App\Models\Page::class)->create();
            break;
        default:
            $subject = factory(App\Models\Comment::class)->create();
            break;
    }

    return [
        'subject_type' => $subjectType,
        'subject_id'   => $subject->id,
        'user_id'      => factory(App\Models\User::class)->create()->id,
    ];
});

/**
 * Page Tags
 */
$factory->define(App\Models\PageTags::class, function (Faker\Generator $faker) {
    $subjectType = $faker->randomElement([App\Models\Wiki::class, App\Models\Page::class]);

    return [
        'tag_id'       => factory(App\Models\Tag::class)->create()->id,
        'subject_type' => $subjectType,
        'subject_id'   => str_contains($subjectType, 'Wiki') ? factory(App\Models\Wiki::class)->create()->id : factory(App\Models\Page::class)->create()->id,
    ];
});

/**
 * ReadList
 */
$factory->define(App\Models\ReadList::class, function (Faker\Generator $faker) {
    $subjectType = $faker->randomElement([App\Models\Wiki::class, App\Models\Page::class]);

    return [
        'subject_type' => $subjectType,
        'subject_id'   => str_contains($subjectType, 'Wiki') ? factory(App\Models\Wiki::class)->create()->id : factory(App\Models\Page::class)->create()->id,
        'user_id'      => factory(App\Models\User::class)->create()->id,
    ];
});

/**
 * Activity
 */
$factory->define(App\Models\Activity::class, function (Faker\Generator $faker) {
    $subject     = '';
    $subjectType = $faker->randomElement([App\Models\Wiki::class, App\Models\Page::class, App\Models\Space::class, App\Models\Comment::class]);

    switch ($subjectType) {
        case str_contains($subjectType, 'Wiki'):
            $subject = factory(App\Models\Wiki::class)->create();
            break;
        case str_contains($subjectType, 'Page'):
            $subject = factory(App\Models\Page::class)->create();
            break;
        case str_contains($subjectType, 'Space'):
            $subject = factory(App\Models\Space::class)->create();
            break;
        default:
            $subject = factory(App\Models\Comment::class)->create();
            break;
    }

    return [
        'name'         => $faker->randomElement(['wiki_created', 'wiki_deleted', 'wiki_updated', 'page_created', 'page_deleted', 'page_updated', 'comment_created', 'comment_deleted', 'comment_updated', 'space_created', 'space_deleted', 'space_updated',]),
        'subject_type' => $subjectType,
        'subject_id'   => $subject->id,
        'user_id'      => factory(App\Models\User::class)->create()->id,
        'team_id'      => factory(App\Models\Team::class)->create()->id,
    ];
});

/**
 * Role
 */
$factory->define(App\Models\Role::class, function (Faker\Generator $faker) {
    $name = $faker->name;

    return [
        'name'    => $name,
        'slug'    => str_slug($name),
        'user_id' => factory(App\Models\User::class)->create()->id,
        'team_id' => factory(App\Models\Team::class)->create()->id,
    ];
});

/**
 * Tag
 */
$factory->define(App\Models\Tag::class, function (Faker\Generator $faker) {
    $name = $faker->name;

    return [
        'name' => $name,
        'slug' => str_slug($name),
    ];
});

/**
 * Tag
 */
$factory->define(App\Models\PageTags::class, function (Faker\Generator $faker) {
    $subjectType = $faker->randomElement([App\Models\Wiki::class, App\Models\Page::class]);

    return [
        'tag_id'       => factory(App\Models\Tag::class)->create()->id,
        'subject_id'   => str_contains($subjectType, 'Wiki') ? factory(App\Models\Wiki::class)->create()->id : factory(App\Models\Page::class)->create()->id,
        'subject_type' => $subjectType,
    ];
});

/**
 * WatchWiki
 */
$factory->define(App\Models\WatchWiki::class, function (Faker\Generator $faker) {
    return [
        'wiki_id' => factory(App\Models\Wiki::class)->create()->id,
        'user_id' => factory(App\Models\User::class)->create()->id,
    ];
});
