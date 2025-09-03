<?php

if (!function_exists('getVoucher')) {
    function getVoucher($voucherId, $hotelId) {
        $voucher = \App\Models\HotelVouchers::where('voucher_id', $voucherId)->where('hotel_id', $hotelId)->first();
        return $voucher->id;
    }
}

if (!function_exists('svg')) {
    function svg($name, $width = false, $height = false)
    {
        $dir = 'assets/svg/';
        $path = $dir . $name . '.svg';

        if ($name && file_exists($path)) {
            $svg = file_get_contents($path);
            if ($width) {
                $size = '<svg';
                $new_size = '<svg width="' . $width . 'px"';
                $svg = str_replace($size, $new_size, $svg);
            }
            if ($height) {
                $size = '<svg';
                $new_size = '<svg height="' . $height . 'px"';
                $svg = str_replace($size, $new_size, $svg);
            }
            return $svg;
        }
        return '';
    }
}

if (!function_exists('showSVG')) {
    function showSVG($name, $width = false, $height = false)
    {
        $dir = 'assets/svg/';
        $path = $dir . $name;

        if ($name && file_exists($path)) {
            $svg = file_get_contents($path);
            if ($width) {
                $size = '<svg';
                $new_size = '<svg width="' . $width . 'px"';
                $svg = str_replace($size, $new_size, $svg);
            }
            if ($height) {
                $size = '<svg';
                $new_size = '<svg height="' . $height . 'px"';
                $svg = str_replace($size, $new_size, $svg);
            }
            return $svg;
        }
        return '';
    }
}
/**
 * Function help call file SVG from url
 */
if (!function_exists('svg_dir')) {
    function svg_dir($path, $width = false, $height = false)
    {
        if ($path) {
            $svg = file_get_contents($path);
            if ($width) {
                $size = '<svg';
                $new_size = '<svg width="' . $width . 'px"';
                $svg = str_replace($size, $new_size, $svg);
            }
            if ($height) {
                $size = '<svg';
                $new_size = '<svg height="' . $height . 'px"';
                $svg = str_replace($size, $new_size, $svg);
            }
            return $svg;
        }
        return '';
    }
}

if (!function_exists('getSummary')) {
    function getSummary($content, $maxLength = 250)
    {
        // Loại bỏ các thẻ HTML và trim dấu cách thừa
        $content = trim(strip_tags($content));

        // Kiểm tra độ dài của đoạn văn bản
        if (mb_strlen($content) <= $maxLength) {
            return $content;
        } else {
            // Cắt đoạn văn bản tới maxLength ký tự cuối cùng
            $summary = mb_substr($content, 0, $maxLength);

            // Tìm vị trí của dấu cách gần nhất từ vị trí maxLength
            $lastSpacePos = mb_strrpos($summary, ' ');

            // Cắt đoạn văn bản tới dấu cách gần nhất để có summary hoàn chỉnh
            $summary = mb_substr($summary, 0, $lastSpacePos);

            return $summary . '...';
        }
    }
}

if (!function_exists('getTimeBook')) {
    function getTimeBook($room_id)
    {
        $order = \App\Models\Orders::where('room_id', $room_id)->orderBy('created_at', 'desc')->first();
        $now = \Carbon\Carbon::now();

        if($order) {
            $created_at = $order->created_at;
            $differenceInDays = $created_at->diffInDays($now);
            $differenceInHours = $created_at->diffInHours($now);
            $differenceInMinutes = $created_at->diffInMinutes($now);
            if ($differenceInMinutes < 60) {
                $timeDifference = $differenceInMinutes . ' phút trước';
            } elseif ($differenceInHours < 24) {
                $timeDifference = $differenceInHours . ' giờ trước';
            } else {
                $timeDifference = $differenceInDays . ' ngày trước';
            }
            $time = 'Vừa được đặt ' . $timeDifference;
        } else {
            $time = 'Đặt phòng ngay để nhận giá ưu đãi';
        }

       return $time;
    }
}

if (!function_exists('convertDateString')) {
    function convertDateString($dateString) {
        // Define the month mapping
        $months = [
            'tháng 01' => '01',
            'tháng 02' => '02',
            'tháng 03' => '03',
            'tháng 04' => '04',
            'tháng 05' => '05',
            'tháng 06' => '06',
            'tháng 07' => '07',
            'tháng 08' => '08',
            'tháng 09' => '09',
            'tháng 10' => '10',
            'tháng 11' => '11',
            'tháng 12' => '12',
        ];

        // Remove the weekday part (e.g., "T4, ") from the date string
        $dateString = preg_replace('/T\d+, /', '', $dateString);
        // Replace the month part in the date string
        foreach ($months as $key => $value) {
            if (strpos($dateString, $key) !== false) {
                $dateString = str_replace($key, $value, $dateString);
                break;
            }
        }

        $date = str_replace(' tháng ', '/0', $dateString);
        $date = str_replace(' ', '/', $date);
        $date = str_replace('CN, ', '', $date);
        $date = str_replace('CN,/', '', $date);
        $dateString = str_replace('tháng', '', $date);

        // Append the current year to the date string
        $currentYear = date('Y');
        $dateString .= "/$currentYear";
        // Convert the modified date string to a Carbon instance
        return $dateString;
    }
}


