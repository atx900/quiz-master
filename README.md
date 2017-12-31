Instructions on how to setup the Quiz Master:

1. Download a copy of XAMPP from its official website (https://www.apachefriends.org/download.html)
   - Preferably, download the one with PHP 7.2.0

2. Install XAMPP using the following installation guide according to the host operating system where it will be installed.
   - Mac OS X: https://www.apachefriends.org/faq_osx.html
   - Linux: https://www.apachefriends.org/faq_linux.html
   - Windows: https://www.apachefriends.org/faq_windows.html   
   - Look for the FAQ (Frequently Asked Questions) entry entitled 'How do I install XAMPP?'
   
3. After XAMPP has been installed successfully, start the XAMPP application up. 
    - Details on how to start XAMPP specifically according to the host operating system where it is currently installed, is found under the FAQ entry 'How do I start XAMPP?'
    - Only the Apache and MySQL services needed to be started up.
 
4. Once the installation has completed successfully, test the installation.
    - Details on how to test a XAMPP installation is found under the FAQ entry 'How can I test that everything worked?'

5. After the installation has been successfully tested, copy the quiz-master folder (and its contents) to the XAMPP's htdocs folder. The htdocs folder is located within the XAMPP's installation directory.
    
6. Return back to the opened browser (performed on Step #4); search and click 'phpMyAdmin' located at the top right-hand side of the web page.

7. Once phpMyAdmin's page has been loaded, click the 'New' menu item located at the left-hand side of the page.

8. On the Databases page, click the text field right under the label 'Create database' and type 'quizmaster' followed by clicking the 'Create' button.

9. Click the 'Import' button located at the top menu items of the phpMyAdmin web page; this will launch the 'Import into current server' web page.

10. Look for and click the 'Browse' button after will ask for the location of an .SQL file. Go inside the quiz-master folder and look for the file 'quizmaster.sql'.

11. Once the file has been located, click Open and it will return back to the 'Import into current server' web page. Click the 'Go' button located at the bottom of the page.
    - A message 'Import has been successfully installed' will be returned after successfully importing the contents of the quizmaster.sql file into the current database.
    
12. To launch Quiz Master's Admin mode, type the URL: http://localhost/quiz-master/index.php

13. To launch Quiz Master's client mode, type the URL: http://localhost/quiz-master/client.php
