@echo off

echo m3u8תmp4
echo.

set /p input=��������:

title %input%

ffmpeg -i  http://127.0.0.1/resource/m3u8/%input%/index.m3u8 -c copy ../resource/mp4/%input%.mp4

echo.

pause
