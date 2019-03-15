@echo off
set /a j=10
for /L %%i in (1,1,%j%) do (
	start /B php artisan schedule:run > NUL 2>&1
	timeout 30
)
