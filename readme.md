
## 安装
### 1.clone到本地
```
git clone git@github.com:wangyong5609/admin.git
```
### 2.修改文件访问权限
```
 sudo chmod -R 777 storage bootstrap/cache
```
### 3.安装依赖
```
composer install
```
### 4.根目录下创建.env文件
```
 cp .env.example .env
```
### 5.生成APP_KEY
```
 php artisan key:generate
```
### 6.配置数据库信息  然后执行迁移
```
 php artisan migrate --seed
```
到此已安装成功 祝使用愉快