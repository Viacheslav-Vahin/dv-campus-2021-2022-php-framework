#Viacheslav Vahin Blog

Fullstack development demo project

##Local development

The project can be run with Apache/Nginx and is compatible with [Default Value Docker infrastructure](https://github.com/DefaultValue/docker_infrastructure).
Alternatively, you can add a MySQL 8.0 container to this composition and bind Apache 80/443 ports to run it.

To start project with [Default Value Docker infrastructure](https://github.com/DefaultValue/docker_infrastructure):

1. Clone the project
2. Generate SSL certificate
3. Append certificate information to `${PROJECTS_ROOT_DIR}/docker_infrastructure/local_infrastructure/configuration/certificates.toml`
4. Add domains to the `/etc/hosts` file
5. Start Docker composition
6. Install Composer dependencies
7. Create MySQL user, DB and grant permissions
8. Setup DB schema and data
9. Optional: generate test data

```bash
# 1. Clone the project
cd $PROJECTS_ROOT_DIR
git clone https://github.com/Viacheslav-Vahin/viacheslav-vahin-blog.git

# 2. Generate SSL certificate
cd $SSL_CERTIFICATES_DIR
mkcert -cert-file=viacheslav-vahin-blog.local+1.pem -key-file=viacheslav-vahin-blog.local+1-key.pem viacheslav-vahin-blog.local www.viacheslav-vahin-blog.local

# 3. Append certificate information
echo '
  [[tls.certificates]]
    certFile = "/certs/viacheslav-vahin-blog.local+1.pem"
    keyFile = "/certs/viacheslav-vahin-blog.local+1-key.pem"
' >> ${PROJECTS_ROOT_DIR}/docker_infrastructure/local_infrastructure/configuration/certificates.toml

# 4. Add domains to the `/etc/hosts` file
echo '127.0.0.1 viacheslav-vahin-blog.local www.viacheslav-vahin-blog.local' | sudo tee -a /etc/hosts

# 5. Start Docker composition
cd ${PROJECTS_ROOT_DIR}viacheslav-vahin-blog/
docker-compose up -d

# 6. Install Composer dependencies
docker exec -it viacheslav-vahin-blog.local composer install

# 7. Create MySQL user, DB and grant permissions
mysql -uroot -proot -h127.0.0.1 --port=3380 -e 'SOURCE config/init.sql'

# 8. Setup DB schema and data
curl http://viacheslav-vahin-blog.local/install

# 9. Optional: generate test data
docker exec -it viacheslav-vahin-blog.local php bin/console install:generate-data
```