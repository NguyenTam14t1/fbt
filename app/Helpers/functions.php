<?php
use Carbon\Carbon;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Admin;

function escape_like($string)
{
    $search = ['%', '_', '&'];
    $replace = ['\%', '\_', '\&'];

    return str_replace($search, $replace, $string);
}

function timeAgo($time)
{
    return Carbon::parse($time)->diffForHumans();
}

function showLongString($string, $numberLimit = 20) {
    if (mb_strlen($string) > $numberLimit) {
        return mb_substr($string, 0, $numberLimit) . '...';
    }

    return $string;
}

function get_guard_name()
{
    $host = Request::getHttpHost();
    $pieces = explode('.', $host);
    return $pieces[0] ?? '';
}

if (! function_exists('get_guard_current')) {
    function get_guard_current()
    {
        return get_guard_name();
    }
}

if (!function_exists('route_g')) {
    function route_g($name, $param = [])
    {
        $guard = get_guard_current();
        return route($guard.'.'.$name, $param);
    }
}

if (!function_exists('class_active')) {
    function class_active($tabActive, $compare = '', $active = 'active')
    {
        return isset($tabActive) && $tabActive == $compare ? $active : '';
    }
}

function checkOwner($comment)
{
    return get_class(current_user()) == get_class($comment->user) && current_user()->id == $comment->user->id;
}

if (! function_exists('current_user')) {
    function current_user()
    {
        return Auth::guard(get_guard_current())->user();
    }
}

if (! function_exists('user_by_guard_email')) {
    function user_by_guard_email($guard, $credentials)
    {
        $user = null;
        if (in_array($guard, ['admin', 'teacher'])) {
            if ($guard == 'admin') {
                $user = Admin::where('email', $credentials['email'])->first();
            } else {
                $user = Teacher::where('email', $credentials['email'])->first();
            }
        } else {
            $user = User::where('email', $credentials['email'])->first();
        }

        return $user;
    }
}

if (! function_exists('build_new_url')) {
    function build_new_url($request, $itemRemoves=[])
    {
        $params = $request->all();
        foreach ($itemRemoves as $value) {
            unset($params[$value]);
        }

        return $request->url() . '?' .http_build_query($params);
    }
}

if (! function_exists('backgroundUrl')) {
    function backgroundUrl($url)
    {
        if ($url) {
            return 'background-image: url(\'' . $url .'\')';
        }

        return '';
    }
}

if (! function_exists('full_path_file')) {
    function full_path_file($pathFile, $disk = null)
    {
        $disk = $disk ?? config('filesystem.default');
        if ($pathFile) {
            return Storage::disk($disk)->url($pathFile);
        }

        return '';
    }
}

if (! function_exists('saveFileTemp')) {
    function saveFileTemp($pathFile) {
        return Storage::disk('public')->put($pathFile, Storage::disk('s3')->get($pathFile));
    }
}

if (!function_exists('origin_subdomain')) {
    function origin_subdomain() {
        $host = Request::getHttpHost();
        $pieces = explode('.', $host);

        return $pieces[0];
    }
}
