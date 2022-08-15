@echo off

echo m3u8下载到本地
echo.

set /p number=请输入编号:
set /p url=请输入URL地址:

title %number% %url%

download -i %url% -o ../resource/m3u8/%number%/ -t 100

echo.

pause
