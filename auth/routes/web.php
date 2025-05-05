<?php

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    dd(Crypt::decrypt("eyJpdiI6IlI4RHpVQTU2bnVUckFLQkVxVS9WUWc9PSIsInZhbHVlIjoiNW9yQWdTMWhHTVpjL01CcG1RMGJndz09IiwibWFjIjoiYjA2MDI4OTk5Nzk0NzI3NjdjZDNlYTk2NDdiYTU2YjA3ODlkOTkxZmI0Zjg2ZGI3ZWUwYmRkMjI3OThjMzdlZiIsInRhZyI6IiJ9"));
});
