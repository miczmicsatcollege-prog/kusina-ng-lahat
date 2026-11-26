@echo off
cd /d "%~dp0"
where php >nul 2>nul
if %errorlevel%==0 (
  set "PHP_EXE=php"
) else if exist "C:\xampp\php\php.exe" (
  set "PHP_EXE=C:\xampp\php\php.exe"
) else (
  echo PHP not found. Install XAMPP or PHP 8.1+ and try again.
  pause
  exit /b 1
)
echo Open http://localhost:8000 in your browser.
echo Keep this window open. Press Ctrl+C to stop the server.
"%PHP_EXE%" -S localhost:8000 -t public
pause
