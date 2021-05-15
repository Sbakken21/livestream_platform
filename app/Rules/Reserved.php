<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Route;
use Storage;

class Reserved implements Rule
{
    private $router;
    private $files;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $username = trim(strtolower($value));

        $routes = Route::getRoutes();

        foreach($routes as $route){
            if(strtolower($route->uri) === $username){
                return false;
            }
        }

        $reservedList = json_decode(Storage::get('json/reserved_usernames.json'));

        foreach($reservedList as $reserved){
            if(strtolower($reserved) === $username){
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The username is already taken.';
    }
}
