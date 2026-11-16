<?php



/**
 * Created by IntelliJ IDEA.
 * User: Mamun
 * Date: 4/16/2019
 * Time: 2:29 PM
 */
function compressImageV2($compressImageTmp, $image_path = '', $type = '', $max_width = '', $max_height = '', $imageQuality = '')
{
    // Dimension oporibortito — kono resize hobe na
    $width = imagesx($compressImageTmp);
    $height = imagesy($compressImageTmp);

    $tmpimg = imagecreatetruecolor($width, $height);

    $hasTransparency = false;
    if ($type === 'image/png') {
        $hasTransparency = compressImageV2_hasAlpha($compressImageTmp, $width, $height);
    }

    if ($type === 'image/png' || $type === 'image/gif') {
        imagealphablending($tmpimg, false);
        imagesavealpha($tmpimg, true);
        $transparent = imagecolorallocatealpha($tmpimg, 255, 255, 255, 127);
        imagefilledrectangle($tmpimg, 0, 0, $width, $height, $transparent);
    } else {
        $white = imagecolorallocate($tmpimg, 255, 255, 255);
        imagefilledrectangle($tmpimg, 0, 0, $width, $height, $white);
    }

    imagecopyresampled($tmpimg, $compressImageTmp, 0, 0, 0, 0, $width, $height, $width, $height);

    // Quality ekhon 5 porjonto namano jete pare (agey 50 chilo minimum)
    $jpgQuality = $imageQuality ? (int) $imageQuality : 20;
    $jpgQuality = max(5, min(90, $jpgQuality));

    switch ($type) {
        case 'image/png':
            if ($hasTransparency) {
                imagepng($tmpimg, '.' . $image_path, 6);
            } else {
                $image_path = preg_replace('/\.png$/i', '.jpg', $image_path);
                $whiteFlat = imagecreatetruecolor($width, $height);
                $white = imagecolorallocate($whiteFlat, 255, 255, 255);
                imagefilledrectangle($whiteFlat, 0, 0, $width, $height, $white);
                imagecopy($whiteFlat, $tmpimg, 0, 0, 0, 0, $width, $height);
                imagejpeg($whiteFlat, '.' . $image_path, $jpgQuality);
                imagedestroy($whiteFlat);
            }
            break;

        case 'image/jpeg':
            imagejpeg($tmpimg, '.' . $image_path, $jpgQuality);
            break;

        case 'image/gif':
            imagegif($tmpimg, '.' . $image_path);
            break;
    }

    imagedestroy($tmpimg);
    imagedestroy($compressImageTmp);

    return $image_path;
}

function compressImageV2_hasAlpha($image, $width, $height)
{
    $step = max(1, (int) round(min($width, $height) / 100));
    for ($x = 0; $x < $width; $x += $step) {
        for ($y = 0; $y < $height; $y += $step) {
            $rgba = imagecolorat($image, $x, $y);
            $alpha = ($rgba & 0x7F000000) >> 24;
            if ($alpha > 0) {
                return true;
            }
        }
    }
    return false;
}
function profilePhotoUploadsV2($request, $destinationPath, $name, $max_width = '', $max_height = '', $imageQuality = '')
{
    try {
        if ($request->hasFile($name)) {
            $file = $request->file($name);

            $imageType = getImageType($file);
            $resizeImage = compressImageTmp($file);

            $orginalName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $request->file($name)->move(public_path($destinationPath), $orginalName);
            $image_path = $destinationPath . $orginalName;

            // compressImageV2 ekhon actual saved path return kore (.jpg hote pare)
            $image_path = compressImageV2($resizeImage, $image_path, $imageType, $max_width, $max_height, $imageQuality);

            return $image_path;
        }
    } catch (Exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
    }
}


// new end
function invalidMobileNumber($mobile)
{
    if (!preg_match('/^(((\+|00)?880)|0)(\d){10}$/', $mobile)) {
        return true;
    }
}

