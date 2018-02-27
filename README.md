## Laravel/Vue Training Track Assessment (Justin)

**Setup:**

**1) Clone the repo to the directory where you keep your Homestead code** (in my case it's ~/Code)

```
git clone git@gitlab.twisted-rope.com:training-track-submissions/justin-laravel-vue.git laravel-vue-app
```

**2) Edit your Homestead.yaml file** to map your new directory to your vagrant box

```
folders:

   - map: ~/Code/laravel-vue-app
     to: /home/vagrant/Code/laravel-vue-app
```
     
**3) Edit your Homestead.yaml 'sites'** if you want to serve the app from Homestead. Make
sure it's pointing to the 'public' folder

```
sites:
   
   - map: laravelvueapp.local
     to: /home/vagrant/Code/laravel-vue-app/public
```
**Note:**

>If you are serving the app this way, make sure your /etc/hosts file is set up correctly also.

>(In this case, you'd need to make the following entry to it after any others that are there:)

```
192.168.10.10   laravelvueapp.local
```

**4) Next**, from your Homestead directory run:

```
vagrant reload --provision
```

**5) Then**, once complete:

```
vagrant ssh
```

to ssh into your vagrant.

**6) Change to the app directory** (in my case its /home/vagrant/Code/laravel-vue-app)

**7) Run**
```
npm install
``` 

and

```
composer install
```

**8) Copy the .env.example file to create a new .env:**

```
cp .env.example ./.env
```


**9) Generate a new application key**

```
php artisan key:generate
```

This key should be automatically copied over to your .env file (cat it just to make sure!)

**10) Run the following** to build the app:

```
npm run dev
```

**11) On your host machine, open your browser** and go to <a href="http://laravelvueapp.local/app">http://laravelvueapp.local/app</a>.
The app should load immediately.

**Note:** 

The root URI offers directions to the app if you land there by mistake