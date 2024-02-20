<?php

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\AdminLog;

function printAll($errors)
{
    if ($errors->any() || Session::get('error')) {
        echo "<ul class='list-group col-5 mx-auto mb-2''>";

        foreach ($errors->all() as $error) {
            if (is_string($error)) {
                echo "<li class='list-group-item list-group-item-danger text-center'>$error</li>";
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
    if ($message = Session::get('success')) {
        echo "<ul class='list-group col-5 mx-auto mb-2'>";

        if (is_string($message)) {
            echo "<li class='list-group-item list-group-item-success text-center'>$message</li>";
        } else {
            foreach ($message as $value) {
                if (is_string($value)) {
                    echo "<li class='list-group-item list-group-item-success text-center'>$value</li>";
                } else {
                    foreach ($value as $valu) {
                        if (is_string($valu)) {
                            echo "<li class='list-group-item list-group-item-success text-center'>$valu</li>";
                        }
                    }
                }
            }
        }

        echo "</ul>";
    }
}

function checkBannedAndAuth()
{
    if (!Auth::check()) {
        return false;
    } else {
        if (Auth::user()->Banned) {
            return false;
        }
        return true;
    }
}

function adminLog(string $action, Int $TargetUserID = null, Int $TargetAdID = null) {
    
    AdminLog::create([
            'AdminID' => Auth::id(),
            'Action' => $action,
            'TargetUserID' => $TargetUserID,
            'TargetAdID' => $TargetAdID,
        ]);
}