function translate_numbers($string, $lang)
{
    $output = "";
    if ($lang == 'bn') {
        $bn_digits = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
        $output = str_replace(range(0, 9), $bn_digits, $string);
    } else {
        $output = $string;
    }
    return $output;
}
function getUserIP()
{
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
        $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if (filter_var($client, FILTER_VALIDATE_IP)) {
        $ip = $client;
    } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
        $ip = $forward;
    } else {
        $ip = $remote;
    }

    return $ip;
}

function makeSlug($title)
{
    $title = strtolower($title);
    $title = str_replace(' ', '_', $title);
    return $title;
}
function isEnglishWord($string)
{

    $string = strip_tags($string);

    if (strlen($string) != strlen(utf8_decode($string))) {
        return false;
    } else {
        return true;
    }
}

function wordSummary($string, $maxlength)
{
    $string = strip_tags($string);

    if ($string) {
        if (strlen($string) < 30) {
            return $string;
        }
        $text = substr($string, 0, strrpos(substr($string, 0, $maxlength), ' '));
        return $text;
    } else {
        return '';
    }
}
function wordSummery($string, $maxlength)
{
    $string = strip_tags($string);

    if ($string) {
        if (strlen($string) < 30) {
            return $string;
        }
        $text = substr($string, 0, strrpos(substr($string, 0, $maxlength), ' '));
        return $text;
    } else {
        return '';
    }
}

function compressImageTmp($source)
{
    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg')
        $image = imagecreatefromjpeg($source);

    elseif ($info['mime'] == 'image/gif')
        $image = imagecreatefromgif($source);

    elseif ($info['mime'] == 'image/png')
        $image = imagecreatefrompng($source);
    return $image;
}


function getImageType($source)
{
    $info = getimagesize($source);
    return $info['mime'];
}

/*
 * $destinationPath = '/path/'
 * compressImage(string Processed signature, string Image Path, string Image Type',int Max Width,int Max Height, int Quality(%));
 * return string
 */

function profilePhotoUploads($request, $destinationPath, $name, $max_width = '', $max_height = '', $imageQuality = '')
{


    try {

        if ($request->hasFile($name)) {

            $file = $request->file($name);

            $imageType = getImageType($file);
            $resizeImage = compressImageTmp($file);

            $orginalName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $request->file($name)->move(public_path($destinationPath), $orginalName);
            $image_path = $destinationPath . $orginalName;



            compressImage($resizeImage, $image_path, $imageType, $max_width, $max_height, $imageQuality);


            return $image_path;
        }
    } catch (Exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
    }
}

/*
 * $destinationPath = '/path/'
 * compressImage(string Processed signature, string Image Path, string Image Type',int Max Width,int Max Height, int Quality(%));
 * return string
 */

function photoUploads($request, $destinationPath, $name, $max_width = '', $max_height = '', $imageQuality = '')
{


    try {

        if ($request->hasFile($name)) {

            $file = $request->file($name);

            $imageType = getImageType($file);
            $resizeImage = compressImageTmp($file);

            $orginalName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $request->file($name)->move(public_path($destinationPath), $orginalName);
            $image_path = $destinationPath . $orginalName;



            compressImage($resizeImage, $image_path, $imageType, $max_width, $max_height, $imageQuality);


            return $image_path;
        }
    } catch (Exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
    }
}

function getYoutubeID($url)
{
    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
    $youtube_id = $match[1] ?? '';
    return $youtube_id;
}

function isInvalidYoutubeUrl($yt_url)
{
    if (!$yt_url) {
        return true;
    }
    $url_parsed_arr = parse_url($yt_url);
    if ($url_parsed_arr['host'] ?? '' == "www.youtube.com" && $url_parsed_arr['path'] ?? '' == "/watch" && substr($url_parsed_arr['query'], 0, 2) == "v=" && substr($url_parsed_arr['query'], 2) != "") {
        return false;
    } else {
        return true;
    }
}

