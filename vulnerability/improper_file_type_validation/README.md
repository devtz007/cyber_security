# Improper File Type Validation

## Understanding the Upload Restrictions

- The server requires uploaded files to have a `.png` extension.
- The server validates the file by checking that the first few bytes contain the string "PNG" in hexadecimal (`50 4E 47`).
- Uploaded files are saved in `/<location>/webshell.png.php`.
- Visit the uploaded file's location

## Bypassing the Restriction

1. Take a PHP web shell script (a file containing PHP code to execute commands remotely).
2. Add the string `PNG` at the very beginning of the PHP code to pass the server’s magic bytes check.
3. Rename the file to `webshell.png.php` to bypass extension checks (the server only looks for `.png`).
