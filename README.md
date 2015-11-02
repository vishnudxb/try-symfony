### Run

Steps:

1. clone the repo: `git clone https://github.com/vishnudxb/try-symfony.git`
1. cd try-symfony
1. run `docker build -t=docker-registry.getsocial.im/try-symfony .`
1. run `docker run -d --name=symfony-app --restart=always -p 80:80 docker-registry.getsocial.im/try-symfony`
1. Open your browser and give your private ip. If you are using mac, please give your VM ip. 
![](https://s3-eu-west-1.amazonaws.com/uploads-eu.hipchat.com/55086/2540360/mZfUHMfG7Hrayzj/Screen%20Shot%202015-11-09%20at%2010.18.20%20AM.png)

