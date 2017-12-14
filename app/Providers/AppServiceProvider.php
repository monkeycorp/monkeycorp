<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('melitable', function($data) {
            return '<table class="table table-striped table-hover table-condensed">
                    <thead>
                    <tr>
                        <th>Field</th>
                        <th>Value</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                    foreach(' . $data . ' as $key => $value) { 
                        if (
                            gettype($value) != \'object\' &&
                            gettype($value) != \'NULL\' &&
                            gettype($value) != \'array\'
                       ) {
                    ?>
                       <tr>
                            <td><strong><?= $key ?></strong></td>
                            <td><?= $value ?></td>
                        </tr>
                    <?php
                        }
                    } ?>
                    </tbody>
                </table>';
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
