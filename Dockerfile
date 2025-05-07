# 使用官方 PHP + Apache 映像檔
FROM php:8.2-apache

# 安裝 PostgreSQL PDO 擴充
RUN docker-php-ext-install pdo_pgsql

# 複製專案到容器中
COPY . /var/www/html/

# 啟用 Apache rewrite 模組（給 Vue router 用）
RUN a2enmod rewrite

# 設定時區（選擇性）
RUN echo "Asia/Taipei" > /etc/timezone
