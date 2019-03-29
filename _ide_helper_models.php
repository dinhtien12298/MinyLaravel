<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\PostModel
 *
 * @property-read \App\Models\SubjectModel $subject
 * @property-read \App\Models\UserModel $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostModel query()
 */
	class PostModel extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ClassModel
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SubjectModel[] $subjects
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClassModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClassModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ClassModel query()
 */
	class ClassModel extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserModel
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostModel[] $posts
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserModel query()
 */
	class UserModel extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SubjectModel
 *
 * @property-read \App\Models\ClassModel $belongClass
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostModel[] $posts
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubjectModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubjectModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubjectModel query()
 */
	class SubjectModel extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AdvertimentModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdvertimentModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdvertimentModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdvertimentModel query()
 */
	class AdvertimentModel extends \Eloquent {}
}

