@echo off

echo m3u8���ص�����
echo.

set /p number=��������:
set /p url=������URL��ַ:

title %number% %url%

download -i %url% -o ../resource/m3u8/%number%/ -t 100

echo.

pause
