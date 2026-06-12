# Auth, Role, Permission

Authentication memakai CodeIgniter Shield. Route admin dilindungi filter `session`.

Role awal:

- Super Admin
- Admin
- Editor
- Author
- Sales
- Viewer

Permission mengikuti `app/Config/AuthGroups.php`, misalnya `content.create`, `product.update`, `inquiry.reply`, `social.generate`, dan `setting.update`. Sidebar admin membaca permission user sehingga menu dapat disesuaikan per role.
