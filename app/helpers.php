<?php

use Illuminate\Support\Facades\Session;

function printAllErrors($errors)
{
    if ($errors->any() || Session::get('error')) {
        echo "<ul class='alert alert-danger'>";

        foreach ($errors->all() as $error) {
            if (is_string($error)) {
                echo "<li>$error</li>";
            } else {
                foreach ($error as $err) {
                    if (is_string($err)) {
                        echo "<li>$err</li>";
                    } else {
                        foreach ($err as $er) {
                            if (is_string($er)) {
                                echo "<li>$er</li>";
                            }
                        }
                    }
                }
            }
        }
        echo "</ul>";
    }
}
