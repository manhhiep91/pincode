<?php

namespace App\Helpers;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Helpers
{
    public static function getPublicLink($filename)
    {
        $url = Storage::disk("public")->url($filename);
        $url = str_replace('/storage/storage', '/storage', $url);
        return $url;
    }


    public static function paginate($_items, $_perPage, $_page = null, $_options = [])
    {
        $page = $_page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $_items instanceof Collection ? $_items : Collection::make($_items);
        return new LengthAwarePaginator($items->forPage($_page, $_perPage), $items->count(), $_perPage, $_page, $_options);
    }

    public static function pre($data = array())
    {
        echo '<pre>';
        print_r($data);
        die;
    }

    public static function formatDate($date = '')
    {
        $plusTime = 0;
        if (App::getLocale() == 'vi') {
            $plusTime = (7 * 60 * 60);
            return date('d/m/Y', (strtotime($date) + $plusTime));
        } else {
            return date('d/m/Y', (strtotime($date) + $plusTime));
        }
    }

    public static function titleAction($data)
    {
        return array(
            'title' => !empty($data[0]) ? $data[0] : '',
            'flag' => !empty($data[1]) ? $data[1] : ''
        );
    }

    public static function metaHead($data)
    {
        return array(
            'title_seo' => !empty($data['title_seo']) ? $data['title_seo'] : (!empty($data['name']) ? $data['name'] : ''),
            'keyword_seo' => !empty($data['keyword_seo']) ? $data['keyword_seo'] : $data['name'],
            'description_seo' => !empty($data['description_seo']) ? $data['description_seo'] : $data['name'],
            'og_image' => !empty($data['images']) ? $data['images'] : asset('images/web-thumb.jpg')
        );
    }


    public static function response($status, $body, $mgs)
    {
        return response()->json(['status' => $status, 'messages' => $mgs, 'body' => $body], $status);
    }

    public static function responseSuccess($body, $mgs)
    {
        return self::response(200, $body, $mgs);
    }

    public static function responseUnauthorized($body, $mgs)
    {
        return self::response(401, $body, $mgs);
    }

    public static function responseBadRequest($body, $mgs)
    {
        return self::response(400, $body, $mgs);
    }

    public static function responseForbidden($body, $mgs)
    {
        return self::response(403, $body, $mgs);
    }

    public static function responseNotFound($body, $mgs)
    {
        return self::response(404, $body, $mgs);
    }

    public static function responseUnprocessableEntity($body, $mgs)
    {
        return self::response(422, $body, $mgs);
    }

    public static function formatDateTime($format, $date)
    {
        return $date ? date($format, strtotime($date)) : '';
    }


    public static function RandomString($length = 15)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


}
