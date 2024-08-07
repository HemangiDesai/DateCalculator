# DateCalculator
 Date Difference Calculator API

This project provides a PHP-based web API for calculating the difference between two dates. It supports calculating the difference in days, weekdays, and complete weeks, and can convert the result into various units such as seconds, minutes, hours, and years. Users can also specify the timezone for the date calculations.

## Project Structure

- `api.php`: Contains the PHP code for the API. This script handles date difference calculations, unit conversions, and processes requests.
- `index.html`: Provides a user-friendly form to interact with the API via a web interface.
- `tests/DateCalculationsTest.php`: Contains PHPUnit tests for verifying the functionality of the API.

- 
## Requirements

- PHP 8.1 or later
- Composer
- PHPUnit

## Setup and Installation

1. **Clone the Repository**

   ```bash
   git clone https://github.com/HemangiDesai/DateCalculator.git

   cd DateCalculator


2. **Install Dependencies**


If PHPUnit is not installed globally, you can use Composer to install it:

composer require --dev phpunit/phpunit

3.**Run the PHP Built-in Server or can use PHP Server to run HTML page directly**

Start the PHP built-in server to test the API:
php -S localhost:8000


## Assumptions and Decisions

**Assumptions**

Date Format:

The input date format is assumed to be YYYY-MM-DDTHH:MM (ISO 8601). This format is used for simplicity and compatibility with many systems and tools.
Timezone Handling:

Timezone handling is assumed to be simple and is specified as a string that is recognized by PHP's DateTimeZone. This includes standard timezone names like GMT, America/New_York, etc.
Week Calculation:

The calculation of complete weeks is based on a floor division of the total number of days by 7. This approach does not account for partial weeks.
Unit Conversion:

Conversion between units is based on common time units (seconds, minutes, hours, days, years). Weeks are converted to days for consistency in conversions.
Decisions Made

## Error Handling:

Basic error handling is implemented to check for missing start and end dates and invalid request methods. More robust error handling can be added based on requirements.
Conversion Factors:

Constants for time conversions are defined for clarity and ease of maintenance. These include seconds in a day, minutes in a day, and hours in a day.
Testing Approach:

PHPUnit is used for testing. Tests cover various scenarios including date differences, conversion of units, and calculation of weekdays.
API Design:

The API design includes a simple POST request handling mechanism. For production-level code, additional features like authentication, validation, and more complex error handling may be required.


## To use the API, submit a POST request to api.php with the following parameters:

start_date: The start date and time in YYYY-MM-DDTHH:MM format.
end_date: The end date and time in YYYY-MM-DDTHH:MM format.
calculation_type: Type of calculation (days, weekdays, weeks).
conversion_unit: Unit to convert the result into (days, seconds, minutes, hours, years).
timezone: Timezone for the calculation (default is GMT).

## Example Request:Using postman 
http://localhost:8000/src/api.php
{
    "start_date": "2024-01-01T00:00:00",
    "end_date": "2024-01-10T00:00:00",
    "calculation_type": "days",
    "conversion_unit": "days",
    "timezone": "GMT"
}

## Running Tests

To run the PHPUnit tests, use the following command:

./vendor/bin/phpunit --bootstrap src/api.php tests/DateCalculationsTest.php


