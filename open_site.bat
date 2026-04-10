@echo off
echo Setting up AgriInovate Project in XAMPP...

:: Create the folder in htdocs if it doesn't exist
if not exist "C:\xampp\htdocs\agro" mkdir "C:\xampp\htdocs\agro"

:: Copy all files from current directory to htdocs\agro
echo Copying files to C:\xampp\htdocs\agro...
xcopy /s /i /y "." "C:\xampp\htdocs\agro\"
mkdir "C:\xampp\htdocs\agro\uploaded_img\images" 2>nul
xcopy /s /i /y "uploaded_img\images\*" "C:\xampp\htdocs\agro\uploaded_img\images\"

echo Done! Opening your website...
start http://localhost/agro/index.php
exit
