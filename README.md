Maestria
===

Need
---
- Php
- Make (For windows take look (http://stackoverflow.com/questions/12881854/how-to-use-gnu-make-on-windows)[here])
- Sqlite3
- Http server (Nginx, Apache, PHP Build server, ...) correctly installed and configured.


Installation
---
- Your domain must go in `Public/` directory, rewrite_url activate
- `make install`  => Download composer and do some stuff
- `make db-install` => Init database structure
- `make db-data` => Generate basic start information
- `make db-sample` => Generate random information, this step is optional

Usage
---
Go on your domain and enjoy