echo off
set arg1=%1
set arg2=%2
shift
shift
php convert.php %arg1% %arg2% %*