<?php

// Constants for conversion
const SECONDS_IN_DAY = 86400; // 24 * 60 * 60
const MINUTES_IN_DAY = 1440; // 24 * 60
const HOURS_IN_DAY = 24;
const DAYS_IN_YEAR = 365.25;

function calculateDateDifference($start, $end, $unit = 'days', $timezone = 'GMT') {
    $startDate = new DateTime($start, new DateTimeZone($timezone));
    $endDate = new DateTime($end, new DateTimeZone($timezone));
    $interval = $startDate->diff($endDate);

    // Return the difference based on the specified unit
    return match ($unit) {
        'days' => $interval->days,
        'weekdays' => calculateWeekdays($startDate, $endDate),
        'weeks' => floor($interval->days / 7),
        default => $interval->days,
    };
}  

function calculateWeekdays($startDate, $endDate) {
    
    $weekdays = 0;
    while ($startDate < $endDate) {
        if ($startDate->format('N') < 6) {
            $weekdays++;
        }
        $startDate->modify('+1 day');
    }
    return $weekdays;
}

function convertUnit($value, $unit, $initialUnit) {
    if ($initialUnit === 'weeks' && $unit !== 'days')  {
        $value *= 7; // Convert weeks to days
    }

    // Return the converted value based on the specified unit
    return match ($unit) {
        'seconds' => $value * SECONDS_IN_DAY,
        'minutes' => $value * MINUTES_IN_DAY,
        'hours' => $value * HOURS_IN_DAY,
        'years' => $value / DAYS_IN_YEAR,
        'days' => $value,
        default => $value,
    };
}

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [];

    if (strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false) {
        $data = json_decode(file_get_contents('php://input'), true);
    } else {
        $data = $_POST;
    }

    $startDate = $data['start_date'] ?? null;
    $endDate = $data['end_date'] ?? null;
    $calculationType = $data['calculation_type'] ?? 'days';
    $conversionUnit = $data['conversion_unit'] ?? 'days';
    $timezone = $data['timezone'] ?? 'GMT';

    if (!$startDate || !$endDate) {
        echo json_encode(['error' => 'Start date and end date are required']);
        exit;
    }

    try {
        $difference = calculateDateDifference($startDate, $endDate, $calculationType, $timezone);
        $convertedDifference = convertUnit($difference, $conversionUnit, $calculationType);
        echo json_encode("The difference between $startDate and $endDate in $conversionUnit is $convertedDifference.");
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>
