<?php
//路由命名.改為-
function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

function topic_category_nav_active($category_id)
{
    return active_class((if_route('topic_categories.show') && if_route_param('topic_category', $category_id)));
}

//產生摘要
function make_excerpt($value, $length = 200)
{
    $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));
    return Str::limit($excerpt, $length);
}


function ngrok_url($routeName, $parameters = [])
{
    // 開發環境，並且配置了 NGROK_URL
    if(app()->environment('local') && $url = config('app.ngrok_url')) {
        // route() 函數第三個參數代表是否絕對路徑
        return $url.route($routeName, $parameters, false);
    }

    return route($routeName, $parameters);
}

// 依郵遞區號判斷同縣市或外縣市或離島
function zip_distance($zip){
	$zip=substr($zip,0,3);
	$Distance='';
	switch($zip){
		//同縣市
		case '207':
		case '208': 
		case '220': 
		case '221': 
		case '222': 
		case '223':
		case '224': 
		case '226': 
		case '227': 
		case '228': 
		case '231': 
		case '232':
		case '233': 
		case '234': 
		case '235': 
		case '236': 
		case '237': 
		case '238':
		case '239': 
		case '241': 
		case '242': 
		case '243': 
		case '244': 
		case '247':
		case '248': 
		case '249': 
		case '251': 
		case '252': 
		case '253':
			$Distance='00';
		break;
		// 離島
		case '951':
		case '952':
		case '890':
		case '891':
		case '892':
		case '893':
		case '894':
		case '896':
		case '209':
		case '210':
		case '211':
		case '212':
		case '880':
		case '881':
		case '882':
		case '883':
		case '884':
		case '885':
			$Distance='02';
		break;
		default:
			$Distance='01';
		break;
	}


	return $Distance;
}
