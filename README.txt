PRE STEP

Extract file ticket.zip

[install]

1. Buka C:\xampp\htdocs
2. Create new folder 'ticket' (atau bebas opsi nama folder lainnya)
3. Pindahkan file ticket.zip yang telah didownload ke dalam folder pada step 2, lalu klik kanan -> 'Extract Here'
4. Buat file .htaccess pada folder tersebut, dengan syntax seperti dibawah (silahkan dicopy)

RewriteEngine on
RewriteCond $1 !^(index\.php|resources|robots\.txt)
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php/$1 [L,QSA] 

5. Selesai

[install database]

1. buka http://localhost/phpmyadmin
2. create database dengan nama 'ticket' (tanpa tanda kutip)
3. Klik database ticket yang sudah dibuat tadi
4. Klik Import database
5. Klik Browse File, pilih 'ticket.sql' yang berada dalam folder ticket yang telah diextract dan dipindahkan ke htdocs pada step [install website]
6. Klik Go
7. Database sudah terimport
8. Buka browser, lalu ketikkan http://localhost/ticket