function compressImage($compressImageTmp, $image_path = '', $type = '', $max_width = '', $max_height = '', $imageQuality = '')
{

    // Takes the sourcefile (path/to/image.jpg) and makes a thumbnail from it
    // and places it at endfile (path/to/thumb.jpg).

    $width = imagesx($compressImageTmp);
    $height = imagesy($compressImageTmp);

    if (!$max_width || !$max_height) {
        $newwidth = $width;
        $newheight =  $height;
    } else {
        if ($width > $height) {
            if ($width < $max_width)
                $newwidth = $width;
            else
                $newwidth = $max_width;
            $divisor = $width / $newwidth;
            $newheight = floor($height / $divisor);
        } else {
            if ($height < $max_height)
                $newheight = $height;
            else
                $newheight =  $max_height;
            $divisor = $height / $newheight;
            $newwidth = floor($width / $divisor);
        }
    }


    // Create a new temporary image.
    $tmpimg = imagecreatetruecolor($newwidth, $newheight);

    imagealphablending($tmpimg, false);
    imagesavealpha($tmpimg, true);

    // Copy and resize old image into new image.
    imagecopyresampled($tmpimg, $compressImageTmp, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    // Save thumbnail into a file.

    //compressing the file

    switch ($type) {
        case 'image/png':
            if (!$imageQuality) {
                $imageQuality = 0;
            } else {
                $imageQuality = ceil(9 * $imageQuality / 100);
            }

            imagepng($tmpimg, '.' . $image_path, $imageQuality);
            break;
        case 'image/jpeg':
            if (!$imageQuality) {
                $imageQuality = 0;
            } else {
                $imageQuality = ceil(100 * $imageQuality / 100);
            }
            imagejpeg($tmpimg, '.' . $image_path, $imageQuality);
            break;
        case 'image/gif':
            if (!$imageQuality) {
                $imageQuality = 0;
            } else {
                $imageQuality = ceil(9 * $imageQuality / 100);
            }
            imagegif($tmpimg, '.' . $image_path, $imageQuality);
            break;
    }

    // release the memory
    imagedestroy($tmpimg);
    imagedestroy($compressImageTmp);
}






function getFirstLetter($string)
{
    return ucfirst(substr($string, 0, 1));
}

function getEmailLeft($email)
{
    $email = explode("@", $email);
    return trim($email[0]);
}

function makeLink($user, $event_type)
{
    return \URL::to('/') . '/' . $user . '/' . $event_type;
}

function dateRangeToDate($daterange)
{
    $parseDate = substr($daterange, 0, 10);
    $formatedDate = date('F j, Y', strtotime($parseDate));
    return $formatedDate;
}

function dateRangeToStartDate($daterange)
{
    $startDate = substr($daterange, 0, 10);
    return trim(trim($startDate));
}

function dateRangeToEndDate($daterange)
{
    //    $endDate = substr($daterange,-20,-8);
    $endDate = substr($daterange, -10);
    return trim($endDate);
}

function dateRangeToMeetingDuration($daterange)
{
    $daterangeSep = explode("-", $daterange);
    $meetFromPre = $daterangeSep[2];
    $meetToPre = $daterangeSep[5];
    $meetFrom = str_replace('', ':', substr($meetFromPre, 2));
    $meetTo = str_replace('', ':', substr($meetToPre, 2));
    return $meetFrom . '-' . $meetTo;
}

function getEveryWeekArray($everyWeeks)
{
    return json_decode($everyWeeks);
}

function pastEvent($event)
{

    if ($event->getTimeSlots ?? '') {
        foreach ($event->getTimeSlots as $getTimeSlot) {
            $startTime = __convertStandardTime($getTimeSlot->date_from);


            if (strtotime($startTime) >= strtotime('Y-m-d')) {
                return false;
            }
        }
        return true;
    }
}

function halfHourTimes()
{
    $formatter = function ($time) {
        if ($time % 3600 == 0) {
            return date('ga', $time);
        } else {
            return date('g:ia', $time);
        }
    };

    $halfHourSteps = range(0, 47 * 1800, 1800);
    return array_map($formatter, $halfHourSteps);
}

function jsonToCommaseperate($meetingDuration)
{
    if ($meetingDuration) {
        $meetings = implode(', ', json_decode($meetingDuration));
    }
    return $meetings;
}

function get_hours_range($getRequestedEvent)
{
    $minDuration = $getRequestedEvent->event_duration;
    $minDuration = preg_replace('/\D/', '', $minDuration);
    $step = $minDuration * 60;

    $times = array();
    if ($getRequestedEvent->getTimeSlots) {
        foreach ($getRequestedEvent->getTimeSlots as $key => $timeSlot) {

            $startTime = __convertStandardTime($timeSlot->start_time);
            $startTime = strtotime($startTime);
            $startTime = date('H', $startTime);


            $endTime = __convertStandardTime($timeSlot->end_time);
            $endTime = strtotime($endTime);
            $endTime = date('H', $endTime);

            $start = 3600 * $startTime;
            $end = 3600 * $endTime;
            foreach (range($start, $end, $step) as $timestamp) {
                $hour_mins = gmdate('H:i', $timestamp);
                if (! empty($format))
                    $times[] = gmdate($format, $timestamp);
                else $times[] = date("g:ia", strtotime($hour_mins));
            }
        }
    }

    return $times;
}

function timezoneArray()
{
    // time zones list from PHP
    $timezone_identifiers = DateTimeZone::listIdentifiers() ?? DateTimeZone::listIdentifiers(NULL);
    $continent = "";
    $i = "";
    $timezones = array();
    $phpTime = Date("Y-m-d H:i:s");

    foreach ($timezone_identifiers as $key => $value) {
        if (preg_match('/^(Europe|America|Asia|Antartica|Arctic|Atlantic|Indian|Pacific)\//', $value)) {
            $ex = explode("/", $value); //obtain continent,city
            if ($continent != $ex[0]) {
                $i = $ex[0];
            }

            $timezone = new DateTimeZone($value); // Get default system timezone to create a new DateTimeZone object
            $offset = $timezone->getOffset(new \DateTime($phpTime));
            $offsetHours = round(abs($offset) / 3600);
            $offsetString = ($offset < 0 ? '-' : '+');
            if ($offsetHours == 1 or $offsetHours == -1) {
                $label = "Hour";
            } else {
                $label = "Hours";
            }

            $city = $ex[1];
            $continent = $ex[0];
            $c[$i][$value] = isset($ex[2]) ? $ex[1] . ' - ' . $ex[2] : $ex[1];
            $timezones[$i][$value] = $c[$i][$value] . " (" . $offsetString . $offsetHours . " " . $label . ")";
        }
    }
    return $timezones;
}

function monthNumToMonthName($monthNum)
{
    $dateObj   = DateTime::createFromFormat('!m', $monthNum);
    $monthName = $dateObj->format('F'); // March
    return $monthName;
}

function getCredetialFromDB($code)
{
    return \App\Models\Apps\ThirdpartyApps::where('code', $code)->firstOrFail();
}

function __convertStandardTime($time)
{

    if (strpos(strtoupper($time), 'PM') !== false) {
        $s = \Carbon\Carbon::parse(strtoupper($time));
        $modified_time = $s->format('G:i');
        $modified_time = trim(str_replace("PM", "", $modified_time)) . ':00';
    } else {
        $modified_time = trim(str_replace("AM", "", strtoupper($time))) . ':00';
    }
    return $modified_time;
}

function authID()
{
    return \Auth::id();
}

function getTimeSlotArray($date)
{

    return $date;
}

function dateTimeToUTC($datetime, $timezone)
{

    $datetime = strtoupper($datetime);
    date_default_timezone_set($timezone);
    $asia_timestamp = strtotime($datetime);
    date_default_timezone_set('UTC');

    $utcDateTime = date("Y-m-d H:i", $asia_timestamp);

    $time = new DateTime($utcDateTime);
    $date = $time->format('Y-m-d');
    $time = $time->format('g:iA');

    return (['date' => $date, 'time' => $time]);
}

function dateTimeFromUTC($datetime, $timezone)
{
    date_default_timezone_set(('UTC'));
    $asia_timestamp = strtotime($datetime);
    date_default_timezone_set($timezone);
    $utcDateTime = date("Y-m-d H:i:s", $asia_timestamp);
    $time = new DateTime($utcDateTime);
    $date = $time->format('Y-m-d');
    $time = $time->format('g:iA');
    return (['date' => $date, 'time' => $time]);
}

function dateTimeFromUTCStandard($datetime, $timezone)
{
    date_default_timezone_set(('UTC'));
    $asia_timestamp = strtotime($datetime);
    date_default_timezone_set($timezone);
    $utcDateTime = date("Y-m-d H:i:s", $asia_timestamp);
    $time = new DateTime($utcDateTime);
    $date = $time->format('Y-m-d');
    $time = $time->format('g:i');
    return (['date' => $date, 'time' => $time]);
}
/**
 *
 * Get times as option-list.
 *
 * @return string List of times
 */
function get_times($default = '19:00', $interval = '+30 minutes')
{

    $output = '';

    $current = strtotime('00:00');
    $end = strtotime('23:59');

    while ($current <= $end) {
        $time = date('H:i', $current);
        $sel = ($time == $default) ? ' selected' : '';

        $output .= '<option value="' . date('h.ia', $current) . '">' . date('h.iA', $current) . '</option>';
        //        $output .= "<option value=\"{$time}\"{$sel}>" . date('h.i A', $current) .'</option>';
        $current = strtotime($interval, $current);
    }

    return $output;
}

function getRecursiveDay($date_from, $date_to, $days, $recursiveType)
{
    if ($recursiveType == 'weekly') {
        $daysArr = array();
        foreach ($days as $day) {
            if ($day == 'Tue') {
                $day = 'Tues';
            }
            if ($day == 'Wed') {
                $day = 'Wednes';
            }
            if ($day == 'Thu') {
                $day = 'Thurs';
            }
            if ($day == 'Sat') {
                $day = 'Satur';
            }

            array_push($daysArr, $day . 'day');
        }

        $period = floor((strtotime($date_to) - strtotime($date_from)) / (24 * 60 * 60));
        $dates = array();
        for ($i = 0; $i < $period; $i++) {
            if (in_array(date('l', strtotime("$date_from +$i day")), $daysArr))
                array_push($dates, date('Y-m-d', strtotime("$date_from +$i day")));
        }
        return $dates;
    }

    if ($recursiveType == 'biweekly') {

        $period = floor((strtotime($date_to) - strtotime($date_from)) / (14 * 24 * 60 * 60));

        $dates = array();
        $dayP = 0;
        for ($i = 0; $i < $period; $i++) {
            array_push($dates, date('Y-m-d', strtotime("$date_from +$dayP day")));
            $dayP = $dayP + 14;
        }

        return $dates;
    }
    if ($recursiveType == 'monthly') {
        $start_date = $date_from;
        $dates = [];

        $start_date = \Illuminate\Support\Carbon::createFromFormat('Y-m-d', $start_date);
        $end_date = \Illuminate\Support\Carbon::createFromFormat('Y-m-d', $date_to);

        while ($start_date->lte($end_date)) {
            $start_date = $start_date->addMonth();
            if ($start_date->lte($end_date)) {
                $dates[] = $start_date->format('Y-m-d');
            }
        }
        return $dates;
    }
}

function getEndDate($startDate, $duration)
{
    preg_match('!\d+!', $duration, $durationT);
    $endTime = strtotime("+$durationT[0] minutes", strtotime($startDate));
    return date('h:ia', $endTime);
}

function splitStringInWeirdWay($string, $num)
{
    if (strlen($string) < $num) {
        return '';
    }

    for ($i = 0; $i < strlen($string) - $num + 1; $i++) {
        $result[] = substr($string, $i, $num);
    }
    return $result;
}

function searchQuery($query, $str, $column)
{

    if ($str != '' && strlen($str) > 2) {

        $criterias = splitStringInWeirdWay($str, 8);
        if ($criterias) {
            foreach ($criterias as $criteria) {
                $query = $query->orWhere($column, 'like', '%' . $criteria . '%');
            }
            if ($query->count() < 1) {
                $criterias = splitStringInWeirdWay($str, 7);
                if ($criterias) {

                    foreach ($criterias as $criteria) {
                        $query = $query->orWhere($column, 'like', '%' . $criteria . '%');
                    }
                    if ($query->count() < 1) {
                        $criterias = splitStringInWeirdWay($str, 6);
                        if ($criterias) {
                            foreach ($criterias as $criteria) {
                                $query = $query->orWhere($column, 'like', '%' . $criteria . '%');
                            }
                            if ($query->count() < 1) {
                                $criterias = splitStringInWeirdWay($str, 5);
                                if ($criterias) {
                                    foreach ($criterias as $criteria) {
                                        $query = $query->orWhere($column, 'like', '%' . $criteria . '%');
                                    }
                                    if ($query->count() < 1) {
                                        $criterias = splitStringInWeirdWay($str, 4);
                                        if ($criterias) {
                                            foreach ($criterias as $criteria) {
                                                $query = $query->orWhere($column, 'like', '%' . $criteria . '%');
                                            }
                                            if ($query->count() < 1) {
                                                $criterias = splitStringInWeirdWay($str, 3);
                                                if ($criterias) {
                                                    foreach ($criterias as $criteria) {
                                                        $query = $query->orWhere($column, 'like', '%' . $criteria . '%');
                                                    }
                                                    if ($query->count() < 1) {
                                                        $criterias = splitStringInWeirdWay($str, 2);
                                                        if ($criterias) {
                                                            foreach ($criterias as $criteria) {
                                                                $query = $query->orWhere($column, 'like', '%' . $criteria . '%');
                                                            }
                                                            if ($query->count() < 1) {
                                                                return $query->orWhere($column, 'like', '%' . $str . '%');
                                                            }
                                                            return $query;
                                                        }
                                                    }
                                                    return $query;
                                                }
                                            }
                                            return $query;
                                        }
                                    }
                                    return $query;
                                }
                            }
                            return $query;
                        }
                    }
                    return $query;
                }
            }
            return $query;
        } else {
            $criterias = splitStringInWeirdWay($str, 7);
            if ($criterias) {
                foreach ($criterias as $criteria) {
                    $query = $query->orWhere($column, 'like', '%' . $criteria . '%');
                }
                if ($query->count() < 1) {
                    $criterias = splitStringInWeirdWay($str, 6);
                    if ($criterias) {
                        foreach ($criterias as $criteria) {
                            $query = $query->orWhere($column, 'like', '%' . $criteria . '%');
                        }
                        if ($query->count() < 1) {
                            $criterias = splitStringInWeirdWay($str, 5);
                            if ($criterias) {
                                foreach ($criterias as $criteria) {
                                    $query = $query->orWhere($column, 'like', '%' . $criteria . '%');
                                }
                                if ($query->count() < 1) {
                                    $criterias = splitStringInWeirdWay($str, 4);
                                    if ($criterias) {
                                        foreach ($criterias as $criteria) {
                                            $query = $query->orWhere($column, 'like', '%' . $criteria . '%');
                                        }
                                        if ($query->count() < 1) {
                                            $criterias = splitStringInWeirdWay($str, 3);
                                            if ($criterias) {
                                                foreach ($criterias as $criteria) {
                                                    $query = $query->orWhere($column, 'like', '%' . $criteria . '%');
                                                }
                                                if ($query->count() < 1) {
                                                    $criterias = splitStringInWeirdWay($str, 2);
                                                    if ($criterias) {
                                                        foreach ($criterias as $criteria) {
                                                            $query = $query->orWhere($column, 'like', '%' . $criteria . '%');
                                                        }
                                                        if ($query->count() < 1) {
                                                            return $query->orWhere($column, 'like', '%' . $str . '%');
                                                        }
                                                        return $query;
                                                    }
                                                }
                                                return $query;
                                            }
                                        }
                                        return $query;
                                    }
                                }
                                return $query;
                            }
                        }
                        return $query;
                    }
                }
                return $query;
            } else {
                $criterias = splitStringInWeirdWay($str, 6);
                if ($criterias) {

                    foreach ($criterias as $criteria) {

                        $query = $query->orWhere($column, 'like', '%' . trim($criteria) . '%');
                    }
                    if ($query->count() < 1) {
                        $criterias = splitStringInWeirdWay($str, 5);
                        if ($criterias) {
                            foreach ($criterias as $criteria) {
                                $query = $query->orWhere($column, 'like', '%' . $criteria . '%');
                            }
                            if ($query->count() < 1) {
                                $criterias = splitStringInWeirdWay($str, 4);
                                if ($criterias) {
                                    foreach ($criterias as $criteria) {
                                        $query = $query->orWhere($column, 'like', '%' . $criteria . '%');
                                    }
                                    if ($query->count() < 1) {
                                        $criterias = splitStringInWeirdWay($str, 3);
                                        if ($criterias) {
                                            foreach ($criterias as $criteria) {
                                                $query = $query->orWhere($column, 'like', '%' . $criteria . '%');
                                            }
                                            if ($query->count() < 1) {
                                                $criterias = splitStringInWeirdWay($str, 2);
                                                if ($criterias) {
                                                    foreach ($criterias as $criteria) {
                                                        $query = $query->orWhere($column, 'like', '%' . $criteria . '%');
                                                    }
                                                    if ($query->count() < 1) {
                                                        return $query->orWhere($column, 'like', '%' . $str . '%');
                                                    }
                                                    return $query;
                                                }
                                            }
                                            return $query;
                                        }
                                    }
                                    return $query;
                                }
                            }
                            return $query;
                        }
                    }
                    return $query;
                } else {
                    $criterias = splitStringInWeirdWay($str, 5);
                    if ($criterias) {
                        foreach ($criterias as $criteria) {
                            $query = $query->orWhere($column, 'like', '%' . $criteria . '%');
                        }
                        if ($query->count() < 1) {
                            $criterias = splitStringInWeirdWay($str, 4);
                            if ($criterias) {
                                foreach ($criterias as $criteria) {
                                    $query = $query->orWhere($column, 'like', '%' . $criteria . '%');
                                }
                                if ($query->count() < 1) {
                                    $criterias = splitStringInWeirdWay($str, 3);
                                    if ($criterias) {
                                        foreach ($criterias as $criteria) {
                                            $query = $query->orWhere($column, 'like', '%' . $criteria . '%');
                                        }
                                        if ($query->count() < 1) {
                                            $criterias = splitStringInWeirdWay($str, 2);
                                            if ($criterias) {
                                                foreach ($criterias as $criteria) {
                                                    $query = $query->orWhere($column, 'like', '%' . $criteria . '%');
                                                }
                                                if ($query->count() < 1) {
                                                    return $query->orWhere($column, 'like', '%' . $str . '%');
                                                }
                                                return $query;
                                            }
                                        }
                                        return $query;
                                    }
                                }
                                return $query;
                            }
                        }
                        return $query;
                    } else {
                        $criterias = splitStringInWeirdWay($str, 4);
                        if ($criterias) {
                            foreach ($criterias as $criteria) {
                                $query = $query->orWhere($column, 'like', '%' . $criteria . '%');
                            }
                            if ($query->count() < 1) {
                                $criterias = splitStringInWeirdWay($str, 3);
                                if ($criterias) {
                                    foreach ($criterias as $criteria) {
                                        $query = $query->orWhere($column, 'like', '%' . $criteria . '%');
                                    }
                                    if ($query->count() < 1) {
                                        $criterias = splitStringInWeirdWay($str, 2);
                                        if ($criterias) {
                                            foreach ($criterias as $criteria) {
                                                $query = $query->orWhere($column, 'like', '%' . $criteria . '%');
                                            }
                                            if ($query->count() < 1) {
                                                return $query->orWhere($column, 'like', '%' . $str . '%');
                                            }
                                            return $query;
                                        }
                                    }
                                    return $query;
                                }
                            }
                            return $query;
                        } else {
                            $criterias = splitStringInWeirdWay($str, 3);
                            if ($criterias) {
                                foreach ($criterias as $criteria) {
                                    $query = $query->orWhere($column, 'like', '%' . $criteria . '%');
                                }
                                if ($query->count() < 1) {
                                    $criterias = splitStringInWeirdWay($str, 2);
                                    if ($criterias) {
                                        foreach ($criterias as $criteria) {
                                            $query = $query->orWhere($column, 'like', '%' . $criteria . '%');
                                        }
                                        if ($query->count() < 1) {
                                            return $query->orWhere($column, 'like', '%' . $str . '%');
                                        }
                                        return $query;
                                    }
                                }
                                return $query;
                            } else {
                                $criterias = splitStringInWeirdWay($str, 2);
                                if ($criterias) {
                                    foreach ($criterias as $criteria) {
                                        $query = $query->orWhere($column, 'like', '%' . $criteria . '%');
                                    }
                                } else {
                                    $query = $query->orWhere($column, 'like', '%' . $str . '%');
                                }
                            }
                        }
                    }
                }
            }
        }
    } else {
        $query = $query->orWhere($column, 'like', '%' . $str . '%');
    }
    return $query;
}

function modify($str)
{
    return ucwords(str_replace("_", " ", $str));
}

function modifiedUrl($lang, $url)
{
    $modifiedUrl = str_replace($lang, '', $url);

    if (str_starts_with($modifiedUrl, '/')) {
        return $modifiedUrl;
    }
    return '/' . $modifiedUrl;
}

function fileUploads($request, $destinationPath, $name)
{
    try {

        if ($request->hasFile($name)) {
            $file = $request->file($name);
            $orginalName = time() . '_' . $file->getClientOriginalName();
            $orginalName = str_replace(' ', '_', $orginalName);
            $request->file($name)->move(public_path($destinationPath), $orginalName);
            $image_path = $destinationPath . $orginalName;
            return $image_path;
        }
    } catch (Exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
    }
}
function idCheakedMulti($parent, $parent_id)
{

    if ($parent) {
        if (in_array($parent_id, $parent)) {
            return 'checked';
        } else {
            return 'uncheked';
        }
    } else {
        return 'uncheked';
    }
}

function idCheaked($parent, $parent_id)
{
    if ($parent == $parent_id) {
        return 'checked';
    } else {
        return 'uncheked';
    }
}

function getContentCount($course_id)
{
    return \App\Models\CourseContents::where('course_id', $course_id)->count();
}

function getParent($parent)
{
    if ($parent > 0) {
        $row = \App\Models\Courses::where('id', $parent)->with(['getCourseTranslate' => function ($query) {
            $query->where('lang_key', 'like', app()->getLocale());
        }])->first();
        return $row->getCourseTranslate->name ?? '';
    } else {
        return 'Self';
    }
}
function IsNullOrEmptyString($str)
{
    return (!isset($str) || trim($str) === '');
}

function getSummaryReportItem($key)
{
    $row = \App\Models\SummaryReportSettings::where('is_active', true)->where('key', $key)->first();
    return $row->value ?? '';
}
function getSummeryReportItem($key)
{
    $row = \App\Models\SummaryReportSettings::where('is_active', true)->where('key', $key)->first();
    return $row->value ?? '';
}
function isEven($number)
{
    if ($number % 2 == 0) {
        return true;
    }
    return false;
}
