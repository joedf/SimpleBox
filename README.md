# ![logo](Network/src/logo48.png) SimpleBox

Store and manage files easily.
------------------------------

Dropbox, Mediafire, Box, Copy, Drive, etc. Are these services not giving you enough space? Disk space is really inexpensive these days. 

### Want more space for free?
Here's how : a simple equation.

`SimpleBox` **+** `Free "unlimited" Hosting` **=** `a free unlimited "Box" service`

### Live Demo
Navigate to http://simplebox.tk  
Username: `admin`  
Password: `testtest321`  

### Free "unlimited" Hosting services
Here's a few:

- [3jelly.com](http://www.3jelly.com/)
- [3owl.com](http://www.3owl.com/)
- [wink.ws](http://wink.ws/)

### Installing SimpleBox
1. Copy/upload everything within the [`Network`](Network) directly to your free hosting service via FTP (that they provide you with).
2. You'll have to edit [`p_login.php`](Network/p_login.php). The default username is `admin` and password `testtest321`.  
    Change `$MyUsername = "admin";` to `$MyUsername = "USERNAME_HERE";`  
    and change `$MyPassword = "0a44573b5612d0f621a6d4ea81453219e23003a7bd3144791bbe82c1028eb701";` to  
    `$MyPassword = "YOUR_SHA256_HASHED_PASSWORD";`  
    Here's an online hash tool : http://www.xorbin.com/tools/sha256-hash-calculator
3. Now, navigate to your webpage and login with your set credentials and voilà!

Release under the [MIT License](LICENSE)
  
### Alternatives
- [OwnCloud](https://owncloud.org/) [source](https://github.com/owncloud/core)
- [ResponsiveFilemanager](https://github.com/trippo/ResponsiveFilemanager)
- [RichFilemanager](https://github.com/servocoder/RichFilemanager)
